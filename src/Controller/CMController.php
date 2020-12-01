<?php


namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CMController extends AbstractController
{
    /**
     * @Route(
     * name="add_cm",
     * path="api/admin/cm",
     * methods={"POST"}
     * )
     */

    public function PostCM(Request $request, ValidatorInterface $validator, EntityManagerInterface $em, SerializerInterface $serializer){

        $data=$request->request->all();
        //dd(json_encode($data);
        $cm=$serializer->serialize($data, 'App\Entity\CM', true);
        dd($cm);

    }
}