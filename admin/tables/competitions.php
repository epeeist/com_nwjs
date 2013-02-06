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
 * NWJS Table class for competition data
 *
 * @package    NWJS
 * @subpackage Components
 */
class NWJSTableCompetitions extends JTable {
/**
 * Competition Table class
 *
 * @package    nwjs
 * @subpackage Tables
 */
  /** @var int */
  var $id = null;
  /** @var int */
  var $catid = null;
  /** @var int */
  var $tournaments_id = null;
  
  public function __construct(&$db) {
    parent::__construct('#__nwjs_competitions', 'id', $db);
  }

/**
 * Check whether the record is valid
 *
 * @return boolean, whether the record is valid or not
 */
  function check() {
    if (is_null($this->catid) || ! is_int($this->catid)) {
      $this->setError( JText::_('Category index is invalid'));
      return false;
    }

    if (is_null($this->tournaments_id) || ! is_int($this->tournaments_id)) {
      $this->setError( JText::_('Tournament index is invalid'));
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

