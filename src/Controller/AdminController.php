<?php

namespace App\Controller;

use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Admin;
use Symfony\Component\Serializer\SerializerInterface;


class AdminController extends AbstractController
{
    /**
     * @Route(
     * name="add_user",
     * path="api/admin",
     * methods={"POST"}
     * )
     */


    /*private $UserService;
  public function __construct(UserService $UserService)
   {
       $this->UserService = $UserService;
   }*/
    public function AddUser(Request $request, UserService $User): Response
    {
        //dd($request);
        $User->PostUser($request);
        return new JsonResponse("vous avez ajouter un admin succes",Response::HTTP_CREATED);
    }

    /**
     * @Route(
     *   name="admin",
     *   path="api/admin/{id_admin}",
     *   methods={"PUT"}
     *     )
     */

    public function EditAdmin(UserRepository $repo, Request $request, $id_admin, ValidatorInterface $validator, SerializerInterface $serializer, EntityManagerInterface $manager)
    {
        $user = $repo->findOneBy(["id" => $id_admin]);
        //dd($user);
      //  $data = $request->getContent();
        $data = json_decode($request->getContent());

        //dd($data);

        $errors = $validator->validate($data);
        if ($errors) {
            $errorsString =$serializer->serialize($errors,"json");
            return new JsonResponse( $errorsString ,Response::HTTP_BAD_REQUEST,[],true);
        }
        $manager->flush();
        return new JsonResponse($data, 200);

    }
}

