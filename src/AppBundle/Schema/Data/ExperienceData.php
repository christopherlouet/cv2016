<?php

namespace AppBundle\Schema\Data;

use AppBundle\Entity\Activite;
use AppBundle\Entity\Experience;
use AppBundle\Schema\Model\SchemaData;

/**
 * Class ExperienceData.
 * @package AppBundle\Schema\Data
 */
class ExperienceData extends SchemaData
{
    const FILE_EXPERIENCE = 'experience';

    public function update()
    {
        $this->updateExperience();
    }

    public function clean()
    {
        $this->cleanExperience();
    }

    private function updateExperience()
    {
        $file = self::FILE_EXPERIENCE . '.' . $this->parser->getExtension();
        $datas = $this->parser->toArray($this->pathDataset, $file);
        $repository = $this->em->getRepository('AppBundle:Experience');

        foreach ($datas as $data)
        {
            $tag = $data['tag'];
            $poste = $data['poste'];
            $entreprise = $data['entreprise'];
            $debut = $data['debut'];
            $fin = $data['fin'];
            $activites = $data['activites'];

            $experience = $repository->findOneByTag($tag);
            if (!$experience)
            {
                $experience = new Experience();
                $experience->setTag($tag);
            }
            $experience->setPoste($poste);
            $experience->setEntreprise($entreprise);
            $experience->setDebut($debut);
            $experience->setFin($fin);
            $experience = $this->addExperienceActivites($experience, $activites);

            $this->em->persist($experience);
        }
        $this->em->flush();
    }

    private function cleanExperience()
    {
        $experiences = $this->em->getRepository('AppBundle:Experience')->findAll();
        foreach ($experiences as $experience)
        {
            foreach ($experience->getActivites() as $activite)
            {
                $this->em->remove($activite);
            }
            $this->em->remove($experience);
        }
        $this->em->flush();
    }

    private function addExperienceActivites($experience, $datas)
    {
        foreach ($experience->getActivites() as $activite)
        {
            $experience->removeActivite($activite);
            $this->em->remove($activite);
        }

        foreach ($datas as $data)
        {
            $libelle = $data['libelle'];

            $activite = new Activite();
            $activite->setLibelle($libelle);
            $activite->setExperience($experience);
            $this->em->persist($activite);

            $experience->addActivite($activite);
        }

        return $experience;
    }
}