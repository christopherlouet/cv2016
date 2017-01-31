<?php

namespace AppBundle\Schema\Data;

use AppBundle\Entity\Profil;
use AppBundle\Schema\Model\SchemaData;

/**
 * Class ProfilData.
 * @package AppBundle\Schema\Data
 */
class ProfilData extends SchemaData
{
    const FILE_PROFIL = 'profil';

    public function update()
    {
        $this->updateProfil();
    }

    public function clean()
    {
        $this->cleanProfil();
    }

    private function updateProfil()
    {
        $file = self::FILE_PROFIL . '.' . $this->parser->getExtension();
        $datas = $this->parser->toArray($this->pathDataset, $file);
        $this->cleanProfil();

        foreach ($datas as $data)
        {
            $nom = $data['nom'];
            $prenom = $data['prenom'];
            $age = $data['age'];
            $permis = $data['permis'];
            $statut = $data['statut'];
            $adresse = $data['adresse'];
            $codePostal = $data['codePostal'];
            $ville = $data['ville'];
            $telephone = $data['telephone'];
            $email = $data['email'];

            $profil = new Profil();
            $profil->setNom($nom);
            $profil->setPrenom($prenom);
            $profil->setAge($age);
            $profil->setPermis($permis);
            $profil->setStatut($statut);
            $profil->setAdresse($adresse);
            $profil->setCodePostal($codePostal);
            $profil->setVille($ville);
            $profil->setTelephone($telephone);
            $profil->setEmail($email);

            $this->em->persist($profil);
        }
        $this->em->flush();
    }

    private function cleanProfil()
    {
        $profils = $this->em->getRepository('AppBundle:Profil')->findAll();
        foreach ($profils as $profil)
        {
            $this->em->remove($profil);
        }
        $this->em->flush();
    }
}