<?php
/**
 * @package    NWJS
 * @subpackage Views
 * @author     Colin Walls {@link }
 * @author     Created on 11-Apr-2012
 * @license    GNU/GPL
 */

//-- No direct access
defined('_JEXEC') || die('=;)');


jimport('joomla.application.component.view');

/**
 * HTML View class for Personal results 
 *
 * @package    NWJS
 * @subpackage Views
 */
class NWJSViewPersonal extends JView {
  function display($tpl = null) {
    $surname = JRequest::getVar('surname');
    $this->assignRef('surname', $surname);

    $event = JRequest::getVar('event');
    $fromYear = JRequest::getVar('fromYear');
    $toYear = JRequest::getVar('toYear');

    $model =& $this->getModel();

    $results = $model->getResults($surname, $event, $fromYear, $toYear);
    $this->assignRef('results', $results);

    parent::display($tpl);
  }
}
