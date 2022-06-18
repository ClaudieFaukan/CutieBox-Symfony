<?php

namespace App\Controller;

use App\Entity\User;
use Aws\S3\S3Client;
use App\Form\UserType;
use Aws\S3\ObjectUploader;
use Endroid\QrCode\QrCode;
use Aws\S3\MultipartUploader;
use Aws\Exception\AwsException;
use Aws\Credentials\Credentials;
use Aws\S3\Exception\S3Exception;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Form\FormInterface;
use Aws\Exception\MultipartUploadException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    protected $httpClientInterface;

    public function __construct(HttpClientInterface $httpClientInterface)
    {
        $this->httpClientInterface = $httpClientInterface;
    }


    /**
     *@Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    /**
     *@Route("/admin/create/user", name="create_user")
     */
    public function create(EntityManagerInterface $em, Request $request, ImprimanteController $imprimanteController): Response
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form = $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userUniqId = $this->generateUniqueId();
            $user->setUniqId($userUniqId);
            
            $em->persist($user);
            $em->flush();

            // QRCODE
            $userId = $user->getId();
            $pathFile = "../src/CutieQRcode/" . $userUniqId . ".png";
            $url = "https://" . $_SERVER['SERVER_NAME'] . "/home/" . $userId . "/" . $userUniqId;

            $qrcode = new QrCode($url);
            $qrcode->writeFile($pathFile);

            $user->setLienHtml($url);
            $user->setQrCode($pathFile);
            // END QRCODE

            //CREATE GALLERY
                //TODO TRY & CATCH
            //$this->createGallery($userUniqId);
            //$user->setLienGallerie($url = "https://" . $_SERVER['SERVER_NAME'] . "/home/" . $userId . "/" . $userUniqId . "/Gallery");

            // FIND & AFFECT PRINTER
            //TODO refactor this
            /**
             * @var Imprimante
             */
            $printer = $imprimanteController->findFreePrinter($user->getDateDebut(), $user->getDateFin());
            $user->addImprimante($printer[0]);
            $em->persist($user);
            $em->flush();

            //TODO créer le chemin vers gallerie

            return $this->redirectToRoute("admin");
        }

        $formView = $form->createView();
        return $this->render("user/create.html.twig", [
            "formView" => $formView,
        ]);
    }

    
    /**
     *@Route("/admin/list/users", name="list_users")
     */
    public function showUsers(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render("user/list.html.twig", [
            "users" => $users
        ]);
    }

    public function generateUniqueId()
    {
        $randomInt = random_int(0, 9999);
        $uniqueId = uniqid();
        $uniqueId = $uniqueId . $randomInt;
        
        return $uniqueId;
    }

}
