<?php

namespace AppBundle\Schema\Data;

use AppBundle\Entity\Formation;
use AppBundle\Schema\Model\SchemaData;

/**
 * Class FormationData.
 * @package AppBundle\Schema\Data
 */
class FormationData extends SchemaData
{
    const FILE_FORMATION = 'formation';

    public function update()
    {
        $this->updateFormation();
    }

    public function clean()
    {
        $this->cleanFormation();
    }

    private function updateFormation()
    {
        $file = self::FILE_FORMATION . '.' . $this->parser->getExtension();
        $datas = $this->parser->toArray($this->pathDataset, $file);
        $repository = $this->em->getRepository('AppBundle:Formation');

        foreach ($datas as $data)
        {
            $tag = $data['tag'];
            $ecole = $data['ecole'];
            $debut = $data['debut'];
            $fin = $data['fin'];
            $intitule = $data['intitule'];
            $validation = $data['validation'];
            $niveau = $data['niveau'];

            $formation = $repository->findOneByTag($tag);
            if (!$formation)
            {
                $formation = new Formation();
                $formation->setTag($tag);
            }
            $formation->setEcole($ecole);
            $formation->setDebut($debut);
            $formation->setFin($fin);
            $formation->setIntitule($intitule);
            $formation->setValidation($validation);
            $formation->setNiveau($niveau);

            $this->em->persist($formation);
        }
        $this->em->flush();
    }

    private function cleanFormation()
    {
        $formations = $this->em->getRepository('AppBundle:Formation')->findAll();
        foreach ($formations as $formation)
        {
            $this->em->remove($formation);
        }
        $this->em->flush();
    }
}