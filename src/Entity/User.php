<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;

/**
 * /**
 *@ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *@ORM\InheritanceType("JOINED")
 *@ORM\DiscriminatorColumn(name="type",  type="string")
 *@ORM\DiscriminatorMap({"Admin"="Admin", "formateur" = "Formateur", "apprenant" = "Apprenant", "admin" ="User", "cm" ="CM"})
 * @ApiResource(
 *     normalizationContext={"groups"={"admin:read"}},
 *    denormalizationContext={"groups"={"admin:write"}},
 *
 *     routePrefix="/admin",
 *     attributes={
 *      "security"="is_granted('ROLE_Admin')",
 *      "security_message"="Vous n'avez pas acces à ce ressource"
 * },
 *     collectionOperations={
 *     "get"={"path"="/users"},
 *      "post"={"path"="/users"}
 *     },
 *      itemOperations={
 *     "get"={"path"="/users/{id}"},
 *     "put"={"path"="/users/{id}"},
 *
 *     }
 * )
 * @ApiFilter(BooleanFilter::class, properties={"etat"})
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"profil:read"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"profil:read", "admin:read", "cm:read","formateur:read","apprenant:read"})
     */
    protected $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({"profil:read", "admin:read", "cm:read","formateur:read","apprenant:read"})
     */
    protected $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"profil:read", "admin:read", "cm:read","formateur:read","apprenant:read"})
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"profil:read", "admin:read", "cm:read","formateur:read","apprenant:read"})
     */
    protected $lastname;

    /**
     * @ORM\ManyToOne(targetEntity=Profil::class, inversedBy="users")
     */
    protected $profil;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"profil:read", "admin:read", "cm:read","formateur:read","apprenant:read"})
     */
    protected $etat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_'.$this->profil->getLibelle();

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }
}
