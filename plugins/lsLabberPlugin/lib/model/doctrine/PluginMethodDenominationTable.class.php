<?php
/**
 * This abstract class Pluginhas been auto-generated by the Doctrine ORM Framework
 */
abstract class PluginMethodDenominationTable extends Doctrine_Table
{
  public function retrieveMethodDenominationsList(Doctrine_Query $q)
	{
    $objectId = sfContext::getInstance()->getRequest()->getParameter('objectId');

		$rootAlias = $q->getRootAlias();
    $q->leftJoin($rootAlias . '.Denomination d')
      ->where($rootAlias . '.method_id = ?', $objectId)
      ->orderBy('d.name');

    return $q;
	}
}