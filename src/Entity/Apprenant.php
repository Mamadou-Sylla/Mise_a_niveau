<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use App\Repository\ApprenantRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ApprenantRepository::class)
 *  @ApiResource(
 *     normalizationContext={"groups"={"apprenant:read"}},
 *    denormalizationContext={"groups"={"apprenant:write"}},
 *      routePrefix="/admin",
 *     attributes={
 *      "security"="is_granted('ROLE_Admin')",
 *      "security_message"="Vous n'avez pas acces à ce ressource"
 * },
 *     collectionOperations={
 *        "get"={"path"="/apprenants"},
 *        "post_apprenant"=
 *       {
 *           "method"="POST",
 *           "path"="/apprenants",
 *          "route_name"="apprenant"
 *       }
 *     },
 *      itemOperations={
 *     "get"={"path"="/apprenants/{id_apprenant}"},
 *     "add_apprenant"={"method"="PUT", "path"="/apprenants/{id_apprenant}", "route_name"="admin"},
 *     }
 * )
 */
class Apprenant extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @ApiProperty(identifier=true)
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le statut est obligatoire")
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="L'adresse est obligatoire")
     */
    private $adresse;

    /**
     * @ORM\Column(type="blob", length=255, nullable=true)
     */
    private $avatar;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
}
