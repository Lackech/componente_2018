<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_congreso
 *
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

?>
<form action="<?php echo JRoute::_('index.php?option=com_congreso&layout=edit&id=' . (int) $this->item->id); ?>"
      method="post" name="adminForm" id="adminForm">


	<form action="<?php echo JRoute::_('index.php?option=com_rootflick&view=submit&layout=edit&id='.(int) $this->item->id); ?>"
	      method="post" name="adminForm" class="form-validate" id="rootflick-submit-form">
		<div class="btn-toolbar">
			<div class="btn-group">
				<button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('submit.save')">
					<i class="icon-ok"></i> <?php echo JText::_('JSAVE') ?>
				</button>
			</div>
			<div class="btn-group">
				<button type="button" class="btn" onclick="Joomla.submitbutton('submit.cancel')">
					<i class="icon-cancel"></i> <?php echo JText::_('JCANCEL') ?>
				</button>
			</div>
		</div>
		<fieldset class="formulario">
			<ul class="adminformlist">
				<?php foreach ($this->form->getFieldset() as $field): ?>
					<li><?php echo $field->label; ?>
						<?php echo $field->input; ?></li>
				<?php endforeach ?>
			</ul>
		</fieldset>
		<input type="hidden" name="jform[user_id]" id="jform_user_id" value="<?php echo JFactory::getUser()->id; ?>" />
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</form>

</form>
