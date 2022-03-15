<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MembreRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;

/**
 * @ORM\Entity(repositoryClass=MembreRepository::class)
 * @ApiResource(formats={"json"},
 *     normalizationContext={"groups" = {"membre:read"}},
 *      collectionOperations={"get",
"post"={"security": "is_granted('PUBLIC_ACCESS')",
"security_message": "Only admins can add books.",}
 *     },
 *     subresourceOperations={"formats"={"json"},
"GET" ={"normalization_context"={"groups"={"membre:read"}}}
 *     }
 * )
 * @ApiFilter(SearchFilter::class, properties={"firstName"="partial", "name"="partial", "lastName"="partial", "cellule.name" = "exact"})
 * @ApiFilter(DateFilter::class, properties={"subscriptionDate"})
 *@ApiFilter(OrderFilter::class, properties={"subscriptionDate"="DESC", "firstName","name","lastName"}, arguments= {"orderParameterName" = "order"})
 */
class Membre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"membre:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"membre:read"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"membre:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"membre:read"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"membre:read"})
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"membre:read"})
     */
    private $email;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"membre:read"})
     */
    private $birthDate;

    /**
     * @ORM\Column(type="date")
     * @Groups({"membre:read"})
     */
    private $subscriptionDate;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"membre:read"})
     */
    private $sexe;

    /**
     * @ORM\ManyToOne(targetEntity=Cellule::class, inversedBy="membres")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"membre:read"})
     */
    private $cellule;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"membre:read"})
     */
    private $grade;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getSubscriptionDate(): ?\DateTimeInterface
    {
        return $this->subscriptionDate;
    }

    public function setSubscriptionDate(\DateTimeInterface $subscriptionDate): self
    {
        $this->subscriptionDate = $subscriptionDate;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getCellule(): ?Cellule
    {
        return $this->cellule;
    }

    public function setCellule(?Cellule $cellule): self
    {
        $this->cellule = $cellule;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(?string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }
}
