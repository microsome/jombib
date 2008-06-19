<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('behavior.tooltip');
?>

<form action="index.php" method="post"
    name="adminForm" id="adminForm">
  <fieldset class="adminform">
    <legend>BibTeX</legend>
    <table class="admintable" id="entrytable" width="100%">
      <tr>
        <td align="center" class="key">
          <label for="bibtex">
            <span class="editlinktip hasTip" title="<?php echo JText::_('BIBTEX_SUB_HINT') ;?>">
              Please paste BibTeX content here
            </span>
          </label>
        </td>
      </tr>
      <tr>
        <td>
          <textarea class="text_area" rows="20" style="width: 100%" name="bibtex" id="bibtex"></textarea>
        </td>
      </tr>
    </table>  
  </fieldset>
  <?php
  if($mainframe->isSite()) {
  ?>
    <div>
      <button onclick="submitbutton('savebibtex')" type="button">Save</button>
      <button onclick="submitbutton('cancel')" type="button">Cancel</button>
    </div>
  <?php
  }
  ?>
  <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="view" value="" />
</form>

<?php
?>