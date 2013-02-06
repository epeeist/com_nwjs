<?php
/**
 * @package    NWJS
 * @subpackage Views
 * @author     Colin Walls {@link }
 * @author     Created on 11-Apr-2012
 * @license    GNU/GPL
 */

//-- No direct access
defined('_JEXEC') or die('=;)');

$doc =& JFactory::getDocument();
$uri = JURI::getInstance();

$doc->setTitle("Get Tournament Results");

/*
 * Custom CSS for the form
 */

JHTML::stylesheet('nwjs.css', 'components/com_nwjs/assets/css/');

/*
 * Add the tooltips javascript
 */

JHTML::_('behavior.tooltip');
?>

  <h1 class='title'>Select Results</h1>
  <div class="clear"></div>

  <form action="index.php" id="byResult" class="nwjs">
  <fieldset>
    <legend>List Results</legend>
    
    <div>
      <label for="tournament">
        <?php
          echo JHTML::tooltip('Select the tournament from the drop down list', '', '', 'Tournament');
        ?>
      </label>
      <select name="tournament">
        <?php
          foreach ($this->tournaments as $tournament) {
          	$date = DateTime::createFromFormat('Y-m-d', $tournament->date);
            
            echo "<option value='" . $tournament->id . "'>" . $tournament->name .
              ' - ' . $date->format('F Y') . "</option>\n";
          }
        ?>
      </select>
    </div>

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
          foreach ($this->competitionTypes as $type) {
            echo "<option value='" . $type->id . "'>" . $type->title . "</option>\n";
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
  <input type="hidden" name="view" value="overall" />
  <input type="hidden" name="option" value="com_nwjs" />
  <input type="submit" value="Show" />
</form>

<br /><br />

<form action="index.php" id="personalResults" class="nwjs">
  <fieldset>
    <legend>Personal Results</legend>

    <div>
      <label for="surname">
        <?php 
          echo JHTML::tooltip('You can enter a full or partial surname with wildcards (*)', 
                              '', '', 'Surname');
        ?>
      </label>
      <input type="text" name="surname" />
     </div>

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
          foreach ($this->competitionTypes as $type) {
            echo "<option value='" . $type->id . "'>" . $type->title . "</option>\n";
          }
        ?>
      </select>
    </div>

    <div>
      <label for="fromYear">
        <?php 
          echo JHTML::tooltip('Choose the year you wish to start from the drop down list', 
            '', '', 'Start Year');
        ?>
      </label>
      <select name="fromYear">
        <?php
          for ($year = $this->lowestYear; $year <= $this->highestYear; $year++) {
            if ($year == $this->lowestYear) {
               echo "<option selected='selected'>" . $year . "</option>\n";
            } 
            else {
              echo "<option>" . $year . "</option>\n";
            }
          }
        ?>
      </select>
    </div>

    <div>
      <label for="toYear">
        <?php 
          echo JHTML::tooltip('Choose the year you wish end at from the drop down list', 
            '', '', 'End Year');
        ?>
      </label>
      <select name="toYear">
        <?php
          for ($year = $this->lowestYear; $year <= $this->highestYear; $year++) {
            if ($year == $this->highestYear) {
               echo "<option selected='selected'>" . $year . "</option>\n";
            } 
            else {
              echo "<option>" . $year . "</option>\n";
            }
          }
        ?>
      </select>
    </div>
  </fieldset>
  <input type="hidden" name="view" value="personal" />
  <input type="hidden" name="option" value="com_nwjs" />
  <input type="submit" value="Search" />
</form>

<br /><br />

<form action="index.php" id="clubResults" class="nwjs">
  <fieldset>
    <legend>Club Results</legend>

    <div>
      <label for="club">
        <?php 
          echo JHTML::tooltip('You can enter a full or partial club name with wildcards (*)', 
                              '', '', 'Club');
        ?>
      </label>
      <input type="text" name="club" />
     </div>

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
          foreach ($this->competitionTypes as $type) {
            echo "<option value='" . $type->id . "'>" . $type->title . "</option>\n";
          }
        ?>
      </select>
    </div>

    <div>
      <label for="fromYear">
        <?php 
          echo JHTML::tooltip('Choose the year to start from the drop down list', '', '', 'Start Year');
        ?>
      </label>
      <select name="fromYear">
        <?php
          for ($year = $this->lowestYear; $year <= $this->highestYear; $year++) {
            if ($year == $this->lowestYear) {
               echo "<option selected='selected'>" . $year . "</option>\n";
            } 
            else {
              echo "<option>" . $year . "</option>\n";
            }
          }
        ?>
      </select>
    </div>

    <div>
      <label for="toYear">
        <?php 
          echo JHTML::tooltip('Choose the year you wish end at from the drop down list', 
                              '', '', 'End Year');
        ?>
      </label>
      <select name="toYear">
        <?php
          for ($year = $this->lowestYear; $year <= $this->highestYear; $year++) {
            if ($year == $this->highestYear) {
               echo "<option selected='selected'>" . $year . "</option>\n";
            } 
            else {
              echo "<option>" . $year . "</option>\n";
            }
          }
        ?>
      </select>
    </div>
  </fieldset>
  <input type="hidden" name="view" value="club" />
  <input type="hidden" name="option" value="com_nwjs" />
  <input type="submit" value="Search" />
</form>