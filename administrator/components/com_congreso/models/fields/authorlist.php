<?php


// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

JFormHelper::loadFieldClass('list');

class JFormFieldAuthorlist extends JFormFieldList {

	protected $type = 'AuthorList';

	public function getOptions() {

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('a.id,a.name')->from('`#__congreso_author` AS a');
		$rows = $db->setQuery($query)->loadObjectlist();
		$options = array();

		if($rows)
		{
			foreach($rows as $row)
			{
				$options[] = JHtml::_('select.option', $row->id, $row->name);
			}
		}
		/*foreach($rows as $row){
			$options[] = $row->name;
		}*/
		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);
		return $options;
	}
}