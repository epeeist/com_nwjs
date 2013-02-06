<?php
/**
 * @package    NWJS
 * @subpackage Base
 * @author     Colin Walls {@link }
 * @author     Created on 11-Apr-2012
 * @license    GNU/GPL
 */

//-- No direct access
defined('_JEXEC') || die('=;)');


jimport('joomla.application.component.controller');

/**
 * NWJS default Controller.
 *
 * @package    NWJS
 * @subpackage Controllers
 */

/**
 * NWJS default Controller
 *
 * @package    nwjs
 * @subpackage Controllers
 */

class nwjsController extends JController {
  /**
   * Default task to show the form with the choice of
   * results listings
   *
   * @access public
   * @return null
   */

  function display() {
    JRequest::setVar('view', 'results');
  	JRequest::setVar('layout', 'form');
    parent::display();
  }

  /**
   * Returns the standard list of results
   *
   * @access public
   * @return null
   */

  function overall() {
    JRequest::setVar('view', 'overall');
    parent::display();
  }

  /**
   * Show results for a particular person
   *
   * @access public
   * @return null
   */

  function personal() {
    JRequest::setVar('view', 'personal');
    parent::display();
  }

  /**
   * Show results for a particular club
   *
   * @access public
   * @return null
   */

  function club() {
    JRequest::setVar('view', 'club');
    parent::display();
  }
  
  /**
   * Show the rankings form
   *
   * @access public
   * @return null
   */

  function rankings() {
  	JRequest::setVar('layout', 'form');
    JRequest::setVar('view', 'rankings');
    parent::display();
  }  
  
  /**
   * Show the summary rankings list
   *
   * @access public
   * @return null
   */

  function summary() {
    JRequest::setVar('view', 'summary');
    parent::display();
  }  

  /**
   * Show the detailed rankings for a particular person
   *
   * @access public
   * @return null
   */

  function individual() {
    JRequest::setVar('view', 'individual');
    parent::display();
  }    
}
