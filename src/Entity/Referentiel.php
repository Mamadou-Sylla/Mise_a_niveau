<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ReferentielRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=ReferentielRepository::class)
 * @UniqueEntity(fields="libelle", message="Une référentiel existe déjà avec cette libelle.")
 * @ApiResource(
 *     normalizationContext={"groups"={"referentiel:read"}},
 *     denormalizationContext={"groups"={"referentiel:write"}},
 *     routePrefix="/admins",
 *     attributes={
 *           "security"="is_granted('ROLE_Admin') or is_granted('ROLE_Formateur') or is_granted('ROLE_CM')",
 *           "security_message"="Vous n'avez pas acces à ce ressource"
 *            },
 *    collectionOperations={
 *        "get"={"path"="/referentiels"},
 *        "get"={"path"="/referentiels/grpecompetences", "normalization_context"={"groups"={"grpe_competence:read"}}},
 *         "post"={"method"="POST", "path"="/referentiels", "route_name"="referentiel"}
 *          }
 * )
 */
class Referentiel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"referentiel:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     * @Groups({"referentiel:read", "referentiel:write"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     * @Groups({"referentiel:read", "referentiel:write"})
     */
    private $presentation;

    /**
     * @ORM\Column(type="blob")
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     * @Groups({"referentiel:write"})
     */
    private $programme;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     * @Groups({"referentiel:read", "referentiel:write"})
     */
    private $critereAdmission;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     * @Groups({"referentiel:read", "referentiel:write"})
     */
    private $critereEvaluation;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCompetence::class, inversedBy="referentiels", cascade={"persist"})
     * @Groups({"referentiel:read", "grpe_competence:read"})
     */
    private $groupecompetence;

    public function __construct()
    {
        $this->groupecompetence = new ArrayCollection();
    }

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

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getProgramme(): ?string
    {
        return $this->programme;
    }

    public function setProgramme( $programme): self
    {
        $this->programme = $programme;

        return $this;
    }

    public function getCritereAdmission(): ?string
    {
        return $this->critereAdmission;
    }

    public function setCritereAdmission(string $critereAdmission): self
    {
        $this->critereAdmission = $critereAdmission;

        return $this;
    }

    public function getCritereEvaluation(): ?string
    {
        return $this->critereEvaluation;
    }

    public function setCritereEvaluation(string $critereEvaluation): self
    {
        $this->critereEvaluation = $critereEvaluation;

        return $this;
    }

    /**
     * @return Collection|GroupeCompetence[]
     */
    public function getGroupecompetence(): Collection
    {
        return $this->groupecompetence;
    }

    public function addGroupecompetence(GroupeCompetence $groupecompetence): self
    {
        if (!$this->groupecompetence->contains($groupecompetence)) {
            $this->groupecompetence[] = $groupecompetence;
        }

        return $this;
    }

    public function removeGroupecompetence(GroupeCompetence $groupecompetence): self
    {
        $this->groupecompetence->removeElement($groupecompetence);

        return $this;
    }
}
