<form action="index.php" method="post"
    name="adminForm" id="adminForm">
  <fieldset class="adminform">
    <legend>Details</legend>
    <table class="admintable">
      <!-- Title  -->
      <tr>
        <td width="100" align="right" class="key">
          <label for="title">
            Title:
          </label>
        </td>
        <td>
          <input class="text_area" type="text" name="title"
              id="title" size="50" maxlength="250"
              value="<?php echo $this->row->title;?>" />
        </td>
      </tr>
      <!-- Entry Type  -->
      <tr>
        <td width="100" align="right" class="key">
          <label for="entrytype">
            Entry Type:
          </label>
        </td>
        <td>
          <?php 
            echo $this->lists['entrytype'];
          ?>
        </td>
      </tr>
      <!-- Address  -->
      <tr>
        <td width="100" align="right" class="key">
          <label for="address">
            Address:
          </label>
        </td>
        <td>
          <input class="text_area" type="text" name="address"
              id="address" size="100" maxlength="250"
              value="<?php echo $this->row->address;?>" />
        </td>
      </tr>
      <!-- Annote TODO  -->
      <!-- Author  -->
      <tr>
        <td width="100" align="right" class="key">
          <label for="author">
            Author(s):
          </label>
        </td>
        <td>
          <input class="text_area" type="text" name="author"
              id="author" size="100" maxlength="250"
              value="<?php echo $this->row->author;?>" />
        </td>
      </tr>
    </table>
  </fieldset>
  <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
  <input type="hidden" name="published" value="<?php echo $this->row->published; ?>" />
  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="task" value="" />
</form>