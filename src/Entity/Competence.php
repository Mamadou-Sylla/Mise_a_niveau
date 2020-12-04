<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass=CompetenceRepository::class)
 * @UniqueEntity(fields="libelle", message="Une competence existe déjà avec cette libelle.")
 * @ApiResource(
 *    normalizationContext={"groups"={"competence:read"}},
 *    denormalizationContext={"groups"={"competence:write"}},
 *
 *     attributes={
 *      "security"="is_granted('ROLE_Admin')",
 *      "security_message"="Vous n'avez pas acces à ce ressource"
 * },
 *     collectionOperations={
 *        "get"={"path"="/admin/competences"},
 *        "post"={"path"="/admin/competences"}
 *     },
 *      itemOperations={
 *     "get"={"path"="/admin/competences/{id}"},
 *     "put"={"path"="/admin/competences/{id}"}
 *     }
 * )
 */
class Competence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"competence:read", "grpcompetence:read", "grpe_competence:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"competence:read", "competence:write", "grpcompetence:read", "grpcompetence:write", "grpe_competence:read"})
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Niveau::class, mappedBy="competence", cascade={"persist"})
     * @ApiSubresource()
     * @Groups({"competence:read","competence:write", "grpcompetence:read", "grpcompetence:write"})
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     * @Assert\Count(
     *      min = 3,
     *      max = 3,
     *      minMessage = "Veuillez ajouter minimum 3 niveau",
     *      maxMessage = "Veuillez ajouter maximum 3 niveau"
     * )
     */
    private $niveau;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCompetence::class, mappedBy="competence")
     */
    private $groupeCompetences;



    public function __construct()
    {
        $this->niveau = new ArrayCollection();
        $this->groupeCompetences = new ArrayCollection();
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

    /**
     * @return Collection|Niveau[]
     */
    public function getNiveau(): Collection
    {
        return $this->niveau;
    }

    public function addNiveau(Niveau $niveau): self
    {
        if (!$this->niveau->contains($niveau)) {
            $this->niveau[] = $niveau;
            $niveau->setCompetence($this);
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): self
    {
        if ($this->niveau->removeElement($niveau)) {
            // set the owning side to null (unless already changed)
            if ($niveau->getCompetence() === $this) {
                $niveau->setCompetence(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GroupeCompetence[]
     */
    public function getGroupeCompetences(): Collection
    {
        return $this->groupeCompetences;
    }

    public function addGroupeCompetence(GroupeCompetence $groupeCompetence): self
    {
        if (!$this->groupeCompetences->contains($groupeCompetence)) {
            $this->groupeCompetences[] = $groupeCompetence;
            $groupeCompetence->addCompetence($this);
        }

        return $this;
    }

    public function removeGroupeCompetence(GroupeCompetence $groupeCompetence): self
    {
        if ($this->groupeCompetences->removeElement($groupeCompetence)) {
            $groupeCompetence->removeCompetence($this);
        }

        return $this;
    }





}
