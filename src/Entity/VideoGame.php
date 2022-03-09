<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * VideoGame
 *
 * @ORM\Table(name="video_game")
 * @ORM\Entity
 */
class VideoGame
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    public $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    public $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    public $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Jogo::class, mappedBy="VideoGame")
     */
    private $jogos;

    public function __construct()
    {
        $this->jogos = new ArrayCollection();
    }

    /**
     * @return Collection<int, Jogo>
     */
    public function getJogos(): Collection
    {
        return $this->jogos;
    }

    public function addJogo(Jogo $jogo): self
    {
        if (!$this->jogos->contains($jogo)) {
            $this->jogos[] = $jogo;
            $jogo->setVideoGame($this);
        }

        return $this;
    }

    public function removeJogo(Jogo $jogo): self
    {
        if ($this->jogos->removeElement($jogo)) {
            // set the owning side to null (unless already changed)
            if ($jogo->getVideoGame() === $this) {
                $jogo->setVideoGame(null);
            }
        }

        return $this;
    }
}
