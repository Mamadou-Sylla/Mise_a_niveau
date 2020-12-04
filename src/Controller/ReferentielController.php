<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\Referentiel;


class ReferentielController extends AbstractController
{
    /**
     * @Route(name="referentiel", path="api/admins/referentiels", methods={"POST"})
     */

    public function AddReferentiel(Request $request, SerializerInterface $serializer,ValidatorInterface $validator , EntityManagerInterface $manager): Response
    {
        $postReferentiel = $request->request->all();
        $file = $request->files->get("programme");
        //dd($file);
        $Referentiel = $serializer->denormalize($postReferentiel,"App\Entity\Referentiel", 'json');
        //dd($Referentiel);
        $file = fopen($file->getRealPath(),"rb");
        $Referentiel->setProgramme($file);
        $errors = $validator->validate($Referentiel);
        if ($errors){
            $errors = $serializer->serialize($errors,"json");
            return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
        }
        $manager->persist($Referentiel);
        $manager->flush();
        fclose($file);
        return new JsonResponse("Succes",Response::HTTP_CREATED);
    }
}
