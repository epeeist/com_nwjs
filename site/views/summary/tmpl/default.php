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


JHTML::stylesheet('nwjs.css', 'components/com_nwjs/assets/css/');

/**
 * Draw a table containing rankings for a single competition type
 *
 * @param object list $rankings - the list of rankings
 */

function rankingsTable($ranks, $year, $event_id) {
  $stub = JURI::base() . "index.php?option=com_nwjs&amp;view=individual" .
          "&amp;year=$year&amp;event=$event_id&amp;fencer_id=";
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
      $ranking = 0;
      $lastPoints = 999999;
      $lastRanking = $ranking;
      
      foreach ($ranks as $rank) {
      	$ranking++;
      	
      	if ($rank->ranking_points < $lastPoints) {
      	  $lastPoints = $rank->ranking_points;
      	  $lastRanking = $ranking;
      	  $printRanking = $ranking;
      	}
      	else {
      	  $printRanking = $lastRanking;
      	}
    ?>
    <tr>
      <td><?php echo $printRanking ;?></td>
      <td><a href="<?php echo $stub . $rank->fencer_id ?>"> 
            <?php echo $rank->surname; ?>, <?php echo $rank->forename;?></a></td>
       <td><?php echo $rank->club; ?></td>
       <td><?php echo $rank->ranking_points; ?></td>
    </tr>
    <?php
      }
    ?>
  </tbody>
</table>
<?php
}
$doc =& JFactory::getDocument();

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
            
$title = JText::_(" Rankings for " . $this->year);
$doc->setTitle($title);

if ($this->event == "all") {
?>
  <h1 class='title'><?php  echo $title;?></h1>
  <p>Click on the heading to show a particular set of results</p>
<?php
  jimport("joomla.html.pane");
  $pane =& JPane::getInstance('Sliders');
  echo $pane->startPane('Content');

  while (list($comp, $overallRankings) = each($this->rankings)) {
  	if ($overallRankings) {
      echo $pane->startPanel(JText::_($comp), "$comp-panel");
      rankingsTable($overallRankings, $this->year, $this->event_id);
      echo $pane->endPanel();
  	}
  }

  echo $pane->endPane();
}
else {
  $title = JText::_(" Rankings for " . $this->event->title . " for " .
    $this->year);
  $doc->setTitle($title);
?>
  <h2 class='contenttheading'><?php echo $title; ?></h2>
  <?php
  rankingsTable($this->rankings, $this->year, $this->event_id);
}
?>