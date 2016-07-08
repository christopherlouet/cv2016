<?php

namespace AppBundle\Schema;

use AppBundle\Entity\Activite;
use AppBundle\Entity\Competence;
use AppBundle\Entity\Domaine;
use AppBundle\Entity\Experience;
use AppBundle\Entity\Formation;
use AppBundle\Entity\Profil;
use AppBundle\Parser\ParserInterface;
use Doctrine\ORM\EntityManager;

class Schema
{
    const FILE_COMPETENCE = 'competence';
    const FILE_EXPERIENCE = 'experience';
    const FILE_FORMATION = 'formation';
    const FILE_PROFIL = 'profil';

    protected $em;
    protected $parser;
    protected $pathDataset;

    public function __construct(
        EntityManager $em,
        ParserInterface $parser,
        $pathDataset
    )
    {
        $this->em = $em;
        $this->parser = $parser;
        $this->pathDataset = $pathDataset;
    }

    public function cleanAll()
    {
        $this->cleanProfil();
        $this->cleanCompetence();
        $this->cleanExperience();
        $this->cleanFormation();
    }

    public function updateAll()
    {
        $this->updateProfil();
        $this->updateCompetence();
        $this->updateExperience();
        $this->updateFormation();
    }

    public function cleanCompetence()
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

    public function updateCompetence()
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

    public function cleanExperience()
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

    public function updateExperience()
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

    public function cleanFormation()
    {
        $formations = $this->em->getRepository('AppBundle:Formation')->findAll();
        foreach ($formations as $formation)
        {
            $this->em->remove($formation);
        }
        $this->em->flush();
    }

    public function updateFormation()
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

    public function cleanProfil()
    {
        $profils = $this->em->getRepository('AppBundle:Profil')->findAll();
        foreach ($profils as $profil)
        {
            $this->em->remove($profil);
        }
        $this->em->flush();
    }

    public function updateProfil()
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

    /**
     * @param Experience $experience
     * @param array $datas
     * @return Experience
     */
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

    /**
     * @param Domaine $domaine
     * @param array $datas
     * @return Domaine
     */
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