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
 * NWJS Model for club results
 *
 * @package    NWJS
 * @subpackage Models
 */
class NWJSModelClub extends JModel {
  /**
   * gets the result for a particular club over a set period
   *
   * @access public
   *
   * @param string $club - the name of the club
   * @param string $event - the short form for the event or "all" for all events
   * @param int $fromYear - the start year
   * @param int $toYear - the end year

   *
   * @return object list - the list of results
   */
  function getResults($club, $event, $fromYear, $toYear) {
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

    $wildClub = str_replace('*', '%', $club);

    foreach ($tournaments as $tournament) {
      $query = "SELECT c.`name` AS club, `forename`, `surname`, 
                       `title`, `position`, `points`
                FROM `#__nwjs_tournaments` AS t,
                     `#__nwjs_clubs` AS c,
                     `#__nwjs_competitions` AS e,
                     `#__categories` as cat,
                     `#__nwjs_fencers` AS f,
                     `#__nwjs_results` AS r
                WHERE c.`name` LIKE '%$wildClub%' AND
                      t.id = " . $tournament->id . " AND
                      e.tournaments_id = t.id AND
                      f.`clubs_id` = c.`id` AND
                      r.`fencers_id` = f.`id` AND
                      r.`competitions_id` = e.`id` AND
                      e.`catid` = cat.`id` ";

  	  if ($event != "all") {
	      $query .= "AND cat.`id` = '$event' ";
      }
    
      $query .= "ORDER BY `position` ASC, `points` DESC";

  	  $db->setQuery($query);
 	  

	  $rows = $db->loadObjectList();
      if ($rows) {
      	$date = DateTime::createFromFormat('Y-m-d', $tournament->date);
      	
      	$results[$tournament->name . " - " .$date->format('F Y')] = $rows;
      }
    }
    
    return $results;
  }
}

