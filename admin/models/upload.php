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


jimport('joomla.application.component.modeladmin');

/**
 * Upload Model.
 *
 * Gets the data from both the form and from the associated file and
 * processes it.
 * 
 * @package    NWJS
 * @subpackage Models
 */
class NWJSModelUpload extends JModelAdmin {
  private $_tournaments_id = null;
  private $_catid = null;

  /**
   * Checks to see whether the tournament exists. If it does not
   * then it creates it.
   *
   * @param string $name, the name of the tournament
   * @param date $date, the date of the tournament
   */
  function tournament($name, $date) {
  	
  	
  }
    /**
     * Returns a reference to the a Table object, always creating it.
     *
     * @param type    The table type to instantiate
     * @param string  A prefix for the table class name. Optional.
     * @param array   Configuration array for model. Optional.
     *
     * @return JTable A database object
     */
    public function getTable($type = 'NWJS', $prefix = 'NWJSTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }//function

    /**
     * Method to get the record form.
     *
     * @param array $data Data for the form.
     * @param boolean $loadData True if the form is to load its own data (default case), false if not.
     *
     * @return mixed A JForm object on success, false on failure
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
        $form = $this->loadForm('com_nwjs.nwjs', 'nwjs'
        , array('control' => 'jform', 'load_data' => $loadData));

        if(empty($form))
        {
            return false;
        }

        return $form;
    }//function

    /**
     * Method to get the data that should be injected in the form.
     *
     * @return mixed The data for the form.
     */
    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()
        ->getUserState('com_nwjs.edit.nwjs.data');

        if(empty($data))
        {
            $data = $this->getItem();
        }

        return $data;
    }//function
}//class
