<?php


namespace App\Controller;


use App\Repository\CMRepository;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

    public function PostCM(Request $request, EntityManagerInterface $em, SerializerInterface $serializer){

        $data=$request->request->all();
        //dd(json_encode($data);
        $cm=$serializer->serialize($data, 'App\Entity\CM', true);
        dd($cm);

    }


    /**
     * @Route(
     * name="cm",
     * path="api/admin/cm/{id_cm}",
     * methods={"PUT"}
     * )
     */

    public function EditCM(Request $request,  ValidatorInterface $validator, SerializerInterface $serializer, EntityManagerInterface $manager, CMRepository $repository, $id_cm): Response
    {
        //dd($request);
        $cm = $repository->findOneBy(['id' => $id_cm]);
        if (!$cm) {
            return new JsonResponse("Cet utilisateur n'est pas un cm où il n'existe pas", Response::HTTP_NOT_FOUND);
        }
        else {
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
}