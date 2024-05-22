<?php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity]
#[ORM\Table(name: 'competences')]
class Competence
{
    #[ORM\Id]
    #[ORM\Column(type:'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;
    #[ORM\Column(type: 'string', length: 100)]
    private string $short_lib;
    #[ORM\Column(type: 'string', length: 500)] // Augmentez la longueur si nécessaire
    private string $long_lib;
    #[ORM\ManyToMany(targetEntity: Realisation::class, mappedBy:'competences')]
    private $realisations;
    #[ORM\ManyToMany(targetEntity: Realisationperso::class, mappedBy:'competences')]
    private $realisationpersos;
    #[ORM\ManyToMany(targetEntity: Realisationpro::class, mappedBy:'competences')]
    private $realisationpros;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->realisations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->realisationpersos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->realisationpros = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set shortLib.
     *
     * @param string $shortLib
     *
     * @return Competence
     */
    public function setShortLib($shortLib)
    {
        $this->short_lib = $shortLib;

        return $this;
    }

    /**
     * Get shortLib.
     *
     * @return string
     */
    public function getShortLib()
    {
        return $this->short_lib;
    }

    /**
     * Set longLib.
     *
     * @param string $longLib
     *
     * @return Competence
     */
    public function setLongLib($longLib)
    {
        $this->long_lib = $longLib;

        return $this;
    }

    /**
     * Get longLib.
     *
     * @return string
     */
    public function getLongLib()
    {
        return $this->long_lib;
    }

    /**
     * Add realisation.
     *
     * @param \Realisation $realisation
     *
     * @return Competence
     */
    public function addRealisation(\Realisation $realisation)
    {
        $this->realisations[] = $realisation;

        return $this;
    }

    /**
     * Remove realisation.
     *
     * @param \Realisation $realisation
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeRealisation(\Realisation $realisation)
    {
        return $this->realisations->removeElement($realisation);
    }

    /**
     * Get realisations.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRealisations()
    {
        return $this->realisations;
    }

    /**
     * Add realisationperso.
     *
     * @param \Realisationperso $realisationperso
     *
     * @return Competence
     */
    public function addRealisationperso(\Realisationperso $realisationperso)
    {
        $this->realisationpersos[] = $realisationperso;

        return $this;
    }

    /**
     * Remove realisationperso.
     *
     * @param \Realisationperso $realisationperso
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeRealisationperso(\Realisationperso $realisationperso)
    {
        return $this->realisationpersos->removeElement($realisationperso);
    }

    /**
     * Get realisationpersos.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRealisationpersos()
    {
        return $this->realisationpersos;
    }

    /**
     * Add realisationpro.
     *
     * @param \Realisationpro $realisationpro
     *
     * @return Competence
     */
    public function addRealisationpro(\Realisationpro $realisationpro)
    {
        $this->realisationpros[] = $realisationpro;

        return $this;
    }

    /**
     * Remove realisationpro.
     *
     * @param \Realisationpro $realisationpro
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeRealisationpro(\Realisationpro $realisationpro)
    {
        return $this->realisationpros->removeElement($realisationpro);
    }

    /**
     * Get realisationpros.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRealisationpros()
    {
        return $this->realisationpros;
    }
}
