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
 * NWJSList Model.
 *
 * @package NWJS
 * @subpackage Models
 */
class NWJSModelNWJSList extends JModelList
{
    /**
     * Method to build an SQL query to load the list data.
     * Funktion um einen SQL Query zu erstellen der die Daten für die Liste läd.
     *
     * @return string SQL query
     */
    protected function getListQuery()
    {
        // Ein Datenbankobjekt beziehen.
        $db = JFactory::getDBO();

        // Ein neues (leeres) Queryobjekt beziehen.
        $query = $db->getQuery(true);

        //*** ECR AUTOCODE START [admin.models.model.nwjs.buildquery16] ***//
        $query->from('#__nwjs AS a ');
        $query->leftjoin(' #__categories AS b ON b.id = a.catid');
        $query->select('a.id, a.catid, a.Description, b.title AS category');
//*** ECR AUTOCODE END [admin.models.model.nwjs.buildquery16] ***//

        return $query;
    }//function
}//class
