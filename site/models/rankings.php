<?php
/**
 * @package    NWJS
 * @subpackage Models
 * @author     Colin Walls {@link }
 * @author     Created on 11-Apr-2012
 * @license    GNU/GPL
 */

//-- No direct access
defined('_JEXEC') || die('=;)');


jimport('joomla.application.component.model');

/**
 * NWJS Model.
 *
 * @package    NWJS
 * @subpackage Models
 */
class NWJSModelRankings extends JModel {
  private $_years = null;
  private $_competitionTypes = null;
  
  /**
   * Gets the list of years for which there are results
   */	
  function getYears() {
  	if (! $this->_years) {
      $query = "SELECT DISTINCT year(`date`) AS year
                FROM `#__nwjs_tournaments`
                ORDER BY year DESC";

      $db =& JFactory::getDBO();

      $db->setQuery($query);
      $this->_years = $db->loadObjectList();
  	}
  	
    return $this->_years;
  }
  
  /**
   * Gets the list of competition categories 
   *
   */
  function getCompetitionTypes() {
    if (! $this->_competitionTypes) {
  	  $query = "SELECT id, title
  	            FROM #__categories
  	            WHERE extension = 'com_nwjs'
  	            ORDER BY id";
  		
  		$db =& JFactory::getDBO();
        $db->setQuery($query);
        
        $this->_competitionTypes = $db->loadObjectList();
  	}
  	  
  	return $this->_competitionTypes; 
  	
  }
}//class
