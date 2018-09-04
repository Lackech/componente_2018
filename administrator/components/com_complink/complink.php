<?php
/**
 * @package    complink
 *
 * @author     alro9 <your@email.com>
 * @copyright  A copyright
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       http://your.url.com
 */
/*
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\BaseController;

defined('_JEXEC') or die;

// Access check.
if (!Factory::getUser()->authorise('core.manage', 'com_complink'))
{
	throw new InvalidArgumentException(Text::_('JERROR_ALERTNOAUTHOR'), 404);
}

// Require the helper
require_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/complink.php';

// Execute the task
$controller = BaseController::getInstance('complink');
$controller->execute(Factory::getApplication()->input->get('task'));
$controller->redirect();
*/


// no direct access
defined('_JEXEC') or die;

JHTML::_('behavior.tooltip');
$user = JFactory::getUser();
$view = JRequest::getWord('view', 'items');
$view = JString::strtolower($view);
$task = JRequest::getCmd('task');
$params = JComponentHelper::getParams('com_complink');






	// Compatibility for gid variable
	if($user->authorise('core.admin', 'com_complink')){
		$user->gid = 1000;
	}
	else {
		$user->gid = 1;
	}

	if(	($params->get('lockTags') && !$user->authorise('core.admin', 'com_complink') && ($view=='tags' || $view=='tag')))
	{
		JError::raiseError( 403, JText::_('K2_ALERTNOTAUTH') );
	}


$document = JFactory::getDocument();

if(version_compare(JVERSION,'1.6.0','ge')) {
	JHtml::_('behavior.framework');
} else {
	JHTML::_('behavior.mootools');
}

// CSS
$document->addStyleSheet(JURI::root(true).'/media/com_complink/css/complink.css?v=2.6.0');

K2HelperHTML::loadjQuery(true, JRequest::getCmd('view') == 'media');

// JS
if(K2_JVERSION == '30')
{
	JHtml::_('formbehavior.chosen', 'select');
}
$document->addScriptDeclaration('K2JVersion = "'.K2_JVERSION.'";');
$document->addScript(JURI::root(true).'/media/com_complink/js/complink.js?v=2.6.0');


if( $document->getType() != 'raw' && JRequest::getWord('task')!='deleteAttachment' && JRequest::getWord('task')!='connector' && JRequest::getWord('task')!='tag' && JRequest::getWord('task')!='extrafields' && JRequest::getWord('task')!='download' && JRequest::getWord('task')!='saveComment'): ?>
	<!--[if lt IE 7]>
	<div style="border:1px solid #F7941D;background:#FEEFDA;text-align:center;clear:both;height:75px;position:relative;margin-bottom:16px;">
		<div style="position:absolute;right:3px;top:3px;font-family:courier new;font-weight:bold;">
			<a href="#" onclick="javascript:this.parentNode.parentNode.style.display='none';return false;"><img src="<?php echo JURI::root(true); ?>/media/k2/assets/images/ie6nomore/ie6nomore-cornerx.jpg" style="border:none;" alt="<?php echo JText::_('K2_CLOSE_THIS_NOTICE'); ?>"/></a>
		</div>
		<div style="width:640px;margin:0 auto;text-align:left;padding:0;overflow:hidden;color:black;">
			<div style="width:75px;float:left;">
				<img src="<?php echo JURI::root(true); ?>/media/k2/assets/images/ie6nomore/ie6nomore-warning.jpg" alt="<?php echo JText::_('K2_WARNING'); ?>"/>
			</div>
			<div style="width:275px;float:left;font-family:Arial,sans-serif;">
				<div style="font-size:14px;font-weight:bold;margin-top:12px;">
					<?php echo JText::_('K2_YOU_ARE_USING_AN_OUTDATED_BROWSER'); ?>
				</div>
				<div style="font-size:12px;margin-top:6px;line-height:12px;">
					<?php echo JText::_('K2_FOR_A_BETTER_EXPERIENCE_USING_THIS_SITE_PLEASE_UPGRADE_TO_A_MODERN_WEB_BROWSER'); ?>
				</div>
			</div>
			<div style="width:75px;float:left;"><a href="http://www.firefox.com" target="_blank"><img src="<?php echo JURI::root(true); ?>/media/k2/assets/images/ie6nomore/ie6nomore-firefox.jpg" style="border:none;" alt="<?php echo JText::_('K2_GET_FIREFOX_35'); ?>"/></a></div>
			<div style="width:75px;float:left;"><a href="http://www.browserforthebetter.com/download.html" target="_blank"><img src="<?php echo JURI::root(true); ?>/media/k2/assets/images/ie6nomore/ie6nomore-ie8.jpg" style="border:none;" alt="<?php echo JText::_('K2_GET_INTERNET_EXPLORER_8'); ?>"/></a></div>
			<div style="width:73px;float:left;"><a href="http://www.apple.com/safari/download/" target="_blank"><img src="<?php echo JURI::root(true); ?>/media/k2/assets/images/ie6nomore/ie6nomore-safari.jpg" style="border:none;" alt="<?php echo JText::_('K2_GET_SAFARI_4'); ?>"/></a></div>
			<div style="float:left;"><a href="http://www.google.com/chrome" target="_blank"><img src="<?php echo JURI::root(true); ?>/media/k2/assets/images/ie6nomore/ie6nomore-chrome.jpg" style="border:none;" alt="<?php echo JText::_('K2_GET_GOOGLE_CHROME'); ?>"/></a></div>
		</div>
	</div>
	<![endif]-->
	<div id="k2AdminContainer" class="K2AdminView<?php echo ucfirst($view); ?><?php if(K2_JVERSION != '15') echo ' isJ16orLater'; ?>">
<?php endif;
JLoader::register('ComplinkController', JPATH_COMPONENT.'/controllers/controller.php');
JLoader::register('ComplinkView', JPATH_COMPONENT.'/views/view.php');
JLoader::register('ComplinkModel', JPATH_COMPONENT.'/models/model.php');

$controller = JRequest::getWord('view', 'items');
$controller = JString::strtolower($controller);
require_once (JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php');
$classname = 'ComplinkController'.$controller;
$controller = new $classname();
$controller->registerTask('saveAndNew', 'save');
$controller->execute(JRequest::getWord('task'));
$controller->redirect();

if( $document->getType() != 'raw' &&  JRequest::getWord('task')!='deleteAttachment' && JRequest::getWord('task')!='connector' && JRequest::getWord('task')!='tag' && JRequest::getWord('task')!='extrafields' && JRequest::getWord('task')!='download' && JRequest::getWord('task')!='saveComment'): ?>
	</div>
	<div id="k2AdminFooter">
		<a target="_blank" href="http://getk2.org/">K2 v2.6.0</a> | Copyright &copy; 2006-<?php echo date('Y'); ?> <a target="_blank" href="http://www.joomlaworks.net/">JoomlaWorks Ltd.</a>
	</div>
<?php endif;
