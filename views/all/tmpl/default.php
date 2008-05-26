<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?> 
<table> 
<?php foreach($this->list as $pub): ?> 
  <tr>
    <td> 
      <a href="<?php echo $pub->link; ?>"><?php echo $pub->title; ?></a> 
    </td>
  </tr> 
<?php endforeach; ?> 
</table>