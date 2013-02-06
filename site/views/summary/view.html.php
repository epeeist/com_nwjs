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
 * HTML View class for the NWJS Component.
 *
 * @package    NWJS
 * @subpackage Views
 */
class NWJSViewSummary extends JView {
  /**
   * NWJS Summary Rankings view display method.
   *
   * @param string $tpl The name of the template file to parse;
   *
   * @return void
   */
  public function display($tpl = null) {
    $model =& $this->getModel();
  	
    $year = JRequest::getVar('year');   
    $this->assignRef('year', $year);
    
  	$event_id = JRequest::getVar('event');
  	if ($event_id != "all") {
  	  $event = $model->event($event_id);
  	}
  	else {
  		$event = $event_id;
  	}
    $this->assignRef('event', $event); 
    $this->assignRef('event_id', $event_id); 
               
    $sort = JRequest::getVar('sort');

    $rankings = $model->getRankings($event_id, $year);
    $this->assignRef('rankings', $rankings);
    
    parent::display($tpl);
  }
}//class
