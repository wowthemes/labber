<?php

/**
 * MethodDenominationTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class MethodDenominationTable extends PluginMethodDenominationTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object MethodDenominationTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('MethodDenomination');
    }
}