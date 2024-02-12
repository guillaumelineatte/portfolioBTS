<?php

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

#[ORM\Entity]
#[ORM\Table(name: 'centres')]
class Centre
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;
    #[ORM\Column(type: 'string')]
    private string $nom;
    #[ORM\Column(type: 'string')]
    private string $adresse;
    #[ORM\Column(type: 'string')]
    private string $ville;
    #[OneToMany(mappedBy: 'centre', targetEntity: Candidat::class)]
    private Collection $candidat;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->candidat = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom.
     *
     * @param string $nom
     *
     * @return Centre
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom.
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set adresse.
     *
     * @param string $adresse
     *
     * @return Centre
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse.
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set ville.
     *
     * @param string $ville
     *
     * @return Centre
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville.
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Add candidat.
     *
     * @param \Candidat $candidat
     *
     * @return Centre
     */
    public function addCandidat(\Candidat $candidat)
    {
        $this->candidat[] = $candidat;

        return $this;
    }

    /**
     * Remove candidat.
     *
     * @param \Candidat $candidat
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCandidat(\Candidat $candidat)
    {
        return $this->candidat->removeElement($candidat);
    }

    /**
     * Get candidat.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCandidat()
    {
        return $this->candidat;
    }
}
