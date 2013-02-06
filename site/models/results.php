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
 * NWJS Model for the results form
 *
 * @package    NWJS
 * @subpackage Models
 */
class NWJSModelResults extends JModel {
  private $_lowestYear = null;
  private $_highestYear = null;
  private $_tournaments = null;
  private $_competitionTypes = null;

  /**
   * Return the lowest value of the year for which we have results
   */

  function yearMin() {
    if (! $this->_lowestYear) {
      $query = "SELECT min(`date`) 
                FROM #__nwjs_tournaments";

      $db =& JFactory::getDBO();
      $db->setQuery($query);

      $date = $db->loadResult();
      list($this->_lowestYear, $month, $day) = explode("-", $date);    }

    return $this->_lowestYear;
  }

  /**
   * Return the highest value of the year for which we have results
   */

  function yearMax() {
    if (! $this->_highestYear) {
      $query = "SELECT max(`date`) 
                FROM #__nwjs_tournaments";

      $db =& JFactory::getDBO();
      $db->setQuery($query);

      $date = $db->loadResult();
      list($this->_highestYear, $month, $day) = explode("-", $date);
    }

    return $this->_highestYear;
  }
  
  /**
   * Return the list of known tournaments
   */
  
  function tournaments() {
  	if (! $this->_tournaments) {
      $query = "SELECT * 
                FROM #__nwjs_tournaments
  		        ORDER BY `date` DESC";
  		
  	  $db =& JFactory::getDBO();
      $db->setQuery($query);
        
      $this->_tournaments = $db->loadObjectList();
  	}
  	  
  	return $this->_tournaments;
 }	
 
 /**
  * Return the list of competition types
  */
 
  function competitionTypes() {
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
