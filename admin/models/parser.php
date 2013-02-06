<?php
/**
 * @package    NWJS
 * @subpackage Models
 * @author     Colin Walls {@link }
 * @author     Created on 11-Apr-2012
 * @license    GNU/GPL
 */

/**
 * Base class for results upload. This contains an abstract
 * function which parses a file of results and returns 
 * a table which is used by the remainder of the methods
 * in the class
 *
 * @package NWJS
 * @subpackage Models
 */
abstract class ResultsParser {
  private $_tournaments_id = null;
  private $_competitions_id = null;

  /**
   * Checks to see whether a tournament of the given name exists. If it 
   * doesn't then it creates the tournament and returns the Id.
   * 
   * Enter description here ...
   * @param $name
   * @param $date
   */
  function tournament($name, $date) {
    if (is_null($this->_tournaments_id)) {
      /*
       * Check whether the tournament exists
       */

      $db =& JFactory::getDBO();
      $query = "SELECT `id` FROM `jos_nwjs_tournaments`
                WHERE `name` = '$name' AND
                      `date` = '$date'";
      
      $db->setQuery($query);
      
      $this->_tournaments_id = $db->loadResult();

      /*
       * If we don't get a tournaments id then we assume
       * it doesn't exist and we create it.
       */
      
      if (is_null($this->_tournaments_id)) {
	$query = "INSERT `jos_nwjs_tournaments`(`name`, `date`)
                  VALUES('$name', '$date')";

	$result = mysql_query($query);
	if (! $result) {
	  die("Could not instantiate query:\n$query\nResult was " . 
	      mysql_error() . "\n");
	}

	$this->_tournaments_id = mysql_insert_id();
	if (! is_int($this->_tournaments_id)) {
	  die("Could not instantiate query:\n$query\nResult was " . 
	      mysql_error() . "\n");
	}
      }
    }

    return true;
  }

  /**
   * Set up a competition as part of the tournament
   */

  function competition($catid) {
    /*
     * Check whether we have an id for this competition
     */

    $query = "SELECT `id`
              FROM `jos_nwjs_competitions`
              WHERE `catid` = '$catid' AND
                    `tournaments_id` = $this->_tournaments_id"; 

    $result = mysql_query($query);
    if (!$result) {
      die("Could not instantiate query:\n$query\nResult was " . 
	  mysql_error() . "\n");
    }


    $row = mysql_fetch_row($result);

    if (! is_null($row[0])) {
      $this->_competitions_id = $row[0];
    }
    else {
      $query = "INSERT INTO `jos_nwjs_competitions`(`catid`, 
                                                 `tournaments_id`)
                VALUES('$catid', $this->_tournaments_id)";

      $result = mysql_query($query);
      if (! $result) {
	die("Could not instantiate query:\n$query\nResult was " . 
	    mysql_error() . "\n");
      }

      $this->_competitions_id = mysql_insert_id();
      if (! is_int($this->_competitions_id)) {
	die("Insert of competition failed" . mysql_error() . "\n");
      }
    }

    return true;
  }

  /**
   * Parse the HTML file and return the table of results
   */

  abstract function parseTable($file) {
  	
   }  

  /**
   * Return the multiplier for  a particular place
   */

  function multiplier($place) {
    $multipliers = array(25, 20, 16, 16, 14, 12, 10, 9, 8, 7, 6, 5, 4, 3, 2);

    if ($place > 14) {
      return 1;
    }
    else {
      return $multipliers[$place - 1];
    }
  } 

  /**
   * Insert a result into the database
   */
  function addResult($result, $points) {

    /*
     * Check whether the fencer is already in the database
     */

    if (preg_match("/[0-9]+/", $result['licence'])) {
      $query = "SELECT `id` 
                FROM `jos_nwjs_fencers`
                WHERE `BFA_number` = '" . $result['licence'] . "'";
    }
    else {
      list($surname, $forename) = explode(',', $result['name']);
      $query = "SELECT `id` 
                FROM `jos_nwjs_fencers`
                WHERE `surname` = '$surname' AND
                      `forename`= '$forename'";
    }

    $rc = mysql_query($query);
    if (! $rc) {
      die("Could not instantiate query:\n$query\nResult was " . 
	  mysql_error() . "\n");
    }

    $row = mysql_fetch_row($rc);

    if (! is_null($row[0])) {
	$fencers_id = $row[0];
    }
    else {
      /*
       * The fencer does not exist in the database and we must add them
       * Initially try and get a club id for this fencer
       */

      $clubs_id = -1;

      if (! is_null($result['club'])) {
        $query = "SELECT `id` 
                  FROM `jos_nwjs_clubs`
                  WHERE `name` = '" . $result['club'] . "'";

        $rc = mysql_query($query);
        if (! $rc) {
	  die("Could not instantiate query:\n$query\nResult was " . 
	      mysql_error() . "\n");
        }

        $row = mysql_fetch_row($rc);

        if (! is_null($row[0])) {
	  $clubs_id = $row[0];
        }
      }

      /*
       * Now add the fencer to the database
       */

      list($surname, $forename) = explode(",", $result['name']);
      $insert = "INSERT INTO `jos_nwjs_fencers`(`forename`, `surname`,
                                          `BFA_number`, `clubs_id`";

      $values = "VALUES('" . mysql_real_escape_string($forename) . "' ,'" .
       	               mysql_real_escape_string($surname) . "','" . 
                       $result['licence'] . "'," . $clubs_id;  

      if (is_null($result['born']) || ! is_int($result['born']) {
	$query = "$insert) $values)";
      }
      else {
	$query = "$values, `year_of_birth`) $values, " .
	  $result['born'])";
      }

      $rc = mysql_query($query);
      if (! $rc) {
	die("Could not instantiate query:\n$query\nResult was " . 
	    mysql_error() . "\n");
      }

      $fencers_id =  mysql_insert_id();

      if (! is_int($fencers_id)) {
	die("Could not instantiate query:\n$query\nResult was " . 
	    mysql_error() . "\n");
      }
    }

    /*
     * We should now have all the data we need to add the result
     * to the database
     */

    if (is_int($result['place'])) {
      $place = $result['place'];
    }
    else {
      /*
       * For a tied place fencing time includes the suffix 'T'
       */

      $matches = array();
      preg_match("/^[0-9]+/", $result['place'], $matches);
      $place = $matches[0];
    }

    $query = "INSERT INTO `jos_nwjs_results`(`position`, `points`, 
                                        `fencers_id`, `competitions_id`)
              VALUES($place, $points, $fencers_id, " .
                     $this->_competitions_id . ")"; 

    $rc = mysql_query($query);
    if (! $rc) {
      die("Could not instantiate query:\n$query\nResult was " . 
	  mysql_error() . "\n");
    }

    return true;
  }
}
?>
	
}