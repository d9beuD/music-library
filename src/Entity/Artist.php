<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $thumbnail = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $bio = null;

    #[ORM\OneToMany(mappedBy: 'artist', targetEntity: Album::class, orphanRemoval: true)]
    private Collection $albums;

    #[ORM\ManyToMany(targetEntity: Track::class, mappedBy: 'featuring')]
    private Collection $featurings;

    public function __construct()
    {
        $this->albums = new ArrayCollection();
        $this->featurings = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): static
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(string $bio): static
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * @return Collection<int, Album>
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    public function addAlbum(Album $album): static
    {
        if (!$this->albums->contains($album)) {
            $this->albums->add($album);
            $album->setArtist($this);
        }

        return $this;
    }

    public function removeAlbum(Album $album): static
    {
        if ($this->albums->removeElement($album)) {
            // set the owning side to null (unless already changed)
            if ($album->getArtist() === $this) {
                $album->setArtist(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Track>
     */
    public function getFeaturings(): Collection
    {
        return $this->featurings;
    }

    public function addFeaturing(Track $featuring): static
    {
        if (!$this->featurings->contains($featuring)) {
            $this->featurings->add($featuring);
            $featuring->addFeaturing($this);
        }

        return $this;
    }

    public function removeFeaturing(Track $featuring): static
    {
        if ($this->featurings->removeElement($featuring)) {
            $featuring->removeFeaturing($this);
        }

        return $this;
    }
}
