<?php
/**
 * @package    congreso
 *
 * @author     achacon <your@email.com>
 * @copyright  A copyright
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       http://your.url.com
 */

use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

/**
 * Congreso
 *
 * @package  congreso
 * @since    1.0
 */
class CongresoModelCongreso extends JModelList
{



	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return      string  An SQL query
	 */
	protected function getListQuery()
	{
		// Initialize variables.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Create the base select statement.
		$query->select('*')
			->from($db->quoteName('#__congreso'));

		return $query;
	}
}
