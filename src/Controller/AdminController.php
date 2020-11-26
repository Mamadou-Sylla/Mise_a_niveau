<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Admin;


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
}

