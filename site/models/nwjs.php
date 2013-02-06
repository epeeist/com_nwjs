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
 * NWJS Model.
 *
 * @package    NWJS
 * @subpackage Models
 */
class NWJSModelNWJS extends JModel
{
    /**
     * Gets the Data.
     *
     * @return string The greeting to be displayed to the user
     */
    public function getData()
    {
        $id = JRequest::getInt('id');
        $db = JFactory::getDBO();

        $query = 'SELECT a.*, cc.title AS category '
        . ' FROM #__nwjs AS a '
        . ' LEFT JOIN #__categories AS cc ON cc.id = a.catid '
        . ' WHERE a.id = '.$id;

        $db->setQuery($query);
        $data = $db->loadObject();

        return $data;
    }//function
}//class
