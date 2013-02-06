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

defined('_JEXEC') or die('=;)');

$doc =& JFactory::getDocument();
$uri = JURI::getInstance();

$doc->setTitle("Get Rankings");

$live_site = $uri->base();

/*
 * Custom CSS for the form
 */

JHTML::stylesheet('nwjs.css', 'components/com_nwjs/assets/css/');

/*
 * Add the tooltips javascript
 */

JHTML::_('behavior.tooltip');
?>

  <h1 class='title'>Select Rankings</h1>
  <div class="clear"></div>

  <form action="index.php" id="rankings" class="nwjs">
  <fieldset>
    <legend>List Rankings</legend>

    <div>
      <label for="event">
        <?php 
          echo JHTML::tooltip('Select the competition type from the drop down list', '', '', 
            'Competition Type');
        ?>
      </label>
      <select name="event">
        <option selected="selected" value="all">All</option>
        <?php
          foreach ($this->competition_types as $type) {
            echo "<option value='" . $type->id . "'>" . $type->title . "</option>\n";
          }
        ?>
      </select>
    </div>
        
    <div>
      <label for="year">
        <?php
          echo JHTML::tooltip('Select the year from the drop down list', '', '', 'Year');
        ?>
      </label>
      <select name="year">
        <?php
          foreach ($this->years as $year) {           
            echo "<option value='" . $year->year . "'>" . $year->year . "</option>\n";
          }
        ?>
      </select>
    </div>



    <div>
      <label for="sort">
        <?php 
          echo JHTML::tooltip('You can sort by position, surname or club', '', '', 'Sort Order');
        ?>
      </label>
      <select name="sort">
        <option selected="selected" value="position">Position</option>
        <option value="surname">Surname</option>
        <option value="club">Club</option>
      </select>
    </div>
  </fieldset>
  <input type="hidden" name="view" value="summary" />
  <input type="hidden" name="option" value="com_nwjs" />
  <input type="submit" value="Show" />
</form>
