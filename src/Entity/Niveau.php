<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NiveauRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass=NiveauRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"niveau:read"}},
 *    denormalizationContext={"groups"={"niveau:write"}},
 *
 *     attributes={
 *      "security"="is_granted('ROLE_Admin')",
 *      "security_message"="Vous n'avez pas acces à ce ressource"
 * },
 *     collectionOperations={
 *        "get"={"path"="/admin/niveau"},
 *        "post"={"path"="/admin/niveau"}
 *     },
 *      itemOperations={
 *     "get"={"path"="/admin/niveau/{id}"},
 *     "put"={"path"="/admin/niveau/{id}"},
 *
 *     }
 * )
 */
class Niveau
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"competence:read", "grpcompetence:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"competence:read", "competence:write", "grpcompetence:read", "grpcompetence:write"})
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $libelle;


    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"competence:read", "competence:write", "grpcompetence:read", "grpcompetence:write"})
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $critereEvalution;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"competence:read", "competence:write", "grpcompetence:read", "grpcompetence:write"})
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $groupeAction;

    /**
     * @ORM\ManyToOne(targetEntity=Competence::class, inversedBy="niveau", cascade={"persist"})
     */
    private $competence;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getCritereEvalution(): ?string
    {
        return $this->critereEvalution;
    }

    public function setCritereEvalution(string $critereEvalution): self
    {
        $this->critereEvalution = $critereEvalution;

        return $this;
    }

    public function getGroupeAction(): ?string
    {
        return $this->groupeAction;
    }

    public function setGroupeAction(string $groupeAction): self
    {
        $this->groupeAction = $groupeAction;

        return $this;
    }

    public function getCompetence(): ?Competence
    {
        return $this->competence;
    }

    public function setCompetence(?Competence $competence): self
    {
        $this->competence = $competence;

        return $this;
    }
}
