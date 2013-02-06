<?php
/**
 * @package    NWJS
 * @subpackage Base
 * @author     Colin Walls {@link }
 * @author     Created on 11-Apr-2012
 * @license    GNU/GPL
 *
 * The top level administrative file
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Register the Help path
JLoader::register('NWJSHelper', JPATH_COMPONENT.'/helpers/nwjs.php');

// import joomla controller library
jimport('joomla.application.component.controller');

// Get an instance of the controller prefixed by NWJS
$controller = JController::getInstance('NWJS');

// Perform the Request task
$controller->execute(JRequest::getCmd('task'));

// Redirect if set by the controller
$controller->redirect();


