<?php


namespace App\Service;

use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\Profil;
use App\Entity\User;
use App\Repository\ProfilRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;



class UserService
{
    private $serializer;
    private $validator;
    private $encoder;
    private $manager;
    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator, UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager){
        $this->serializer=$serializer;
        $this->validator=$validator;
        $this->encoder=$encoder;
        $this->manager=$manager;
    }
    public function PostUser(Request $request){

        $post_user = $request->request->all();
        //dd($post_user);
        $user= $this->serializer->denormalize($post_user, 'App\Entity\User', 'json');
        dd($user);
        //$user=json_encode(json_decode($post_user), true);
        //dd($user[]);
        /*$errors = $this->validator->validate($user);
         if ($errors) {
             $errorsString =$this->serializer->serialize($errors,"json");
             return new JsonResponse( $errorsString ,Response::HTTP_BAD_REQUEST,[],true);
         }*/

        //$password = $user->getPassword();
        //$user=$user->setPassword($this->encoder->encodePassword($user, $password));
        //dd($user);

        $this->manager->persist($user);
        $this->manager->flush();
        return new JsonResponse("vous avez ajouter un user succes",Response::HTTP_CREATED,[],true);
    }

}