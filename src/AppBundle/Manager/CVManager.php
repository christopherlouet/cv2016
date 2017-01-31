<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Domaine;
use AppBundle\Entity\Experience;
use AppBundle\Entity\Formation;
use AppBundle\Entity\Profil;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Created by Christopher LOUËT.
 * User: Christopher LOUËT
 * Date: 30/01/17
 * Time: 20:42
 */
class CVManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * CVManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct (EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @return array|null
     */
    public function getProfil()
    {
        $profil = null;
        $repository = $this->em->getRepository(Profil::class);
        $data = $repository->findAll();
        if (count($data)>0)
            $profil = $data[0];

        return $profil;
    }

    /**
     * @return array|null
     */
    public function getDomaines()
    {
        $domaines = null;
        $repository = $this->em->getRepository(Domaine::class);
        $data = $repository->findAll();
        if (count($data)>0)
            $domaines = $data;

        return $domaines;
    }

    /**
     * @return array|null
     */
    public function getExperiences()
    {
        $experiences = null;
        $repository = $this->em->getRepository(Experience::class);
        $data = $repository->findAll();
        if (count($data)>0)
            $experiences = $data;

        return $experiences;
    }

    /**
     * @return array|null
     */
    public function getFormations()
    {
        $formations = null;
        $repository = $this->em->getRepository(Formation::class);
        $data = $repository->findAll();
        if (count($data)>0)
            $formations = $data;

        return $formations;
    }
}