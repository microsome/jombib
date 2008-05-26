<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>

<form action="index.php" method="post">
  <table>
    <tr>
      <td>
        <strong>Title:</strong>
      </td>
      <td>
        <input class="text_area" type="text" name="title"
            id="title" />
      </td>
    </tr>
  </table>
  <input type="hidden" name="task" value="save" />
  <input type="hidden" name="option" value="<?php echo $option; ?>" />
  <input type="submit" class="button" id="button" value="Submit" />
</form>
