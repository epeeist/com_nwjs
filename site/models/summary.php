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
class NWJSModelSummary extends JModel {
  /**
   * Get the ranking list for an competition type and year
   *
   * @access public
   *
   * @param int - the category id for the competition type
   * @param int - the year for which the rankings are required
   *
   * @return object list - the returned list of results
   */

  function getIndividualRanking($competition_type, $year) {
    $query = "SELECT f.id AS fencer_id, forename, surname, c.name as club, 
                     sum(points) as ranking_points
              FROM #__nwjs_fencers AS f, #__nwjs_clubs AS c,
                   #__nwjs_results AS r, #__nwjs_competitions AS e,
                   #__nwjs_tournaments AS t
              WHERE e.catid = $competition_type AND
                    YEAR(t.`date`) = $year AND 
                    e.id = r.competitions_id AND
                    e.tournaments_id = t.id AND
                    r.fencers_id = f.id AND
                    f.clubs_id = c.id
              GROUP BY forename, surname, club
              ORDER BY `ranking_points` DESC";
	    
    $db =& JFactory::getDBO();

    $db->setQuery($query);
    $results = $db->loadObjectList();

    return $results;
  }

  /**
   * Get the ranking list for one or more competition types and year
   *
   * @access public
   *
   * @param int - the category id for the competition type
   * @param int - the year for which the rankings are required
   *
   * @return object list - the returned list of results
   */

  function getRankings($competition_type, $year) {
    if ($competition_type == "all") {
      $results = array();

      $query = "SELECT id,title
                FROM #__categories
                ORDER BY id";
  		
  	  $db =& JFactory::getDBO();
      $db->setQuery($query);
    
      foreach ($db->loadObjectList() as $comp) {
        $results[$comp->title] = 
          $this->getIndividualRanking($comp->id, $year, $sort);
      }
      return $results;
    }
    else {
      return $this->getIndividualRanking($competition_type, $year);
    }
  }
  
  /**
   * Gets the name of the competition type associated
   * with a particular type id
   * 
   * @param $competition_type_id
   */
  function event($event_id) {
    $query = "SELECT title
              FROM #__categories
  		      WHERE id = '$event_id'";
  		
  	$db =& JFactory::getDBO();
    $db->setQuery($query);

    $event = $db->loadObject();

    return $event;
  }  
}
