<?php

namespace App\Controller;

use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\GroupeTag;
use App\Entity\Tag;
use App\Repository\GroupeTagRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GTagController extends AbstractController
{


    /**
     * @Route(
     *   name="edit",
     *   path="api/admins/grptags/{id}",
     *   methods={"PUT"}
     *     )
     */

    public function EditTAg(TagRepository $repoTag, GroupeTagRepository $repoGTag, Request $request, $id, ValidatorInterface $validator, SerializerInterface $serializer, EntityManagerInterface $manager)
    {
        $Gtag = $repoGTag->findOneBy(["id" => $id]);
        $tag= new Tag();
        $donnes = $request->getContent();
        $data = $serializer->decode($donnes, "json");
        if (!$Gtag)
        {
            return new JsonResponse("Ce groupe de tag n'existe", Response::HTTP_BAD_REQUEST, [], true);
        }
        /*else if ($data['libelle'] == $Gtag->getLibelle())
        {
            return new JsonResponse("Cette libelle existe deja", Response::HTTP_BAD_REQUEST, [], true);
        }*/
        else
            {
                if(isset($data['tags']))
                {
                     foreach ($data['tags'] as $tags)
                     {
                         //dd($tags['libelle']);
                            if(isset($tags['libelle']))
                            {
                                $testTag = $repoTag->findBy(['libelle' =>  $tags['libelle']]);

                            }
                            if(!$testTag)
                            {
                                $tag->setLibelle('libelle1')
                                    ->setDescriptif('descriptif3');
                                $manager->persist($tag);
                                $Gtag->addTag($tag);
                            }

                            else
                            {
                                $Gtag->addTag($testTag[0]);
                            }
                         //dd($tag);
                     }
                     if(isset($tags['id'])){
                         $TagId=$repoTag->find($tags['id']);
                         $Gtag->removeTag($TagId);
                         $manager->persist($Gtag);
                     }
                }
            }
        //dd($tag);
             $manager->persist($Gtag);
             $manager->flush();
        return new JsonResponse("Succes", Response::HTTP_CREATED);
    }
}
