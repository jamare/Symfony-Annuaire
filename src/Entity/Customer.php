<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Table(name="customer")
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 */
class Customer extends User
{

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Vous devez renseigner votre nom de famille")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Vous devez renseigner votre prénom")
     *
     */
    private $firstName;

    /**
     * @ORM\Column(type="boolean")
     */
    private $newsletter;

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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getNewsletter(): ?bool
    {
        return $this->newsletter;
    }

    public function setNewsletter(bool $newsletter): self
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /*function __toString()
    {
        return $this->getFirstName()." ".$this->getName();
    }*/


}
