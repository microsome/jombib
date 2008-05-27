<?php

defined( '_JEXEC' ) or die( 'Restricted access' ); 

class HTML_publications { 
  function editPublication( $row, $lists, $option ) {
    $editor =& JFactory::getEditor();
    ?>
    <form action="index.php" method="post" 
        name="adminForm" id="adminForm"> 
      <fieldset class="adminform"> 
        <legend>Details</legend>
        <table class="admintable">
          <tr> 
	        <td width="100" align="right" class="key"> 
	          Title:</td> 
	        <td> 
              <input class="text_area" type="text" name="title" 
	              id="name" size="50" maxlength="250" 
		          value="<?php echo $row->title;?>" /> 
	        </td>
	      </tr>
        </table>
      </fieldset> 
      <input type="hidden" name="id" value="<?php echo $row->id; ?>" /> 
      <input type="hidden" name="option" value="<?php echo $option;?>" />
      <input type="hidden" name="task" value="" /> 
    </form>
    <?php
  }

  function showPublications( $option, &$rows, &$pageNav ) {
    ?>
    <form action="index.php" method="post" name="adminForm"> 
      <table class="adminlist"> 
	      <thead> 
	        <tr> 
	          <th width="20">
              <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
            </th>
            <th class="title">Title</th>
          </tr> 
        </thead>
        <?php
        jimport('joomla.filter.output');
        $k = 0;
        for ($i=0, $n=count( $rows ); $i < $n; $i++) {
	        $row = &$rows[$i]; 
	        $checked = JHTML::_('grid.id', $i, $row->id );
	        //$published = JHTML::_('grid.published', $row, $i );
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
          </tr> 
	        <?php 
            $k = 1 - $k; 
	      }
	      ?>
        <tfoot> 
	        <td colspan="7"><?php echo $pageNav->getListFooter();?></td> 
	      </tfoot>
      </table>
      <input type="hidden" name="option" value="<?php echo $option;?>" /> 
	    <input type="hidden" name="task" value="" /> 
	    <input type="hidden" name="boxchecked" value="0" /> 
    </form> 
    <?php
  } 
}

?>
