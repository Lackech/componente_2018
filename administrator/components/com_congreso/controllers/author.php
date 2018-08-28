<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_congreso
 *
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Congreso Controller
 *

 */
class CongresoControllerAuthor extends JControllerForm
{

	protected $default_view = 'author';

	function __construct($config=array()) {
		parent::__construct($config);
	}

	protected function allowAdd($data = array()) {
		$user		= JFactory::getUser();
		$allow		= null;
		$allow	= $user->authorise('core.create', 'com_congreso');
		if ($allow === null) {
			return parent::allowAdd($data);
		} else {
			return $allow;
		}
	}

	protected function allowEdit($data = array(), $key = 'id') {
		$user		= JFactory::getUser();
		$allow		= null;
		$allow	= $user->authorise('core.edit', 'com_congreso');
		if ($allow === null) {
			return parent::allowEdit($data, $key);
		} else {
			return $allow;
		}
	}


}