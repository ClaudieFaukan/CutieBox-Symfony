<?php

namespace App\Controller;

use App\Repository\UserRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends AbstractController
{
    /**
     * @Route("/home/{id}/{uniqId}", name="home_user")
     */
    public function homeUser($id, $uniqId, UserRepository $userRepository): Response
    {
        $user = $userRepository->findOneBy(['id' => $id]);
        $userUniqId = $user->getUniqId();
        /**
         *@var DateTime 
         */
        $userDayEnd = $user->getDateFin();
        $today = new DateTime();

        if ($userUniqId != $uniqId) {
            throw new NotFoundHttpException("Vous n'êtes pas autorisé, veuillez vérifier votre lien");
        } elseif ($today > $userDayEnd) {
            throw new NotFoundHttpException("Votre expérience à expirer, n'hésiter pas à la renouveler lors de vos prochains événements ;)");
        }
        //todo continuer les instruction

        return $this->render('home/index.html.twig', [
            'user' => $user
        ]);
    }
    /**
     * @Route("/", name="home")
     */
    public function index()
    {

        return $this->render("base.html.twig");
    }
}
