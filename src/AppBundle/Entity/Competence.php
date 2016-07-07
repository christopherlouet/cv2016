<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Competence
 *
 * @ORM\Table(name="competence")
 * @ORM\Entity
 */
class Competence
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="competence_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $niveau;

    /**
     * @var \AppBundle\Entity\Domaine
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Domaine")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="domaine", referencedColumnName="id", nullable=false)
     * })
     */
    private $domaine;


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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Competence
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set niveau
     *
     * @param string $niveau
     *
     * @return Competence
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
     * Set domaine
     *
     * @param Domaine $domaine
     *
     * @return Competence
     */
    public function setDomaine(Domaine $domaine)
    {
        $this->domaine = $domaine;

        return $this;
    }

    /**
     * Get domaine
     *
     * @return Domaine
     */
    public function getDomaine()
    {
        return $this->domaine;
    }
}
