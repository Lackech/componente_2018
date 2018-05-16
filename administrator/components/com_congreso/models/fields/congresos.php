<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_congreso
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

JFormHelper::loadFieldClass('list');

/**
 * congreso Form Field class for the congreso component
 *
 */
class JFormFieldcongreso extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var         string
	 */
	protected $type = 'congreso';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return  array  An array of JHtml options.
	 */
	protected function getOptions()
	{
		$db    = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('id,title,description,link');
		$query->from('#__congreso');
		$db->setQuery((string) $query);
		$messages = $db->loadObjectList();
		$options  = array();


		if ($messages)
		{
			foreach ($messages as $message)
			{
				$options[] = JHtml::_('select.option', $message->id, $message->title, $message->description, $message->link);
			}
		}

		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
