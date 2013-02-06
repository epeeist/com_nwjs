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
       <td><?php echo $result->position ;?></td>
       <td><?php echo $result->points ;?></td>
    </tr>
    <?php
      }
    ?>
  </tbody>
</table>
<?php
}

$doc =& JFactory::getDocument();

$doc->setTitle("Personal Results");

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
$doc->setTitle("Competition Results for " . ucfirst($this->surname));
?>
<h1 class='title'>Competition Results for <?php echo ucfirst($this->surname); ?></h1>
<?php
while (list($tournament, $personalResults) = each($this->results)) {
  ?>
  <h3>Results for <?php echo $tournament; ?></h3>
  <?php
  if ($personalResults) {
    resultsTable($personalResults);
  }
  else {
    ?>
    <p>No results for this tournament</p>
    <?php
  }
}
?>

