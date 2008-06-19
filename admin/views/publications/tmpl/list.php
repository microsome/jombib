<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once (JPATH_COMPONENT.DS.'helpers'.DS.'bibtex.php');

$current_year = $this->items[0]->bibyear;
?>
<h2><?php echo $current_year; ?></h2>
<p><ul>
<?php
foreach( $this->items as $row) :
  $year = $row->bibyear;
  $year_changed = false;
  if($year != $current_year) {
    $year_changed = true;
    $current_year = $year;
  }
  if($year_changed) {
?>
    </ul></p>
    <h2><?php echo (intval($current_year) != 0) ? $current_year : 'Other' ; ?></h2>
    <p><ul>
<?php } ?>
  <li>
    <?php
    $author_str = PublicationsHelperBibTeX::parseAuthorNameString($row->author, $this->params->get('author_display_format'));
    $journalbooktile = !empty($row->journal) ? $row->journal : $row->booktitle;
    $line = (!empty($author_str) ? '<b>' . $author_str . '</b>, ' : '')
      . (!empty($row->title) ? '"' . $row->title . '", ' : '')
      . (!empty($journalbooktile) ? '<i>' . $journalbooktile . '</i>, ' : '')
      . (!empty($row->bibmonth) ? $row->bibmonth : '')
      . (!empty($row->bibmonth) && intval($row->bibyear) != 0 ? '/' : '')
      . (intval($row->bibyear) != 0 ? $row->bibyear : '');
    echo $line;
    ?>
  </li>
<?php
endforeach;
?>

</ul></p>

