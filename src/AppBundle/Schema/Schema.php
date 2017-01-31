<?php

namespace AppBundle\Schema;

use AppBundle\Parser\ParserInterface;
use AppBundle\Schema\Data\CompetenceData;
use AppBundle\Schema\Data\ExperienceData;
use AppBundle\Schema\Data\FormationData;
use AppBundle\Schema\Data\ProfilData;
use AppBundle\Schema\Model\SchemaData;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class Schema.
 * @package AppBundle\Schema
 */
class Schema
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var ParserInterface
     */
    protected $parser;

    /**
     * @var string
     */
    protected $pathDataset;

    /**
     * @var CompetenceData
     */
    protected $competenceData;

    /**
     * @var ExperienceData
     */
    protected $experienceData;

    /**
     * @var FormationData
     */
    protected $formationData;

    /**
     * @var ProfilData
     */
    protected $profilData;

    /**
     * Schema constructor.
     * @param EntityManagerInterface $em
     * @param ParserInterface $parser
     * @param string $pathDataset
     */
    public function __construct(EntityManagerInterface $em,
                                ParserInterface $parser,
                                $pathDataset)
    {
        $this->em = $em;
        $this->parser = $parser;
        $this->pathDataset = $pathDataset;
        $this->initData();
    }

    /**
     * Init datas.
     */
    private function initData()
    {
        $this->competenceData = new CompetenceData($this->em,$this->parser,$this->pathDataset);
        $this->experienceData = new ExperienceData($this->em,$this->parser,$this->pathDataset);
        $this->formationData = new FormationData($this->em,$this->parser,$this->pathDataset);
        $this->profilData = new ProfilData($this->em,$this->parser,$this->pathDataset);
    }

    /**
     * Update all datas.
     */
    public function updateAll()
    {
        $this->updateData($this->competenceData);
        $this->updateData($this->experienceData);
        $this->updateData($this->formationData);
        $this->updateData($this->profilData);
    }

    /**
     * Clean all datas.
     */
    public function cleanAll()
    {
        $this->cleanData($this->competenceData);
        $this->cleanData($this->experienceData);
        $this->cleanData($this->formationData);
        $this->cleanData($this->profilData);
    }

    /**
     * @param SchemaData $data
     * @return $this
     */
    private function updateData(SchemaData $data)
    {
        $data->update();
        return $this;
    }

    /**
     * @param SchemaData $data
     * @return $this
     */
    private function cleanData(SchemaData $data)
    {
        $data->clean();
        return $this;
    }
}