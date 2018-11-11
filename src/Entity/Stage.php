<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StageRepository")
 */
class Stage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $display_start;

    /**
     * @ORM\Column(type="date")
     */
    private $display_end;

    /**
     * @ORM\Column(type="date")
     */
    private $start;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $end;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $price;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $additional_information;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Provider", inversedBy="stages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $provider;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDisplayStart(): ?\DateTimeInterface
    {
        return $this->display_start;
    }

    public function setDisplayStart(\DateTimeInterface $display_start): self
    {
        $this->display_start = $display_start;

        return $this;
    }

    public function getDisplayEnd(): ?\DateTimeInterface
    {
        return $this->display_end;
    }

    public function setDisplayEnd(\DateTimeInterface $display_end): self
    {
        $this->display_end = $display_end;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getAdditionalInformation(): ?string
    {
        return $this->additional_information;
    }

    public function setAdditionalInformation(?string $additional_information): self
    {
        $this->additional_information = $additional_information;

        return $this;
    }

    public function getProvider(): ?Provider
    {
        return $this->provider;
    }

    public function setProvider(?Provider $provider): self
    {
        $this->provider = $provider;

        return $this;
    }
}
