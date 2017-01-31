<?php

namespace AppBundle\Schema\Model;

use AppBundle\Parser\ParserInterface;
use Doctrine\ORM\EntityManagerInterface;

abstract class SchemaData implements SchemaDataInterface
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
     * @var string
     */
    protected $pathDir;

    /**
     * SchemaData constructor.
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
    }

    /**
     * @param string $jsonFile
     * @return array
     */
    public function getJsonDatas($jsonFile)
    {
        $path = $this->pathDataset . '/' . $this->getPathDir();
        $file = $jsonFile . '.' . $this->parser->getExtension();
        $datas = $this->parser->toArray($path, $file);
        return $datas;
    }
}