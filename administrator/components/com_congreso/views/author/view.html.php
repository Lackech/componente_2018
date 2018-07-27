<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_congreso

 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Congreso View
 *

 */
class CongresoViewAuthor extends JViewLegacy
{
	/**
	 * View form
	 *
	 * @var   form
	 */
	protected $form = null;
	protected $item = null;
	/**
	 * Display the congresos view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		// Get the Data
		$this->item = $this->get('Item');
		$this->form = $this->get('Form');









		// Set the toolbar
		$this->addToolBar();

		// Display the template
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolBar()
	{
		$input = JFactory::getApplication()->input;

		// Hide Joomla Administrator Main menu
		$input->set('hidemainmenu', true);

		$isNew = ($this->item->authorid == 0);

		if ($isNew)
		{
			$title = JText::_('Crear nuevo archivo');
		}
		else
		{
			$title = JText::_('Editar archivo');
		}

		JToolBarHelper::title($title, 'author');
		JToolBarHelper::save('author.save');//congreso
		JToolBarHelper::cancel('author.cancel',$isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
		);
	}
}