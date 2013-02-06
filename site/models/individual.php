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
 * NWJS Model for individual rankings.
 *
 * @package    NWJS
 * @subpackage Models
 */
class NWJSModelIndividual extends JModel {
  /**
   * Gets the list of results for a particular fencer
   * for an event type in a particular year
   * 
   * @param $fencers_id, the id for the fencer
   * @param $event, the category for the event
   * @param $year, the year for which results should be 
   *               returned
   * @return objectList, the list of results
   */	
  function getResults($fencers_id, $event, $year) {
    $db =& JFactory::getDBO();
    
  	$query = "SELECT t.`name`, t.`date`, position, points
              FROM #__nwjs_results AS r, #__nwjs_tournaments as t,
                   #__nwjs_competitions AS e
              WHERE r.fencers_id = " . $fencers_id . " AND
                    e.catid = " . $event . " AND
                    YEAR(t.`date`) = " . $year . " AND
                    r.competitions_id = e.id AND
                    e.tournaments_id = t.id
              ORDER BY t.`date`";
  	
    $db->setQuery($query);
    $results = $db->loadObjectList();  	

    return $results;
  }
  
  /**
   * Gets names of the fencer in question and 
   * the category of events
   * 
   * @param unknown_type $fencer
   * @param unknown_type $event
   */
  function getNames($fencers_id, $event) {
    $db =& JFactory::getDBO();  

    $query = "SELECT DISTINCT forename, surname, title
              FROM #__nwjs_fencers AS f, #__nwjs_results AS r,
                   #__nwjs_competitions AS e, #__categories AS cat
              WHERE f.id = $fencers_id AND
                    cat.id = $event AND
                    r.fencers_id = f.id AND
                    r.competitions_id = e.id AND
                    e.catid = cat.id";
    
    $db->setQuery($query);
    $names = $db->loadObject();
    
    return $names;
  }
}//class
