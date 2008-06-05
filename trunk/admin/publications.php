<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

if($mainframe->isSite()) {
  echo '<div class="componentheading">Publications</div>';
}

JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');
require_once( JPATH_COMPONENT.DS.'controller.php' ); 

$controller = new PublicationsController(); 
//echo JRequest::getURI();
$controller->execute( JRequest::getVar( 'task' ) ); 
$controller->redirect();
?>
