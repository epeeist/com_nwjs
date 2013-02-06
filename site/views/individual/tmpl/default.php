<?php
/**
 * @package    NWJS
 * @subpackage Views
 * @author     Colin Walls {@link }
 * @author     Created on 11-Apr-2012
 * @license    GNU/GPL
 *
 * This shows the detailed results for a particular fencer that contributed
 * to the ranking at a particular event type for a particular year.
 */

//-- No direct access
defined('_JEXEC') || die('=;)');

$title = "Individual Rankings for " . $this->names->forename . " " .
         $this->names->surname . " for " . $this->names->title . " " . $this->year;

$doc =& JFactory::getDocument();

$doc->setTitle("$title");

JHTML::stylesheet('nwjs.css', 'components/com_nwjs/assets/css/');
JHTML::stylesheet('zebra.css', 'components/com_nwjs/assets/css/');

JHTML::_("behavior.mootools");
JHTML::script('zebra.js', 'components/com_nwjs/assets/js/');
?>
<script type="text/javascript">
  window.addEvent('domready', function() {
      var zTables = new ZebraTables('zebra');
  });
</script>
<h1 class='title'><?php echo $title?></h1>
<table class="zebra">
  <thead>
    <tr>
      <th>Tournament</th>
      <th>Date</th>
      <th>Position</th>
      <th>Points</th>
    </tr>
  </thead>

  <tbody>
    <?php
      foreach ($this->results as $result) {
    ?>
    <tr>
      <td><?php echo JText::_($result->name) ;?></td>
      <td><?php
           $date = DateTime::createFromFormat('Y-m-d',  $result->date);
           echo $date->format('jS F, Y'); ?></td>
       <td><?php echo $result->position ;?></td>
       <td><?php echo $result->points ;?></td>
    </tr>
    <?php
      }
    ?>
  </tbody>
</table>
