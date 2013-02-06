<?php
/**
 * @package    NWJS
 * @subpackage Views
 * @author     Colin Walls {@link }
 * @author     Created on 11-Apr-2012
 * @license    GNU/GPL
 */

//-- No direct access
defined('_JEXEC') || die('=;)');


jimport('joomla.application.component.view');

/**
 * HTML View class for the NWJS Component.
 *
 * @package    NWJS
 * @subpackage Views
 */
class NWJSViewNWJSList extends JView {
  /**
   * NWJSList view display method
   *
   * @param null $tpl
   *
   * @return void
   */
  public function display($tpl = null) {
    //-- Get data from the model
    $this->items = $this->get('Items');

    //-- Get a JPagination object
    $this->pagination = $this->get('Pagination');

    // Die Toolbar hinzufügen
    $this->addToolBar();

    // Auf Fehler prüfen
    $errors = $this->get('Errors');

    if(count($errors)) {
      JFactory::getApplication()->enqueueMessage(implode('<br />', $errors), 'error');

      return;
    }

    // Das Template wird aufgerufen
    parent::display($tpl);

    // Set the document
    $this->setDocument();
  }//function

  /**
   * Setting the toolbar
   */
  protected function addToolBar() {
    JToolBarHelper::title(JText::_('COM_NWJS_MANAGER_NWJSLIST'), 'nwjs');

    JToolBarHelper::addNew('nwjs.add');
    JToolBarHelper::editList('nwjs.edit');
    JToolBarHelper::deleteList('', 'nwjslist.delete');

    // CSS class for the 48x48 toolbar icon
    JFactory::getDocument()->addStyleDeclaration('.icon-48-nwjs' . 
      '{background-image: url(components/com_nwjs/assets/images/com_nwjs-48.png)}');
  }//function

  /**
   * Method to set up the document properties
   *
   * @return void
   */
  protected function setDocument() {
    JFactory::getDocument()->setTitle(JText::_('COM_NWJS_NWJS_ADMINISTRATION'));
  }//function
}//class
