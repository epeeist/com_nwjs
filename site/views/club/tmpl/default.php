<?php
/**
 * @package    NWJS
 * @subpackage Views
 * @author     Colin Walls {@link }
 * @author     Created on 11-Apr-2012
 * @license    GNU/GPL
 *
 * This template displays the results for a particular club.
 */

//-- No direct access
defined('_JEXEC') || die('=;)');

/**
 * Draw a table containing results for a particular tournament
 *
 * @param object list $results - the list of results
 */
function resultsTable($results) {
?>
<table class="zebra">
  <thead>
    <tr>
      <th>Competition</th>
      <th>Name</th>
      <th>Club</th>
      <th>Rank</th>
      <th>Points</th>
    </tr>
  </thead>

  <tbody>
    <?php
      foreach ($results as $result) {
    ?>
    <tr>
      <td><?php echo JText::_($result->title) ;?></td>
      <td><strong><?php echo $result->surname; ?></strong>,
        <?php echo $result->forename;?></td>
       <td><?php echo $result->club; ?></td>
       <td><?php echo $result->position;?></td>
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
$doc->setTitle("Competition Results for " . ucfirst($this->club));
?>
<h1 class='title'>Competition Results for <?php echo ucfirst($this->club); ?></h1>
<?php

/*
 * Loop over the list of tournaments displaying the results for each
 */

while (list($tournament, $clubResults) = each($this->results)) {
  ?>
  <h3>Results for <?php echo $tournament; ?></h3>
  <?php
  if ($clubResults) {
    resultsTable($clubResults);
  }
}
?>


