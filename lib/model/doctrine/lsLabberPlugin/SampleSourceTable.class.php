<?php

/**
 * SampleSourceTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class SampleSourceTable extends PluginSampleSourceTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object SampleSourceTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('SampleSource');
    }
}