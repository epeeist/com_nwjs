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
 * This view class displays the results for a particular
 * club
 *
 * @package    NWJS
 * @subpackage Views
 */
class NWJSViewClub extends JView {
  function display($tpl = null) {
    $club = JRequest::getVar('club');
    $this->assignRef('club', $club);

    $event = JRequest::getVar('event');
    $fromYear = JRequest::getVar('fromYear', 0, '', 'int');
    $toYear = JRequest::getVar('toYear', 0, '', 'int');

    $model =& $this->getModel();

    $results = $model->getResults($club, $event, $fromYear, $toYear);
    $this->assignRef('results', $results);

    parent::display($tpl);
  }
}
