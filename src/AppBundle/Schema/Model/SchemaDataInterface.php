<?php

namespace AppBundle\Schema\Model;

/**
 * Interface SchemaDataInterface
 * @package AppBundle\Schema\Model
 */
interface SchemaDataInterface
{
    /**
     * Json To array.
     *
     * @param $jsonFile
     * @return array
     */
    public function getJsonDatas($jsonFile);

    /**
     * Update datas.
     *
     * @return null
     */
    public function update();

    /**
     * Clean datas.
     *
     * @return null
     */
    public function clean();
}