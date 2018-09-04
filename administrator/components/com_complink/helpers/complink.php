<?php
/**
 * @package    complink
 *
 * @author     alro9 <your@email.com>
 * @copyright  A copyright
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       http://your.url.com
 */

use Joomla\CMS\Language\Text;

defined('_JEXEC') or die;

/**
 * Complink helper.
 *
 * @package     A package name
 * @since       1.0
 */
class ComplinkHelper
{
	/**
	 * Render submenu.
	 *
	 * @param   string  $vName  The name of the current view.
	 *
	 * @return  void.
	 *
	 * @since   1.0
	 */
	public function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(Text::_('COM_COMPLINK'), 'index.php?option=com_complink&view=complink', $vName == 'complink');
	}
}
