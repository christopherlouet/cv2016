<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formation
 *
 * @ORM\Table(name="formation")
 * @ORM\Entity
 */
class Formation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="formation_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="ecole", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $ecole;

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
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="validation", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $validation;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $niveau;


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
     * Set ecole
     *
     * @param string $ecole
     *
     * @return Formation
     */
    public function setEcole($ecole)
    {
        $this->ecole = $ecole;

        return $this;
    }

    /**
     * Get ecole
     *
     * @return string
     */
    public function getEcole()
    {
        return $this->ecole;
    }

    /**
     * Set debut
     *
     * @param string $debut
     *
     * @return Formation
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
     * @return Formation
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
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Formation
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set validation
     *
     * @param string $validation
     *
     * @return Formation
     */
    public function setValidation($validation)
    {
        $this->validation = $validation;

        return $this;
    }

    /**
     * Get validation
     *
     * @return string
     */
    public function getValidation()
    {
        return $this->validation;
    }

    /**
     * Set niveau
     *
     * @param string $niveau
     *
     * @return Formation
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return string
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return Formation
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
