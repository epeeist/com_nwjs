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
 * HTML View class for the rankings element of the NWJS component
 *
 * @static
 * @package	NWJS
 * @subpackage	Views
 */
class NWJSViewRankings extends JView {
  /**
   * Rankings view display method.
   *
   * @param string $tpl The name of the template file to parse;
   *
   * @return void
   */
	
  function display($tpl = null) {
    $model =& $this->getModel();	

    $years = $model->getYears();
    $this->assignRef('years', $years);	
    
    $competition_types = $model->getCompetitionTypes();
    $this->assignRef('competition_types', $competition_types);
    
    parent::display($tpl);
  }
}//class
