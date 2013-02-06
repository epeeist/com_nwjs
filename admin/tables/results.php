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
 * NWJS Table class for results data
 *
 * @package    NWJS
 * @subpackage Components
 */
class NWJSTableResults extends JTable {
/**
 * Results Table class
 *
 * @package    nwjs
 * @subpackage Tables
 */
  /** @var int */
  var $id = null;
  /** @var int */
  var $position = 999;
  /** @var int */
  var $points = -1;
  /** @var int */
  var $fencers_id = null;
  /** @var int */
  var $competitions_id = null;
  
  public function __construct(&$db) {
    parent::__construct('#__nwjs_results', 'id', $db);
  }

/**
 * Check whether the record is valid
 *
 * @return boolean, whether the record is valid or not
 */
  function check() {
    if (is_null($this->position) || ! is_int($this->position)) {
      $this->setError( JText::_('Position is invalid'));
      return false;
    }
    
  	if (is_null($this->points) || ! is_int($this->points)) {
      $this->setError( JText::_('Points value is invalid'));
      return false;
    }

    if (is_null($this->fencers_id) || ! is_int($this->fencers_id)) {
      $this->setError( JText::_('Fencers index is invalid'));
      return false;
    }

    if (is_null($this->competitions_id) || ! is_int($this->competitions_id)) {
      $this->setError( JText::_('Competition index is invalid'));
      return false;
    }    
    return true;
  }

  /**
   * Stores a competition
   *
   * @param       boolean True to update fields even if they are null.
   * @return      boolean True on success, false on failure.
   */
  public function store($updateNulls = false) {
    // Attempt to store the data.
    return parent::store($updateNulls);
  }
}

