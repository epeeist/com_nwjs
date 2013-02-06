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

//-- No direct access
defined('_JEXEC') or die('=;)');

/**
 * Draw a table containing results
 *
 * @param object list $results - the list of results
 */

function resultsTable($results) {
?>
<table class="zebra">
  <thead>
    <tr>
      <th>Rank</th>
      <th>Name</th>
      <th>Club</th>
      <th>Points</th>
    </tr>
  </thead>

  <tbody>
    <?php
      foreach ($results as $result) {
    ?>
    <tr>
      <td><?php echo $result->position ;?></td>
      <td><strong><?php echo $result->surname; ?></strong>,
        <?php echo $result->forename;?></td>
       <td><?php echo $result->club; ?></td>
       <td><?php echo $result->points; ?></td>
    </tr>
    <?php
      }
    ?>
  </tbody>
</table>
<?php
}

$doc =& JFactory::getDocument();

$doc->setTitle("Overall Results");

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
<?php
$date = DateTime::createFromFormat('Y-m-d', $this->tournament->date);
            
if ($this->event == "all") {
  $title = JText::_(" Results for " . $this->tournament->name . " - " .$date->format('F Y'));
  $doc->setTitle($title);
?>
  <h1 class='title'><?php  echo $title;?></h1>
  <p>Click on the heading to show a particular set of results</p>
<?php
  jimport("joomla.html.pane");
  $pane =& JPane::getInstance('Sliders');
  echo $pane->startPane('Content');

  while (list($comp, $overallResults) = each($this->results)) {
  	if ($overallResults) {
      echo $pane->startPanel(JText::_($comp), "$comp-panel");
      resultsTable($overallResults);
      echo $pane->endPanel();
  	}
  }

  echo $pane->endPane();
}
else {
  $title = JText::_("Results for " . $this->event->title . " at " .
    $this->tournament->name . " - " .$date->format('F Y'));
  $doc->setTitle($title);
?>
  <h2 class='contenttheading'><?php echo $title; ?></h2>
  <?php
  resultsTable($this->results);
}
?>
