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
 * Fencers Model.
 *
 * @package NWJS
 * @subpackage Models
 */
class NWJSModelFencers extends JModelList
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
 
    $query->from('#__nwjs_fencers AS f, #__nwjs_clubs AS c ');
    $query->select('f.id, f.forename, f.surname, f.BFA_number, f.year_of_birth, c.name AS club ');
    $query->where('f.clubs_id = c.id ');
    $query->orderby('surname ASC, forename ASC');

    return $query;
  }//function
}//class
