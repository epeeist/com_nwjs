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
class NWJSModelPersonal extends JModel {
  /**
   * Function to get a set of personal results
   * 
   * @param string $surname, the surname to search for
   * @param int $event, the competition type or "all"
   * @param unknown_type $fromYear, the year to start from
   * @param unknown_type $toYear, the year to end at
   * 
   * @return objectList, the list of results
   */
  function getResults($surname, $event, $fromYear, $toYear) {
  	$results = array();
  	
  	$db =& JFactory::getDBO();
    
    /*
     * Get the list of tournaments that are within the years specified
     */
    
    $query = "SELECT * 
              FROM `#__nwjs_tournaments`
              WHERE YEAR(`date`) BETWEEN $fromYear AND $toYear
              ORDER BY `date` DESC";
        
    $db->setQuery($query);

    $tournaments = $db->loadObjectList();
    
    /*
     * For each tournament get the list of results
     */
    
    $wildSurname = str_replace('*', '%', $surname);
    
    foreach ($tournaments as $tournament) {
      $query = "SELECT `forename`, `surname`, c.`name` AS `club`,  
                       `title`, `position`, `points`
                FROM `#__nwjs_tournaments` AS t,
                     `#__nwjs_clubs` AS c,
                     `#__nwjs_competitions` AS e,
                     `#__nwjs_fencers` AS f,
                     `#__nwjs_results` AS r,
                     `#__categories` AS cat
              WHERE f.`surname` LIKE '%$surname%' AND
                    t.id = " . $tournament->id . " AND 
                    f.`clubs_id` = c.`id` AND
                    r.`fencers_id` = f.`id` AND
                    r.`competitions_id` = e.`id` AND
                    e.`tournaments_id` = t.`id` AND
                    e.`catid` = cat.`id`";

      if ($event != "all") {
        $query .= "AND cat.`id` = '$event' ";
      }
    
      $query .= "ORDER BY `position` ASC";
      
      $db->setQuery($query);

      $details = $db->loadObjectList();
      
      if ($details) {
      	$date = DateTime::createFromFormat('Y-m-d', $tournament->date);
      	
      	$results[$tournament->name . " - " .$date->format('F Y')] = $details;
      }
    }
    
    return $results;
  }
}
