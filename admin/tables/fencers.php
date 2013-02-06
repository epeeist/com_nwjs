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
 * NWJS Table class for Fencer data
 *
 * @package    NWJS
 * @subpackage Components
 */
class NWJSTableFencers extends JTable {
/**
 * Fencers Table class
 *
 * @package    nwjs
 * @subpackage Tables
 */
  /** @var int */
  var $id = null;
  /** @var string */
  var $forename = null;
  /** @var string */
  var $surname = null;
  /** @var int */
  var $BFA_number= null;
  /** @var int */
  var $year_of_birth = 2000;
  /** @var int */
  var $clubs_id = -1;

  public function __construct(&$db) {
    parent::__construct('#__nwjs_fencers', 'id', $db);
  }

/**
 * Check whether the record is valid
 *
 * @return boolean, whether the record is valid or not
 */
  function check() {
    if (trim($this->forename) == '') {
      $this->setError( JText::_('Forename must be specified'));
      return false;
    }
        
    if (trim($this->surname) == '') {
      $this->setError( JText::_('Surname must be specified'));
      return false;
    }

    if (is_nan($this->year_of_birth) && $this->year_of_birth < 0) {
      $this->setError( JText::_('Year of birth is invalid'));
      return false;
    }

    if (is_null($this->clubs_id)) {
      $this->setError( JText::_('Club must be specified'));
      return false;
    }    

    return true;
  }

  /**
   * Stores a fencer
   *
   * @param       boolean True to update fields even if they are null.
   * @return      boolean True on success, false on failure.
   */
  public function store($updateNulls = false) {
    // Attempt to store the data.
    return parent::store($updateNulls);
  }
}

