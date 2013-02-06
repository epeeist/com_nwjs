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
 * This shows the rankings for a single individual at a paticular
 * event type for a particular year.
 *
 * @package    NWJS
 * @subpackage Views
 */
class NWJSViewIndividual extends JView {
  /**
   * NWJS view display method.
   *
   * @param string $tpl The name of the template file to parse;
   *
   * @return void
   */
  public function display($tpl = null) {
    $event = JRequest::getVar('event');
    $fencer = JRequest::getVar('fencer_id');
    $year = JRequest::getVar('year');
    $this->assignRef('year', $year);

    $model =& $this->getModel();

    $names = $model->getNames($fencer, $event);
    $this->assignRef('names', $names);

    $results = $model->getResults($fencer, $event, $year);
    $this->assignRef('results', $results);

    parent::display($tpl);
  }
}
