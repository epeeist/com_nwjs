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
 * HTML View class for the results form of the NWJS component.
 *
 * @static
 * @package	Results
 * @subpackage	Views
 */
class NWJSViewResults extends JView {
  /**
   * Results view display method.
   *
   * @param string $tpl The name of the template file to parse;
   *
   * @return void
   */
  public function display($tpl = null) {
    //-- Get some data from the model
    $model =& $this->getModel();

    $lowestYear = $model->yearMin();
    $highestYear = $model->yearMax();
    $tournaments = $model->tournaments();
    $competitionTypes = $model->competitionTypes();
    
    $this->assignRef('lowestYear', $lowestYear);
    $this->assignRef('highestYear', $highestYear);
    $this->assignRef('tournaments', $tournaments);
    $this->assignRef('competitionTypes', $competitionTypes);
            
    parent::display($tpl);

  }//function
}//class
