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

JHtml::_('behavior.tooltip');

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

$user		= JFactory::getUser();
$userId		= $user->get('id');
?>

<form action="<?php echo JRoute::_('index.php?option=com_nwjs'); ?>" 
  method="post" name="adminForm" id="adminForm">
  <fieldset id="filter-bar">
	<div class="filter-search fltlft">
	  <label class="filter-search-lbl" for="filter_search">
	    <?php echo JText::_('JSEARCH_FILTER_LABEL'); ?>
	  </label>
	  <input type="text" name="filter_search" id="filter_search" 
	     value="<?php echo $this->escape($this->state->get('filter.search')); ?>" 
	     title="<?php echo JText::_('COM_NWJS_SEARCH_IN_NAME'); ?>" />
	  <button type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
	  <button type="button" onclick="document.id('filter_search').value='';this.form.submit();">
	    <?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
	</div>
  </fieldset>
  <div class="clr"> </div>

  <table class="adminlist">
	<thead>
	  <tr>
        <th width="20">
          <input type="checkbox" name="toggle" value="" 
            onclick="checkAll(<?php echo count($this->items); ?>);" />
        </th>
        <th>
          <?php echo JText::_('Name'); ?>
        </th>
        <th>
          <?php echo JText::_('Id'); ?>
        </th>
      </tr>  
	</thead>
	
	<tfoot>
	  <tr>
        <td colspan="3">
  	      <?php echo $this->pagination->getListFooter(); ?>
        </td>
      </tr>
    </tfoot>
    
    <tbody>
    <?php foreach($this->items as $i => $row): ?>
    <?php $link = JRoute::_('index.php?option=com_nwjs&view=club&layout=edit&id=' .
                            $row->id); ?>
      <tr class="row<?php echo $i % 2; ?>">
        <td>
          <?php echo JHtml::_('grid.id', $i, $row->id); ?>
        </td>
        <td>
          <a href="<?php echo $link; ?>"><?php echo $row->name; ?></a>
        </td>
        <td>
          <?php echo $row->id; ?>
        </td>
      </tr>
      <?php endforeach; ?>    
    </tbody>
  </table>

  <div>
    <input type="hidden" name="option" value="com_nwjs" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="club" />
    <?php echo JHtml::_('form.token'); ?>
  </div>
</form>
