<?php

namespace App\Entity;

use App\Repository\EtablissementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: EtablissementsRepository::class)]
class Etablissements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $designation;

    #[ORM\Column(type: 'string', length: 100)]
    private $forme;

    #[ORM\Column(type: 'string', length: 255)]
    private $adresse;

    #[ORM\Column(type: 'string', length: 60)]
    private $numDecisionCreation;

    #[ORM\Column(type: 'string', length: 60)]
    private $numDecisionOuverture;

    #[ORM\Column(type: 'date', nullable: true)]
    private $DateOuverture;

    #[ORM\Column(type: 'string', length: 60, nullable: true)]
    private $numSocial;

    #[ORM\Column(type: 'string', length: 60, nullable: true)]
    private $numFiscal;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $cpteBancaire;

    #[ORM\Column(type: 'string', length: 30)]
    private $telephone;

    #[ORM\Column(type: 'string', length: 30, nullable: true)]
    private $telephoneMobile;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\OneToMany(mappedBy: 'etablissement', targetEntity: Enseignements::class)]
    private $enseignements;

    #[ORM\OneToMany(mappedBy: 'etablissement', targetEntity: Users::class)]
    private $users;

    #[ORM\Column(type: 'string', length: 128, unique: true)]
    #[Gedmo\Slug(fields: ['designation'])]
    private $slug;

    public function __construct()
    {
        $this->enseignements = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->designation;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getForme(): ?string
    {
        return $this->forme;
    }

    public function setForme(string $forme): self
    {
        $this->forme = $forme;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNumDecisionCreation(): ?string
    {
        return $this->numDecisionCreation;
    }

    public function setNumDecisionCreation(string $numDecisionCreation): self
    {
        $this->numDecisionCreation = $numDecisionCreation;

        return $this;
    }

    public function getNumDecisionOuverture(): ?string
    {
        return $this->numDecisionOuverture;
    }

    public function setNumDecisionOuverture(string $numDecisionOuverture): self
    {
        $this->numDecisionOuverture = $numDecisionOuverture;

        return $this;
    }

    public function getDateOuverture(): ?\DateTimeInterface
    {
        return $this->DateOuverture;
    }

    public function setDateOuverture(?\DateTimeInterface $DateOuverture): self
    {
        $this->DateOuverture = $DateOuverture;

        return $this;
    }

    public function getNumSocial(): ?string
    {
        return $this->numSocial;
    }

    public function setNumSocial(?string $numSocial): self
    {
        $this->numSocial = $numSocial;

        return $this;
    }

    public function getNumFiscal(): ?string
    {
        return $this->numFiscal;
    }

    public function setNumFiscal(?string $numFiscal): self
    {
        $this->numFiscal = $numFiscal;

        return $this;
    }

    public function getCpteBancaire(): ?string
    {
        return $this->cpteBancaire;
    }

    public function setCpteBancaire(?string $cpteBancaire): self
    {
        $this->cpteBancaire = $cpteBancaire;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getTelephoneMobile(): ?string
    {
        return $this->telephoneMobile;
    }

    public function setTelephoneMobile(?string $telephoneMobile): self
    {
        $this->telephoneMobile = $telephoneMobile;

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

    /**
     * @return Collection<int, Enseignements>
     */
    public function getEnseignements(): Collection
    {
        return $this->enseignements;
    }

    public function addEnseignement(Enseignements $enseignement): self
    {
        if (!$this->enseignements->contains($enseignement)) {
            $this->enseignements[] = $enseignement;
            $enseignement->setEtablissement($this);
        }

        return $this;
    }

    public function removeEnseignement(Enseignements $enseignement): self
    {
        if ($this->enseignements->removeElement($enseignement)) {
            // set the owning side to null (unless already changed)
            if ($enseignement->getEtablissement() === $this) {
                $enseignement->setEtablissement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Users $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setEtablissement($this);
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getEtablissement() === $this) {
                $user->setEtablissement(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
