<form action="index.php" method="post" name="adminForm"> 
  <table class="adminlist"> 
    <thead> 
      <tr> 
        <th width="20">
          <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
        </th>
        <th class="title">Title1</th>
        <th width="5%">Entry Type</th>
        <th width="35%">Authors</th>
        <th width="5%">Published</th>
        <th width="5%" nowrap="nowrap">ID</th>
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
      $link = JFilterOutput::ampReplace( 'index.php?option=' . $option . '&task=edit&cid[]='. $row->id );
      ?>
      <tr class="<?php echo "row$k"; ?>">
        <td> 
         <?php echo $checked; ?> 
        </td>
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
        <td align="center"> 
            <?php echo $published;?> 
        </td> 
        <td>
            <?php echo $row->id; ?>
        </td>
      </tr>
      <?php 
            $k = 1 - $k;
    }
    ?>
    <tfoot> 
    <td colspan="7"><?php echo $this->pagination->getListFooter(); ?></td> 
    </tfoot>
  </table>
  <input type="hidden" name="option" value="<?php echo $option;?>" /> 
  <input type="hidden" name="task" value="" /> 
  <input type="hidden" name="boxchecked" value="0" /> 
</form> 