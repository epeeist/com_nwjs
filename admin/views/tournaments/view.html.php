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
 * HTML View class for the Tournaments part of the NWJS Component.
 *
 * @package    NWJS
 * @subpackage Views
 */
class NWJSViewTournaments extends JView {
  /**
   * Tournaments view display method
   *
   * @param null $tpl
   *
   * @return void
   */
  protected $items;
  protected $pagination;
  protected $state;

  /**
   * Display the view
   *
   * @return	void
   */

  public function display($tpl = null) {
    $this->items = $this->get('Items');
	$this->pagination = $this->get('Pagination');
	$this->state = $this->get('State');

	// Check for errors.
    if (count($errors = $this->get('Errors'))) {
	  JError::raiseError(500, implode("\n", $errors));
	  return false;
	}

	$this->addToolbar();
	parent::display($tpl);
  }

  /**
   * Add the page title and toolbar.
   *
   */
  protected function addToolbar() {
	require_once JPATH_COMPONENT.'/helpers/nwjs.php';

	$canDo	= NwjsHelper::getActions($this->state->get('filter.category_id'));
	$user	= JFactory::getUser();
	JToolBarHelper::title(JText::_('COM_NWJS_MANAGER_TOURNAMENTS'), 'tournament.png');

	if ($canDo->get('core.create') || 
	    (count($user->getAuthorisedCategories('com_nwjs', 'core.create'))) > 0) {
	  JToolBarHelper::addNew('tournament.add');
	}

	if (($canDo->get('core.edit')) || ($canDo->get('core.edit.own'))) {
	  	JToolBarHelper::editList('tournament.edit');
	}

	if ($canDo->get('core.edit.state')) {
	  JToolBarHelper::divider();
	  JToolBarHelper::archiveList('tournaments.archive');
	  JToolBarHelper::checkin('tournaments.checkin');
	}

	if ($this->state->get('filter.published') == -2 && $canDo->get('core.delete')) {
	  JToolBarHelper::deleteList('', 'tournaments.delete', 'JTOOLBAR_EMPTY_TRASH');
	  JToolBarHelper::divider();
	}
	elseif ($canDo->get('core.edit.state')) {
	  JToolBarHelper::trash('tournaments.trash');
	  JToolBarHelper::divider();
	}

	if ($canDo->get('core.admin')) {
	  JToolBarHelper::preferences('com_nwjs');
	  JToolBarHelper::divider();
	}

	JToolBarHelper::help('JHELP_COMPONENTS_NWJS_TOURNAMENTS');
  }
}