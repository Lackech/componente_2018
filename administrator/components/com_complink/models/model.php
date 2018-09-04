<?php
/**
 * Created by PhpStorm.
 * User: alro9
 * Date: 9/4/2018
 * Time: 11:40 AM
 */


defined('_JEXEC') or die ;

jimport('joomla.application.component.model');

class ComplinkModel extends JModelLegacy
{
	public static function addIncludePath($path = '', $prefix = '')
	{
		return parent::addIncludePath($path, $prefix);
	}

}