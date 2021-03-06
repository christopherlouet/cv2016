<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activite
 *
 * @ORM\Table(name="activite")
 * @ORM\Entity
 */
class Activite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="activite_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $libelle;

    /**
     * @var \AppBundle\Entity\Experience
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Experience")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="experience", referencedColumnName="id", nullable=false)
     * })
     */
    private $experience;

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
     * @return Activite
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
     * Set experience
     *
     * @param Experience $experience
     *
     * @return Activite
     */
    public function setExperience(Experience $experience)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Get experience
     *
     * @return Experience
     */
    public function getExperience()
    {
        return $this->experience;
    }
}
