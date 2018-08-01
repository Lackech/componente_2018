<?php
/**
 * @package    congresos
 *
 * @author     achacon <your@email.com>
 * @copyright  A copyright
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       http://your.url.com
 */

defined('_JEXEC') or die;

?>
<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<div id="j-main-container" class="span10">

	<form action="index.php?option=com_congreso&view=authors" method="post" id="adminForm" name="adminForm">

		<table class="table table-striped table-hover">
			<thead>
			<tr>
				<th width="1%"><?php echo JText::_('Número'); ?></th>
				<th width="2%">
					<?php echo JHtml::_('grid.checkall'); ?>
				</th>

				<th width="25%">
					<?php echo JText::_('Nombre') ;?>
				</th>

				<th width="65%">
					<?php echo JText::_('Descripción') ;?>
				</th>
				<th width="7%">
					<?php echo JText::_('Publicado'); ?>
				</th>

			</tr>
			</thead>
			<tfoot>
			<tr>
				<td colspan="5">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
			</tfoot>
			<tbody>
			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $row) :
					$link = JRoute::_('index.php?option=com_congreso&task=author.edit&id=' . $row->authorid);
					?>

					<tr>
						<td>
							<?php echo $this->pagination->getRowOffset($i); ?>
						</td>
						<td>
							<?php echo JHtml::_('grid.id', $i, $row->id); ?>
						</td>

						<td>
							<a href="<?php echo $link; ?> " title= "<?php echo JText::_('Editar'); ?>">
								<?php echo $row->name; ?>
							</a>
						</td>

						<td>
							<a href="<?php echo $link; ?> " description= "<?php echo JText::_('Editar'); ?>">
								<?php echo $row->biography; ?>
							</a>
						</td>



						<td align="center">
							<?php echo JHtml::_('jgrid.published', $row->published, $i, 'authors.', true, 'cb'); ?>
						</td>

					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
		</table>
		<input type="hidden" name="task" value=""/>
		<input type="hidden" name="boxchecked" value="0"/>
		<?php echo JHtml::_('form.token'); ?>

	</form>

</div>
