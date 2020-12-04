<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\GroupeCompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass=GroupeCompetenceRepository::class)
 * @UniqueEntity(fields="libelle", message="Une Groupe de competeence existe déjà avec cette libelle.")
 * @ApiResource(
 *     normalizationContext={"groups"={"grpcompetence:read"}},
 *     denormalizationContext={"groups"={"grpcompetence:write"}},
 *     routePrefix="/admins",
 *        attributes={
 *      "security"="is_granted('ROLE_Admin') or is_granted('ROLE_Formateur') and is_granted('ROLE_CM')",
 *      "security_message"="Vous n'avez pas acces à ce ressource"
 * },
 *     collectionOperations={
 *        "get"={"path"="/grpcompetences"},
 *        "post"={"path"="/grpcompetences"}
 *     },
 *      itemOperations={
 *     "get"={"path"="/grpcompetences/{id}/competence"},
 *     "put"={"path"="/grpcompetences/{id}"}
 *     }
 * )
 */
class GroupeCompetence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"grpcompetence:read", "referentiel:read", "grpe_competence:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"grpcompetence:read", "grpcompetence:write", "referentiel:read", "grpe_competence:read"})
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"grpcompetence:read", "grpcompetence:write", "referentiel:read", "grpe_competence:read"})
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $descriptif;

    /**
     * @ORM\ManyToMany(targetEntity=Competence::class, inversedBy="groupeCompetences", cascade={"persist"})
     * @ApiSubresource()
     * @Groups({"grpcompetence:read", "grpcompetence:write", "grpe_competence:read"})
     */
    private $competence;

    /**
     * @ORM\ManyToMany(targetEntity=Referentiel::class, mappedBy="groupecompetence",cascade={"persist"})
     */
    private $referentiels;

    public function __construct()
    {
        $this->competence = new ArrayCollection();
        $this->referentiels = new ArrayCollection();
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

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }


    /**
     * @return Collection|Competence[]
     */
    public function getCompetence(): Collection
    {
        return $this->competence;
    }

    public function addCompetence(Competence $competence): self
    {
        if (!$this->competence->contains($competence)) {
            $this->competence[] = $competence;
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): self
    {
        $this->competence->removeElement($competence);

        return $this;
    }

    /**
     * @return Collection|Referentiel[]
     */
    public function getReferentiels(): Collection
    {
        return $this->referentiels;
    }

    public function addReferentiel(Referentiel $referentiel): self
    {
        if (!$this->referentiels->contains($referentiel)) {
            $this->referentiels[] = $referentiel;
            $referentiel->addGroupecompetence($this);
        }

        return $this;
    }

    public function removeReferentiel(Referentiel $referentiel): self
    {
        if ($this->referentiels->removeElement($referentiel)) {
            $referentiel->removeGroupecompetence($this);
        }

        return $this;
    }




}
