<?php
/**
 * Created by PhpStorm.
 * User: alro9
 * Date: 9/4/2018
 * Time: 11:45 AM
 */

defined('_JEXEC') or die ;

jimport('joomla.application.component.view');

if (version_compare(JVERSION, '3.0', 'ge'))
{
	class ComplinkView extends JViewLegacy
	{
	}

}
else
{
	class ComplinkView extends JView
	{
	}

}