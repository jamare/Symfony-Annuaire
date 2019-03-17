<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table(name="provider")
 * @ORM\Entity(repositoryClass="App\Repository\ProviderRepository")
 */
class Provider extends User
{

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseigner le nom de l'entreprise")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     * @Assert\Email(message="L'email '{{ value }}' n'est pas valide, veuillez vérifier")
     */
    private $emailContact;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^((\+|00)32\s?|0)4(60|[789]\d)(\s?\d{2}){3}$/",
     *     message="Le numéro de téléphone '{{ value }}' n'est pas valide.")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Regex(
     *      pattern="/(BE)?0[0-9]{9}/",
     *      message="Le numéro de TVA '{{ value }}' n'est pas valide.")
     */
    private $tva;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     * @Assert\Url(message="Veuillez renseigner une url valide")
     */
    private $web;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Services", inversedBy="providers")
     */
    private $services;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Stage", mappedBy="provider", orphanRemoval=true)
     */
    private $stages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Logos", mappedBy="Provider")
     */
    private $logos;



    public function __construct()
    {
        $this->services = new ArrayCollection();
        $this->stages = new ArrayCollection();
        $this->logos = new ArrayCollection();


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

    public function getEmailContact(): ?string
    {
        return $this->emailContact;
    }

    public function setEmailContact(?string $emailContact): self
    {
        $this->emailContact = $emailContact;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getTva(): ?string
    {
        return $this->tva;
    }

    public function setTva(string $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getWeb(): ?string
    {
        return $this->web;
    }

    public function setWeb(?string $web): self
    {
        $this->web = $web;

        return $this;
    }

    /**
     * @return Collection|Services[]
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Services $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
        }

        return $this;
    }

    public function removeService(Services $service): self
    {
        if ($this->services->contains($service)) {
            $this->services->removeElement($service);
        }

        return $this;
    }

    /**
     * @return Collection|Stage[]
     */
    public function getStages(): Collection
    {
        return $this->stages;
    }

    public function addStage(Stage $stage): self
    {
        if (!$this->stages->contains($stage)) {
            $this->stages[] = $stage;
            $stage->setProvider($this);
        }

        return $this;
    }

    public function removeStage(Stage $stage): self
    {
        if ($this->stages->contains($stage)) {
            $this->stages->removeElement($stage);
            // set the owning side to null (unless already changed)
            if ($stage->getProvider() === $this) {
                $stage->setProvider(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->name;
    }

    /**
     * @return Collection|Logos[]
     */
    public function getLogos(): Collection
    {
        return $this->logos;
    }


    public function addLogo(Logos $logo): self
    {
        if (!$this->logos->contains($logo)) {
            $this->logos[] = $logo;
            $logo->setProvider($this);
        }

        return $this;
    }

    public function removeLogo(Logos $logo): self
    {
        if ($this->logos->contains($logo)) {
            $this->logos->removeElement($logo);
            // set the owning side to null (unless already changed)
            if ($logo->getProvider() === $this) {
                $logo->setProvider(null);
            }
        }

        return $this;
    }

    public function setLogos(Collection $images)
    {
        $this->images = $images;
    }

}
