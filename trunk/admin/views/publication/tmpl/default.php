<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="contentpaneopen">
  <tr>
    <td width="100%" class="contentheading">
      <?php echo $this->publication->title; ?>
    </td>
  </tr>
  <tr>
    <table>
      <?php          
      foreach($this->publication as $key => $value) {
        if($value) {
          //special situations.
          switch($key) {
          case 'bibyear':
            if(intval($value) != 0000) {
              printRow($key, $value);
            }
            break;
          /*
          case 'submitted_time':
            if($value != '0000-00-00 00:00:00')
              printRow($key, JHTML::_('date',$value, '%Y-%m-%d %H:%M:%S, %Z'), 'Submitted Time');
            break;
          case 'submitted_by':
            printRow($key, $this->lists['submitted_by'], 'Submitted By');
            break;
          */
          case 'id':
          case 'entrytype':
          case 'published':
          case 'submitted_by':
          case 'submitted_time':
            break;
          default:
            printRow($key, $value);
          }
        }
      }
      ?>
    </table>
  </tr>
</table>

<?php
function printRow($key, $value, $keyLabel="")
{
  //deal with 'bib' prefix
  if(substr($key, 0, 3) == 'bib') {
    $key = substr($key, 3);
  }

  if(empty($keyLabel)) {
    $keyLabel = ucfirst($key);
  }

?>
  <tr>
    <td><strong><?php echo $keyLabel; ?>: </strong></td>
    <td>
      <?php echo $value; ?>    
    </td>
  </tr>
<?php   
}
?>
