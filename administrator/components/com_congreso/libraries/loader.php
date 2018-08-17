<?php
/**
 * Created by PhpStorm.
 * User: alro9
 * Date: 8/15/2018
 * Time: 11:20 AM
 */

defined('_JEXEC') or die();
spl_autoload_register(array('JLoader','load'));

class congresoLoader extends JLoader
{
	private static $paths 		= array();
	protected static $classes 	= array();

	public static function import($filePath, $base = null, $key = 'libraries.') {

		$cU = 'congreso';
		$cN = 'congreso';

		$keyPath = $key ? $key . $filePath : $filePath;

		if (!isset($paths[$keyPath])) {
			if ( !$base ) {
				$base =  JPATH_ADMINISTRATOR.'/components/com_'.$cU.'/libraries';
			}

			$parts = explode( '.', $filePath );

			$className = array_pop( $parts );


			switch($className) {
				case 'helper' :
					$className = ucfirst(array_pop( $parts )).ucfirst($className);
					break;

				Default :
					$className = ucfirst($className);
					break;
			}

			$path  = str_replace( '.', '/', $filePath );

			if (strpos($filePath, $cU) === 0) {
				$className	= $cN.$className;
				$classes	= JLoader::register($className, $base.'/'.$path.'.php');
				$rs			= isset($classes[strtolower($className)]);
			} else {
				// If it is not in the joomla namespace then we have no idea if
				// it uses our pattern for class names/files so just include
				// if the file exists or set it to false if not

				$filename = $base.'/'.$path.'.php';
				if (is_file($filename)) {
					$rs   = (bool) include $filename;
				} else {
					// if the file doesn't exist fail
					$rs   = false;

					// note: JLoader::register does an is_file check itself so we don't need it above, we do it here because we
					// try to load the file directly and it may not exist which could cause php to throw up nasty warning messages
					// at us so we set it to false here and hope that if the programmer is good enough they'll check the return value
					// instead of hoping it'll work. remmeber include only fires a warning, so $rs was going to be false with a nasty
					// warning message
				}
			}

			congresoLoader::$paths[$keyPath] = $rs;
		}

		return congresoLoader::$paths[$keyPath];
	}
}

function congresoimport($path) {
	return congresoLoader::import($path);
}
