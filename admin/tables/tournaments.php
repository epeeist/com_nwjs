<?php
/**
 * @package    NWJS
 * @subpackage Tables
 * @author     Colin Walls {@link }
 * @author     Created on 11-Apr-2012
 * @license    GNU/GPL
 */

//-- No direct access
defined('_JEXEC') || die('=;)');


/**
 * NWJS Table class for tournament data
 *
 * @package    NWJS
 * @subpackage Components
 */
class NWJSTableTournaments extends JTable {
/**
 * Tournaments Table class
 *
 * @package    nwjs
 * @subpackage Tables
 */
  /** @var int */
  var $id = null;
  /** @var string */
  var $name = null;
  /** @var DateTime */
  var $date = null; 

  public function __construct(&$db) {
    parent::__construct('#__nwjs_tournaments', 'id', $db);
  }

/**
 * Check whether the record is valid
 *
 * @return boolean, whether the record is valid or not
 */
  function check() {
    if (trim($this->name) == '') {
      $this->setError( JText::_('Tournament name cannot be null'));
      return false;
    }
    
    list($year, $month, $day) = explode("-", $this->date);
    
    if (! checkdate($month, $day, $year)) {
      $this->setError( JText::_('Invalid date for tournament'));
      return false;    
    }

    return true;
  }

  /**
   * Stores a tournament
   *
   * @param       boolean True to update fields even if they are null.
   * @return      boolean True on success, false on failure.
   */
  public function store($updateNulls = false) {
    // Attempt to store the data.
    return parent::store($updateNulls);
  }
}

