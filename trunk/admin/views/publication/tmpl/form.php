<form action="index.php" method="post"
    name="adminForm" id="adminForm">
  <fieldset class="adminform">
    <legend>Details</legend>
    <table class="admintable">
      <tr>
        <td width="100" align="right" class="key">
          Title:
        </td>
        <td>
          <input class="text_area" type="text" name="title"
              id="name" size="50" maxlength="250"
              value="<?php echo $this->row->title;?>" />
        </td>
      </tr>
    </table>
  </fieldset>
  <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="task" value="" />
</form>