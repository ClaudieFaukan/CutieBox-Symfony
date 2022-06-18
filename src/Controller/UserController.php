<?php

namespace App\Controller;


use DateTime;
use Aws\S3\S3Client;
use Aws\S3\ObjectUploader;
use Aws\S3\MultipartUploader;
use Aws\Exception\AwsException;
use Aws\Credentials\Credentials;
use Aws\S3\Exception\S3Exception;
use App\Repository\UserRepository;
use Aws\Exception\MultipartUploadException;
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
     *@Route("/home/{id}/{uniqId}", name="home_user")
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
     *@Route("/home/{id}/{uniqId}/Gallery", name="gallery_user")
     */
    public function galleryUser($id,$uniqId, UserRepository $userRepository): Response
    {
        $user = $userRepository->findOneBy(['id' => $id]);
        $userUniqId = $user->getUniqId();

        if ($userUniqId != $uniqId) {
            throw new NotFoundHttpException("Vous n'êtes pas autorisé, veuillez vérifier votre lien");
        }
        $nameEvent = $user->getUniqId();

        
        return $this->render('home/gallery.html.twig',[

        ]);
    }

    /**
     * @Route("/home/createTemplate/{id}/{uniqId}", name="create_template")
     */
    public function customizeTemplate($id,$uniqId,  UserRepository $userRepository): Response
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
        //Templates
        

        return $this->render("user/createTemplate.html.twig");
    }

    public function clientAWS(){
        
        $credentials = new Credentials("AKIATLVUUOG55LE2SVDP","4Ly2rBdXGxl20cHiT36D7x6UNdgPdnIahzB/+ZeD");

        $options = [
            'region'            => 'eu-west-3',
            'version'           => 'latest',
            'credentials'       => $credentials
        ];

        $s3 = new S3Client($options);

        return $s3;
    }

    public function createGallery($nameEvent){

        $s3 = $this->clientAWS();
 
        $bucketName = $nameEvent;

        try{
            $s3->createBucket(['Bucket' => $bucketName]);
        } catch (S3Exception $e) {
            // Catch an S3 specific exception.
            echo $e->getMessage();
        } catch (AwsException $e) {
            // This catches the more generic AwsException. You can grab information
            // from the exception using methods of the exception object.
            echo $e->getAwsRequestId() . "\n";
            echo $e->getAwsErrorType() . "\n";
            echo $e->getAwsErrorCode() . "\n";
        
            // This dumps any modeled response data, if supported by the service
            // Specific members can be accessed directly (e.g. $e['MemberName'])
            var_dump($e->toArray());
        }
    }

    public function addImageToGallery($nameEvent,$nameImage){

        $s3 = $this->clientAWS();

        $key = $nameImage;

        $bucketName = $nameEvent;
        //TODO modif path image 
        $source = fopen("./upload/tosend1615211069712.png",'rb');

        $acl = 'public-read';

        $uploader = new ObjectUploader($s3,$bucketName,$key,$source,$acl);

        do {
            try {
                $result = $uploader->upload();
                if ($result["@metadata"]["statusCode"] == '200') {
                    //print('<p>File successfully uploaded to ' . $result["ObjectURL"] . '.</p>');
                }
            } catch (MultipartUploadException $e) {
                rewind($source);
                $uploader = new MultipartUploader($s3, $source, [
                    'state' => $e->getState(),
                ]);
            }
        } while (!isset($result));
    }


    public function findAllImageGallery($nameEvent){

        $s3 = $this->clientAWS();
        $bucketName = $nameEvent;

        $gallery = [];

        $result = $s3->listObjects([
            'Bucket' => $bucketName
        ]);

        foreach ($result['Contents'] as $object) {
            
            $url = $s3->getObjectUrl($bucketName,$object['Key']);
            array_push($gallery,$url);
        };

        return $gallery;
    }

    public function generateUniqueId()
    {
        $randomInt = random_int(0, 9999);
        $uniqueId = uniqid();
        $uniqueId = $uniqueId . $randomInt;
        
        return $uniqueId;
    }


}
