<?php
if($mainframe->isSite()) {
?>
  <script language="javascript" type="text/javascript">
  function tableOrdering( order, dir, task ) {
    var form = document.adminForm;
    form.filter_order.value = order;
    form.filter_order_Dir.value= dir;
    document.adminForm.submit( task );
  }
  </script>
<?php
}
?>
<form action="<?php if($mainframe->isAdmin()) { echo 'index.php'; } else { echo $this->action; } ?>" method="post" name="adminForm"> 
  <table width="100%">
    <tr>
      <td nowrap="nowrap">
        <?php
        //only show state selector on admin site
        if($mainframe->isAdmin()) {
          echo $this->lists['state'];
        }
        echo $this->lists['f_tag1']; 
        ?>
      </td>
      <?php
      if($mainframe->isSite()) {
      ?>
        <td colspan="6" align="right">Display Num: <?php echo $this->pagination->getLimitBox(); ?>
        </td>
      <?php } ?>
    </tr>
  </table>

   <table <?php if($mainframe->isAdmin()) echo 'class="adminlist"'; ?>> 
    <thead> 
      <tr>
        <?php if($mainframe->isAdmin()) {
        ?>
        <th width="20" nowrap>
          <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
        </th>
        <?php } ?>
        <<?php if($mainframe->isSite()) echo 'td class="sectiontableheader"'; else echo 'th class="title"'?> nowrap>
          <?php echo JHTML::_('grid.sort',  'Title', 'title', $this->lists['order_Dir'], $this->lists['order'] ); ?>
        </th>
        <<?php if($mainframe->isSite()) echo 'td class="sectiontableheader"'; else echo 'th'?> width="5%" nowrap>
          <?php echo JHTML::_('grid.sort',  'Entry Type', 'entrytype', $this->lists['order_Dir'], $this->lists['order'] ); ?>
        </th>
        <<?php if($mainframe->isSite()) echo 'td class="sectiontableheader"'; else echo 'th'?> width="30%" nowrap>
          <?php echo JHTML::_('grid.sort',  'Authors', 'author', $this->lists['order_Dir'], $this->lists['order'] ); ?>
        </th>
        <? if($mainframe->isAdmin()) { ?>
        <th width="5%" nowrap>
          <?php echo JHTML::_('grid.sort',  'Published', 'published', $this->lists['order_Dir'], $this->lists['order'] ); ?>
        </th>
        <?php } ?>
        <? if($mainframe->isAdmin()) { ?>
        <th width="5%" nowrap>
          <?php echo JHTML::_('grid.sort',  'ID', 'id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
        </th>
        <?php }?>
        <<?php if($mainframe->isSite()) echo 'td class="sectiontableheader"'; else echo 'th'?> width="5%" nowrap>
          <?php echo JHTML::_('grid.sort',  'Main Tag', 'tag1', $this->lists['order_Dir'], $this->lists['order'] ); ?>
        </th>
      </tr>
    </thead>
    <?php
    jimport('joomla.filter.output');
    $k = 0;
    for ($i=0, $n=count( $this->items ); $i < $n; $i++) {
      $row = &$this->items[$i]; 
      $checked = JHTML::_('grid.id', $i, $row->id );
      //grid.published is hard-coded to use publish/unpublish tasks.
      $published = JHTML::_('grid.published', $row, $i );
      if($mainframe->isAdmin()) {
        $link = JFilterOutput::ampReplace( 'index.php?option=' . $option . '&task=edit&cid[]='. $row->id );
      } else {
        $link = JFilterOutput::ampReplace( 'index.php?option=' . $option . '&view=publication&cid[]='. $row->id );
      }
      ?>
      <tr class="<?php echo "row$k"; ?>">
        <?php if($mainframe->isAdmin()) {?>
        <td> 
          <?php echo $checked; ?> 
        </td>
        <?php } ?>
        <td>
          <a href="<?php echo $link; ?>"> 
            <?php echo $row->title; ?>
          </a>
        </td>
        <td>
          <?php echo $row->entrytype; ?>
        </td>
        <td>
          <?php echo $row->author; ?>
        </td>
        <?php if($mainframe->isAdmin()) {?>
        <td align="center"> 
          <?php echo $published;?> 
        </td> 
        <td>
          <?php echo $row->id; ?>
        </td>
        <?php } ?>
        <td>
          <?php echo $row->tag1; ?>
        </td>
      </tr>
      <?php 
            $k = 1 - $k;
    }
    ?>
    <tfoot>
    <?php 
    if($mainframe->isAdmin()) { ?>
      <td colspan="7" align="center"><?php echo $this->pagination->getListFooter(); ?></td> 
    <?php 
    } else {
    ?>
      <tr>
        <td align="center" colspan="6" class="sectiontablefooter">
          <?php echo $this->pagination->getPagesLinks(); ?>
        </td>
      </tr>
      <tr>
        <td colspan="6" align="right">
          <?php echo $this->pagination->getPagesCounter(); ?>
        </td>
      </tr>
    <?php
    }
    ?>
    </tfoot>
  </table>
  <input type="hidden" name="option" value="<?php echo $option; ?>" /> 
  <input type="hidden" name="task" value="" />
  <!-- Added for the front-end. -->
  <input type="hidden" name="view" value="publications">
  <input type="hidden" name="boxchecked" value="0" /> 
  <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
  <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
</form> 