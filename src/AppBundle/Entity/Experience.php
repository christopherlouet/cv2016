<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Experience
 *
 * @ORM\Table(name="experience")
 * @ORM\Entity
 */
class Experience
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="experience_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $tag;

    /**
     * @var string
     *
     * @ORM\Column(name="poste", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $poste;

    /**
     * @var string
     *
     * @ORM\Column(name="entreprise", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $entreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="debut", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $debut;

    /**
     * @var string
     *
     * @ORM\Column(name="fin", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $fin;

    /**
     * @var \AppBundle\Entity\Activite
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Activite", mappedBy="experience")
     */
    private $activites;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->activites = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set poste
     *
     * @param string $poste
     *
     * @return Experience
     */
    public function setPoste($poste)
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * Get poste
     *
     * @return string
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * Set entreprise
     *
     * @param string $entreprise
     *
     * @return Experience
     */
    public function setEntreprise($entreprise)
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise
     *
     * @return string
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    /**
     * Set debut
     *
     * @param string $debut
     *
     * @return Experience
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut
     *
     * @return string
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin
     *
     * @param string $fin
     *
     * @return Experience
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return string
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Add activite
     *
     * @param Activite $activite
     *
     * @return Experience
     */
    public function addActivite(Activite $activite)
    {
        $this->activites[] = $activite;

        return $this;
    }

    /**
     * Remove activite
     *
     * @param Activite $activite
     */
    public function removeActivite(Activite $activite)
    {
        $this->activites->removeElement($activite);
    }

    /**
     * Get activites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActivites()
    {
        return $this->activites;
    }

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return Experience
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }
}
