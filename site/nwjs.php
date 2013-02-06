<?php
/**
 * @package    NWJS
 * @subpackage Base
 * @author     Colin Walls {@link }
 * @author     Created on 11-Apr-2012
 * @license    GNU/GPL
 */

//-- No direct access
defined('_JEXEC') || die('=;)');


/**
 *  Require the base controller.
 */
require_once JPATH_COMPONENT.DS.'controller.php';

// Require specific controller if requested
$controller = JRequest::getCmd('controller');

if($controller)
{
    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';

    if(file_exists($path))
    {
        require_once $path;
    }
    else
    {
        $controller = '';
    }
}

//-- Create the controller
$classname = 'NWJSController'.$controller;

$controller = new $classname;

//-- Perform the Request task
$controller->execute(JRequest::getCmd('view'));

//-- Redirect if set by the controller
$controller->redirect();
