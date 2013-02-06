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
 * NWJS Model for an overall set of results
 *
 * @package    NWJS
 * @subpackage Models
 */
class NWJSModelOverall extends JModel {
  /**
   * Get the results of an individual competition
   *
   * @access public
   *
   * @param int - the tournament id
   * @param string - the id of the event
   * @param string - the field on which to sort
   *
   * @return Object List - contains the list of
   *   competitors meeting the requirements
   */

  function getIndividualResult($tournament, $event, $sort) {
    $query = "SELECT `position`, `forename`, `surname`, c.`name` AS `club`, `points`
              FROM `#__nwjs_results` AS r, `#__nwjs_fencers` AS f, 
                `#__nwjs_clubs` AS c,
                `#__nwjs_competitions` AS e,
                `#__nwjs_tournaments` AS t
              WHERE t.id = $tournament AND
                    e.tournaments_id = t.id AND
                    e.`catid` = '$event' AND
                    r.competitions_id = e.id AND
                    r.fencers_id = f.id AND
                    f.clubs_id = c.id
              ORDER BY `$sort`";
 	    
    $db =& JFactory::getDBO();

    $db->setQuery($query);
    $results = $db->loadObjectList();

    return $results;
  }

  /**
   * Get the list of results for an event for a particular tournament and event.
   *
   * @access public
   *
   * @param int - the id of the tournament
   * @param string - for a particular event or all events
   * @param string - sorted in a particular order
   *
   * @return object list - the returned list of results
   */

  function getResults($tournament, $event, $sort) {
    if ($event == "all") {
      $results = array();

      $query = "SELECT id,title
                FROM #__categories
                ORDER BY id";
  		
  	  $db =& JFactory::getDBO();
      $db->setQuery($query);
    
      foreach ($db->loadObjectList() as $comp) {
        $results[$comp->title] = 
          $this->getIndividualResult($tournament, $comp->id, $sort);
      }
      return $results;
    }
    else {
      return $this->getIndividualResult($tournament, $event, $sort);
    }
  }
  
  /**
   * Gets the tournament name given its id
   * 
   * @param $tournament_id
   */
  
  function tournament($tournament_id) {
    $query = "SELECT * 
              FROM #__nwjs_tournaments
  		      WHERE id = $tournament_id";
  		
  	$db =& JFactory::getDBO();
    $db->setQuery($query);
        
    return $db->loadObject();
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
