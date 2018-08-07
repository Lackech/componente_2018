<?php
/**
 * @package    congresos
 *
 * @author     achacon <your@email.com>
 * @copyright  A copyright
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       http://your.url.com
 */

use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

/**
 * Congreso table.
 *
 * @since       1.0
 */
class TableCongreso extends Table
{
	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  $db  Database driver object.
	 *
	 * @since   1.0
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__congreso', 'id', $db);

		JTableObserverTags::createObserver($this, array('typeAlias' => 'com_congreso.congreso'));
		JTableObserverContenthistory::createObserver($this, array('typeAlias' => 'com_congreso.congreso'));
	}



}