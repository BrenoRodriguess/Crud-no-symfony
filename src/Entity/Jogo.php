<?php

namespace App\Entity;

use App\Repository\JogoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JogoRepository::class)
 */
class Jogo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\ManyToOne(targetEntity=VideoGame::class, inversedBy="jogos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $videoGame;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getVideoGame(): ?VideoGame
    {
        return $this->videoGame;
    }

    public function setVideoGame(?VideoGame $videoGame): self
    {
        $this->videoGame = $videoGame;

        return $this;
    }
}
