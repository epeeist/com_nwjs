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
class NWJSViewOverall extends JView {
  /**
   * NWJS view display method.
   *
   * @param string $tpl The name of the template file to parse;
   *
   * @return void
   */
  public function display($tpl = null) {
    $model =& $this->getModel();
  	
    $tournament_id = JRequest::getVar('tournament');
    $tournament = $model->tournament($tournament_id); 
    
    $this->assignRef('tournament', $tournament);
    
  	$event_id = JRequest::getVar('event');
  	if ($event_id != "all") {
  	  $event = $model->event($event_id);
  	}
  	else {
  		$event = $event_id;
  	}
    $this->assignRef('event', $event); 
           
    $sort = JRequest::getVar('sort');

    $results = $model->getResults($tournament_id, $event_id, $sort);
    $this->assignRef('results', $results);
    
    parent::display($tpl);
    	
  }
}
