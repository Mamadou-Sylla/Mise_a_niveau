<?php

namespace App\Entity;

use App\Repository\GroupeTagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * @ORM\Entity(repositoryClass=GroupeTagRepository::class)
 * @UniqueEntity(fields="libelle", message="Une Groupe de tag existe déjà avec cette libelle.")
 *  @ApiResource(
 *      denormalizationContext={"groups"={"groupetags:write"}},
 *     routePrefix="/admins",
 *           attributes={
 *           "security"="is_granted('ROLE_Admin')",
 *           "security_message"="Vous n'avez pas acces à ce ressource",
 *           "pagination_items_per_page"=30,
 *            "normalizationContext"={"groups"={"groupetags:read"}},
 *           },
 *     collectionOperations={
 *     "get"={"path"="/grptags"},
 *      "post"={ "path"="/grptags"}
 *    },
 *      itemOperations={
 *     "get"={"path"="/grptags/{id}"},
 *     "get"={"path"="/grptags/{id}/tags"},
 *     "putTag"={"method"="PUT", "path"="/grptags/{id}", "route_name"="edit"},
 *     "delete"={"path"="/grptags/{id}/tags"},
 *    }
 * )
 */
class GroupeTag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"groupetags:read", "groupetags:write"})
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="groupeTags", cascade={"persist"})
     * @Groups({"groupetags:read", "groupetags:write"})
     */
    private $Tag;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"groupetags:read", "groupetags:write"})
     */
    private $isDeleted=false;

    public function __construct()
    {
        $this->Tag = new ArrayCollection();
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
     * @return Collection|Tag[]
     */
    public function getTag(): Collection
    {
        return $this->Tag;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->Tag->contains($tag)) {
            $this->Tag[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->Tag->removeElement($tag);

        return $this;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }
}
