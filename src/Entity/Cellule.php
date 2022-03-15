<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\CelluleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CelluleRepository::class)
 * @ApiResource(formats={"json"},
 * normalizationContext={"groups" = {"membre:read"}},
 *     subresourceOperations={
            "GET" ={"normalization_context"={"groups"={"membre:read"}}}
 *     }
 * )
 */
class Cellule
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
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Commune::class, inversedBy="cellules")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"membre:read"})
     */
    private $commune;

    /**
     * @ApiSubresource()
     * @ORM\OneToMany(targetEntity=Membre::class, mappedBy="cellule", orphanRemoval=true)
     */
    private $membres;

    public function __construct()
    {
        $this->membres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCommune(): ?Commune
    {
        return $this->commune;
    }

    public function setCommune(?Commune $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    /**
     * @return Collection<int, Membre>
     */
    public function getMembres(): Collection
    {
        return $this->membres;
    }

    public function addMembre(Membre $membre): self
    {
        if (!$this->membres->contains($membre)) {
            $this->membres[] = $membre;
            $membre->setCellule($this);
        }

        return $this;
    }

    public function removeMembre(Membre $membre): self
    {
        if ($this->membres->removeElement($membre)) {
            // set the owning side to null (unless already changed)
            if ($membre->getCellule() === $this) {
                $membre->setCellule(null);
            }
        }

        return $this;
    }
}
