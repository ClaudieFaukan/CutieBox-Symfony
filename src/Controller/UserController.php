<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Imprimante;
use Endroid\QrCode\QrCode;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends AbstractController
{
    protected $httpClientInterface;

    public function __construct(HttpClientInterface $httpClientInterface)
    {
        $this->httpClientInterface = $httpClientInterface;
    }


    /**
     * @Route("/admin/create/user", name="create_user")
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
            // FIND & AFFECT PRINTER
            //TODO refactor this
            /**
             * @var Imprimante
             */
            $printer = $imprimanteController->findFreePrinter($user->getDateDebut(), $user->getDateFin());
            //$user->addImprimante($printer[0]);
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
     * @Route("/admin/list/users", name="list_users")
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
