<?php
/**
 * Created by PhpStorm.
 * User: alro9
 * Date: 8/15/2018
 * Time: 11:28 AM
 */

defined('_JEXEC') or die;

class congresoAuthor
{
	public static function getAuthors($linkId, $select = 0) {

		$db = JFactory::getDBO();

		if ($select == 1) {
			$query = 'SELECT r.autid';
		} else {
			$query = 'SELECT a.*';
		}
		$query .= ' FROM #__congreso_author AS a'
			//.' LEFT JOIN
			.' LEFT JOIN #__congreso_author_ref AS r ON a.id = r.autid'
			.' WHERE r.linkid = '.(int) $linkId
			.' ORDER BY a.id';
		$db->setQuery($query);

		if (!$db->query()) {
			echo PhocaDownloadException::renderErrorInfo('Database Error - Getting Selected Tags');
			return false;
		}
		if ($select == 1) {
			$authors = $db->loadColumn();
		} else {
			$authors = $db->loadObjectList();
		}

		return $authors;
	}

	public static function storeAuthors($authorsArray, $linkId) {


		if ((int)$linkId > 0) {
			$db = JFactory::getDBO();
			$query = ' DELETE '
				.' FROM #__congreso_author_ref'
				. ' WHERE linkid = '. (int)$linkId;
			$db->setQuery($query);


			if (!empty($authorsArray)) {

				$values 		= array();
				$valuesString 	= '';

				foreach($authorsArray as $k => $v) {
					$values[] = ' ('.(int)$linkId.', '.(int)$v.')';
				}

				if (!empty($values)) {
					$valuesString = implode($values, ',');

					$query = ' INSERT INTO #__congreso_author_ref (linkid, autid)'
						.' VALUES '.(string)$valuesString;

					$db->setQuery($query);
					if (!$db->query()) {
						echo PhocaDownloadException::renderErrorInfo('Database Error - Insert FileId Tags');
						return false;
					}

				}
			}
		}

	}

	public static function getAllAuthorsSelectBox($name, $id, $activeArray, $javascript = NULL, $order = 'id' ) {

		$db = JFactory::getDBO();
		$query = 'SELECT a.id AS value, a.name AS text'
			.' FROM #__congreso_author AS a'
			. ' ORDER BY '. $order;
		//. ' ORDER BY a.id';
		$db->setQuery($query);



		$authors = $db->loadObjectList();

		$authorsO = JHTML::_('select.genericlist', $authors, $name, 'class="inputbox" size="4" multiple="multiple"'. $javascript, 'value', 'text', $activeArray, $id);

		return $authorsO;
	}
}