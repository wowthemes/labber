<?php

/**
 * EmployeeTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class EmployeeTable extends PluginEmployeeTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object EmployeeTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Employee');
    }
}