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


?>
<?php foreach($this->items as $i => $row): ?>
<?php $link = JRoute::_('index.php?option=com_nwjs&view=nwjs&layout=edit&id='
        .$row->id); ?>
<tr class="row<?php echo $i % 2; ?>">
    <td>
        <a href="<?php echo $link; ?>">
            <?php echo $row->id; ?>
        </a>
    </td>
    <td>
        <?php echo JHtml::_('grid.id', $i, $row->id); ?>
    </td>
<?php //*** ECR AUTOCODE START [admin.viewlist.table.nwjs.cell] ***// ?>
            <td>
                <?php echo $row->id; ?>
            </td>
            <td>
                <?php echo $row->catid; ?>
            </td>
            <td>
                <?php echo $row->Description; ?>
            </td>
<?php //*** ECR AUTOCODE END [admin.viewlist.table.nwjs.cell] ***// ?>
</tr>
<?php endforeach;
