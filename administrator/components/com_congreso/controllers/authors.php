<?php
/**
 * @package    congresos
 *
 * @author     achacon <your@email.com>
 * @copyright  A copyright
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       http://your.url.com
 */

use Joomla\CMS\MVC\Controller\AdminController;

defined('_JEXEC') or die;

/**
 * Congreso Controller.
 *
 * @package  congresos
 * @since    1.0
 */
class CongresoControllerAuthors extends AdminController
{
	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  object  The model.
	 *
	 * @since   1.6
	 */
	public function getModel($name = 'Author', $prefix = 'CongresoModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}


	public function saveOrderAjax() {
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$pks = $this->input->post->get('cid', array(), 'array');
		$order = $this->input->post->get('order', array(), 'array');
		JArrayHelper::toInteger($pks);
		JArrayHelper::toInteger($order);
		$model = $this->getModel();
		$return = $model->saveorder($pks, $order);
		if ($return) { echo "1";}
		JFactory::getApplication()->close();
	}


}
