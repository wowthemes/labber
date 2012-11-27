<?php
/**
 * This abstract class Pluginhas been auto-generated by the Doctrine ORM Framework
 */
abstract class PluginMethodUnitOfMeasurementTable extends Doctrine_Table
{
  public function retrieveAssociatedWithMethod(Doctrine_Query $q, $methodId)
  {
    $rootAlias = $q->getRootAlias();

    $q->leftJoin($rootAlias . '.UnitOfMeasurement u')
      ->leftJoin($rootAlias . '.Prefix p')
      ->andWhere($rootAlias . '.method_id = ?', $methodId);

    return $q;
  }
}