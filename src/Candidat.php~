<?php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity]
#[ORM\Table(name: 'candidats')]

class Candidat
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;
    #[ORM\Column(type: 'string')]
    private string $nom;
    #[ORM\Column(type: 'string')]
    private string $prenom;
    #[ORM\Column(type: 'string')]
    private string $numero_candidat;
    #[ORM\Column(type: 'string')]
    private string $option;
    #[ManyToOne(targetEntity: Centre::class)]
    #[JoinColumn(name: 'centre_formation_id', referencedColumnName:'id')]
    private Centre|null $centre = null;
    #[ORM\Column(type: 'string')]
    private string $url;
    #[ORM\Column(type: 'string')]
    private string $avatar;

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
     * @return Candidat
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
     * Set prenom.
     *
     * @param string $prenom
     *
     * @return Candidat
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom.
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set numeroCandidat.
     *
     * @param string $numeroCandidat
     *
     * @return Candidat
     */
    public function setNumeroCandidat($numeroCandidat)
    {
        $this->numero_candidat = $numeroCandidat;

        return $this;
    }

    /**
     * Get numeroCandidat.
     *
     * @return string
     */
    public function getNumeroCandidat()
    {
        return $this->numero_candidat;
    }

    /**
     * Set option.
     *
     * @param string $option
     *
     * @return Candidat
     */
    public function setOption($option)
    {
        $this->option = $option;

        return $this;
    }

    /**
     * Get option.
     *
     * @return string
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * Set url.
     *
     * @param string $url
     *
     * @return Candidat
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set avatar.
     *
     * @param string $avatar
     *
     * @return Candidat
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar.
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set centre.
     *
     * @param \Centre|null $centre
     *
     * @return Candidat
     */
    public function setCentre(\Centre $centre = null)
    {
        $this->centre = $centre;

        return $this;
    }

    /**
     * Get centre.
     *
     * @return \Centre|null
     */
    public function getCentre()
    {
        return $this->centre;
    }
}
