<?php
/**
 * @package    congresos
 *
 * @author     achacon <your@email.com>
 * @copyright  A copyright
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       http://your.url.com
 */

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\BaseController;

defined('_JEXEC') or die;

// Access check.
if (!Factory::getUser()->authorise('core.manage', 'com_congreso'))
{
	throw new InvalidArgumentException(Text::_('JERROR_ALERTNOAUTHOR'), 404);
}

if (! class_exists('congresoLoader')) {
	require_once( JPATH_ADMINISTRATOR.'/components/com_congreso/libraries/loader.php');
}

require_once( JPATH_COMPONENT.'/controller.php' );
jimport( 'joomla.filesystem.folder' );
jimport( 'joomla.filesystem.file' );
congresoimport('congreso.author.author');


// Require the helper
require_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/congreso.php';

// Execute the task
$controller = BaseController::getInstance('Congreso');
$controller->execute(Factory::getApplication()->input->get('task'));
$controller->redirect();
