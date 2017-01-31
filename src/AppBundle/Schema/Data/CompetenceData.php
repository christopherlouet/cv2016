<?php

namespace AppBundle\Schema\Data;

use AppBundle\Entity\Competence;
use AppBundle\Entity\Domaine;
use AppBundle\Schema\Model\SchemaData;

/**
 * Class CompetenceData.
 * @package AppBundle\Schema\Data
 */
class CompetenceData extends SchemaData
{
    const FILE_COMPETENCE = 'competence';

    public function update()
    {
        $this->updateCompetence();
    }

    public function clean()
    {
        $this->cleanCompetence();
    }

    private function updateCompetence()
    {
        $file = self::FILE_COMPETENCE . '.' . $this->parser->getExtension();
        $datas = $this->parser->toArray($this->pathDataset, $file);
        $repository = $this->em->getRepository('AppBundle:Domaine');

        foreach ($datas as $data)
        {
            $tag = $data['tag'];
            $libelle = $data['libelle'];
            $competences = $data['competences'];

            $domaine = $repository->findOneByTag($tag);
            if (!$domaine)
            {
                $domaine = new Domaine();
                $domaine->setTag($tag);
            }
            $domaine->setLibelle($libelle);
            $domaine = $this->addDomaineCompetences($domaine, $competences);

            $this->em->persist($domaine);
        }
        $this->em->flush();
    }

    private function cleanCompetence()
    {
        $domaines = $this->em->getRepository('AppBundle:Domaine')->findAll();
        foreach ($domaines as $domaine)
        {
            foreach ($domaine->getCompetences() as $competence)
            {
                $this->em->remove($competence);
            }
            $this->em->remove($domaine);
        }
        $this->em->flush();
    }

    private function addDomaineCompetences($domaine, $datas)
    {
        foreach ($domaine->getCompetences() as $competence)
        {
            $domaine->removeCompetence($competence);
            $this->em->remove($competence);
        }

        foreach ($datas as $data)
        {
            $libelle = $data['libelle'];
            $niveau = $data['niveau'];

            $competence = new Competence();
            $competence->setLibelle($libelle);
            $competence->setNiveau($niveau);
            $competence->setDomaine($domaine);
            $this->em->persist($competence);

            $domaine->addCompetence($competence);
        }

        return $domaine;
    }
}