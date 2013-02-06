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


//-- Import the class JModelList
jimport('joomla.application.component.modellist');

/**
 * Tournaments Model.
 *
 * @package NWJS
 * @subpackage Models
 */
class NWJSModelTournaments extends JModelList
{
  /**
   * Method to build an SQL query to load the list data.
   *
   * @return string SQL query
   */
  protected function getListQuery() {
    // The datbase object
    $db = JFactory::getDBO();

    // A new query
    $query = $db->getQuery(true);
 
    $query->from('#__nwjs_tournaments AS t ');
    $query->select('t.id, t.name, t.date');

    return $query;
  }//function
}//class
