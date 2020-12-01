<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 * @ORM\Table(name="`admin`")
 * @ApiResource(
 *     normalizationContext={"groups"={"admin:read"}},
 *    denormalizationContext={"groups"={"admin:write"}},
 *
 *     attributes={
 *      "security"="is_granted('ROLE_Admin')",
 *      "security_message"="Vous n'avez pas acces à ce ressource"
 * },
 *     collectionOperations={
 *        "get"={"path"="/admin"},
 *        "post_user"=
 *       {
 *           "method"="POST",
 *           "path"="/admin",
 *          "route_name"="add_user"
 *       }
 *     },
 *      itemOperations={
 *     "get"={"path"="/admin/{id}"},
 *     "put_user"={"method"="PUT", "path"="/admin/{id_admin}", "route_name"="admin"},
 *
 *     }
 * )
 */
class Admin extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"admin:read"})
     * @ApiProperty(identifier=true)
     */
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
