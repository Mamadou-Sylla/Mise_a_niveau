<?php

namespace App\Entity;

use App\Repository\FormateurRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=FormateurRepository::class)
 * @ApiResource(
 *
 *     normalizationContext={"groups"={"formateur:read"}},
 *    denormalizationContext={"groups"={"formateur:write"}},
 *
 *     routePrefix="/admin",
 *     attributes={
 *      "security"="is_granted('ROLE_Admin')",
 *      "security_message"="Vous n'avez pas acces à ce ressource"
 * },
 *     collectionOperations={
 *     "get"={"path"="/formateurs"},
 *      "post"={"path"="/formateurs"},
 *     },
 *      itemOperations={
 *     "get"={"path"="/formateurs/{id}"},
 *     "put"={"path"="/formateurs/{id}"},
 *
 *     }
 * )
 */
class Formateur extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"formateur:read"})
     */
    private $telephone;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }
}
