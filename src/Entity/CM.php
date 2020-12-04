<?php

namespace App\Entity;

use App\Repository\CMRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use ApiPlatform\Core\Annotation\ApiResource;


/**
 * @ORM\Entity(repositoryClass=CMRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"apprenant:read"}},
 *    denormalizationContext={"groups"={"apprenant:write"}},
 *
 *     routePrefix="/admin",
 *     attributes={
 *      "security"="is_granted('ROLE_Admin')",
 *      "security_message"="Vous n'avez pas acces à ce ressource"
 * },
 *     collectionOperations={
 *     "get"={"path"="/cm"},
 *      "post_cm"=
 *       {
 *           "method"="POST",
 *           "path"="/cm",
 *          "route_name"="add_cm"
 *       }
 *     },
 *      itemOperations={
 *     "get"={"path"="/cm/{id}"},
 *     "edit_cm"={"method"="PUT", "path"="/cm/{id_cm}", "route_name"="cm"},
 *
 *     }
 * )
 */
class CM extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
