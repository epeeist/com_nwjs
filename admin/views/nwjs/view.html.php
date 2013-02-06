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
class NWJSViewNWJS extends JView
{
    /**
     * NWJSList view display method.
     *
     * @param string $tpl The name of the template file to parse;
     *
     * @return void
     */
    public function display($tpl = null)
    {
        // Die Daten werden bezogen
        $this->item = $this->get('Item');

        // Das Formular
        $this->form = $this->get('Form');

        // JavaScript
        $this->script = $this->get('Script');

        // Auf Fehler prüfen
        $errors = $this->get('Errors');

        if(count($errors))
        {
            JFactory::getApplication()->enqueueMessage(implode('<br />', $errors), 'error');

            return;
        }

        // Die Toolbar hinzufügen
        $this->addToolBar();

        // Das Template wird aufgerufen
        parent::display($tpl);

        // Set the document
        $this->setDocument();
    }

    //function

    /**
     * Setting the toolbar
     */
    protected function addToolBar()
    {
        JRequest::setVar('hidemainmenu', true);

        $isNew = ($this->item->id == 0);

        JToolBarHelper::title($isNew
                ? JText::_('COM_NWJS_MANAGER_NWJS_NEW')
                : JText::_('COM_NWJS_MANAGER_NWJS_EDIT')
            , 'nwjs');

        JToolBarHelper::save('nwjs.save');

        JToolBarHelper::cancel('nwjs.cancel'
            , $isNew
                ? 'JTOOLBAR_CANCEL'
                : 'JTOOLBAR_CLOSE');

        // CSS Klasse für das 48x48 Icon der Toolbar
        JFactory::getDocument()->addStyleDeclaration(
            '.icon-48-nwjs {background-image: url('
                .'components/com_nwjs/assets/images/com_nwjs-48.png);}'
        );
    }

    //function

    /**
     * Method to set up the document properties
     *
     * @return void
     */
    protected function setDocument()
    {
        $isNew = ($this->item->id < 1);

        $document = JFactory::getDocument();

        $document->setTitle($isNew
            ? JText::_('COM_NWJS_NWJS_CREATING')
            : JText::_('COM_NWJS_NWJS_EDITING'));

        $document->addScript(JURI::root(true).$this->script);

        $document->addScript(JURI::root(true)
            .'/administrator/components/com_nwjs/views/nwjs/submitbutton.js');

        JText::script('COM_NWJS_NWJS_ERROR_UNACCEPTABLE');
    }
    //function
}//class
