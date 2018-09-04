<?php
/**
 * Created by PhpStorm.
 * User: alro9
 * Date: 9/4/2018
 * Time: 11:41 AM
 */

// no direct access
defined('_JEXEC') or die ;

class ComplinkTable extends JTable
{
	public function load($keys = null, $reset = true)
	{
		return parent::load($keys, $reset);
	}


}
