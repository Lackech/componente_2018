<?php
/**
 * Created by PhpStorm.
 * User: alro9
 * Date: 8/16/2018
 * Time: 4:29 PM
 */

defined('_JEXEC') or die();



class JFormFieldAuthorTags extends JFormField
{
	protected $type 		= 'AuthorTags';

	protected function getInput() {

		$id = (int) $this->form->getValue('id');

		$activeAuthors = array();
		if ((int)$id > 0) {
			$activeAuthors	= congresoAuthor::getAuthors($id, 1);
		}




		return congresoAuthor::getAllAuthorsSelectBox($this->name, $this->id, $activeAuthors, NULL, 'a.id' );


	}




}
