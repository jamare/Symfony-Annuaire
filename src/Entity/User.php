<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="user_type", type="string")
 * @ORM\DiscriminatorMap({"provider" = "Provider", "customer" = "Customer"})
 */

abstract class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $adressNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $adress;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $banished = false;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $email;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $confirmed;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $registration;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $password;

    /**
     * @ORM\Column(type="integer")
     */
    protected $attempt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CodePostal", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $code_postal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Localite", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $localite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdressNumber(): ?string
    {
        return $this->adressNumber;
    }

    public function setAdressNumber(?string $adressNumber): self
    {
        $this->adressNumber = $adressNumber;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getBanished(): ?bool
    {
        return $this->banished;
    }

    public function setBanished(bool $banished): self
    {
        $this->banished = $banished;

        return $this;
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

    public function getConfirmed(): ?bool
    {
        return $this->confirmed;
    }

    public function setConfirmed(bool $confirmed): self
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    public function getRegistration(): ?\DateTimeInterface
    {
        return $this->registration;
    }

    public function setRegistration(\DateTimeInterface $registration): self
    {
        $this->registration = $registration;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getAttempt(): ?int
    {
        return $this->attempt;
    }

    public function setAttempt(int $attempt): self
    {
        $this->attempt = $attempt;

        return $this;
    }

    public function getCodePostal(): ?CodePostal
    {
        return $this->code_postal;
    }

    public function setCodePostal(?CodePostal $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getLocalite(): ?Localite
    {
        return $this->localite;
    }

    public function setLocalite(?Localite $localite): self
    {
        $this->localite = $localite;

        return $this;
    }
}
