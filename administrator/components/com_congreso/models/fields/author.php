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
class JFormFieldAuthor extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var         string
	 */
	protected $type = 'Author';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return  array  An array of JHtml options.
	 */
	protected function getOptions()
	{
		$db    = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('#__congreso_author.id,#__congreso_author.name,#__congreso_author.biography');
		$query->from('#__congreso_author');
		// Retrieve only published items
		$query->where('#__congreso_author.published = 1');
		$db->setQuery((string) $query);
		$messages = $db->loadObjectList();
		$options  = array();


		if ($messages)
		{
			foreach ($messages as $message)
			{
				$options[] = JHtml::_('select.option', $message->id, $message->name ,$message->biography);
			}
		}

		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
