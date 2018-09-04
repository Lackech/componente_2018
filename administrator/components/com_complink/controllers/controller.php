<?php
/**
 * @package    complink
 *
 * @author     alro9 <your@email.com>
 * @copyright  A copyright
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       http://your.url.com
 */



defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

/**
 * Complink Controller.
 *
 * @package  complink
 * @since    1.0
 */
class ComplinkController extends JControllerLegacy
{
	public function display($cachable = false, $urlparams = array())
	{
		parent::display($cachable, $urlparams);
	}
}
