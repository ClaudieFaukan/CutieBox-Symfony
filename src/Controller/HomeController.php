<?php

namespace App\Controller;

use Treinetic\ImageArtist\lib\Image;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{

    /**
     *@Route("/", name="home")
     */
    public function index()
    {

        return $this->render("base.html.twig");
    }

    /**
     *@Route("/home/send/image", name="croppie_image",methods={"POST"}, options={"expose"=true})
     */
    public function croppie(Request $request){
        
        $image = $_POST['image'];
        list($type, $image) = explode(';', $image);
        list(, $image) = explode(',', $image);
        $image = base64_decode($image);
        $image_name = time() . '.png';
        file_put_contents('upload/' . $image_name, $image);
    
        $image1 = new Image("./upload/$image_name");
        $image1->scaleToHeight(1524);
        $image1->scaleToWidth(994);
        $image1->merge(new Image("./public/BD/PORTRAIT.png"), 0, 0);
        $image1->save("./upload/test.png", IMAGETYPE_PNG);
    }

}
