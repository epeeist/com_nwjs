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


jimport('joomla.application.component.controller');

/**
 * NWJS default Controller.
 *
 * @package    NWJS
 * @subpackage Controllers
 */
class NWJSController extends JController
{
  /**
   * Method to display the view.
   *
   * @return void
   */
  public function display($cachable = false, $urlparams = false) {
    //-- Setting the default view
    JRequest::setVar('view', JRequest::getCmd('view', 'tournaments'));

    parent::display($cachable, $urlparams);

    NWJSHelper::addSubmenu('tournaments');
  }//function
}//class
