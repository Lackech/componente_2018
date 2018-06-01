<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_congreso
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

JFormHelper::loadFieldClass('list');

/**
 * congresos Form Field class for the congresos component
 *
 */
class JFormFieldCongreso extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var         string
	 */
	protected $type = 'Congreso';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return  array  An array of JHtml options.
	 */
	protected function getOptions()
	{
		$db    = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('#__congreso.id as id,title,#__categories.title as category,#__congreso.catid,#__congreso.description,#__congreso.link');
		$query->from('#__congreso');
		$query->leftJoin('#__categories on #__congreso.catid=#__categories.id');
		// Retrieve only published items
		$query->where('#__congreso.published = 1');
		$db->setQuery((string) $query);
		$messages = $db->loadObjectList();
		$options  = array();


		if ($messages)
		{
			foreach ($messages as $message)
			{
				$options[] = JHtml::_('select.option', $message->id, $message->title . ($message->catid ? ' (' . $message->category . ')' : ''),$message->description, $message->link);
			}
		}

		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
