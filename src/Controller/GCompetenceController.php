<?php

namespace App\Controller;

use ApiPlatform\Core\Validator\ValidatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GCompetenceController extends AbstractController
{
    /**
     * @Route("/g/competence", name="g_competence")
     */
    public function EditUser(Request $request, ValidatorInterface $validator, SerializerInterface $serializer, EntityManagerInterface $manager)
    {

        $data = json_decode($request->getContent());

        $errors = $validator->validate($data);
        if ($errors) {
            $errorsString =$serializer->serialize($errors,"json");
            return new JsonResponse( $errorsString ,Response::HTTP_BAD_REQUEST,[],true);
        }
        $manager->flush();
        return new JsonResponse($data, 200);

    }
}
