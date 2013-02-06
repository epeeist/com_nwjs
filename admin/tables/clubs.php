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
 * NWJS Table class for club data
 *
 * @package    NWJS
 * @subpackage Components
 */
class NWJSTableClubs extends JTable {
/**
 * Clubs Table class
 *
 * @package    nwjs
 * @subpackage Tables
 */
  /** @var int */
  var $id = null;
  /** @var string */
  var $name = null;

  public function __construct(&$db) {
    parent::__construct('#__nwjs_clubs', 'id', $db);
  }

/**
 * Check whether the record is valid
 *
 * @return boolean, whether the record is valid or not
 */
  function check() {
    if (trim($this->name) == '') {
      $this->setError( JText::_('Club name cannot be null'));
      return false;
    }

    return true;
  }

  /**
   * Stores a club
   *
   * @param       boolean True to update fields even if they are null.
   * @return      boolean True on success, false on failure.
   */
  public function store($updateNulls = false) {
    // Attempt to store the data.
    return parent::store($updateNulls);
  }
}

