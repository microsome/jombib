<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( JPATH_COMPONENT.DS.'controller.php' ); 

JTable::addIncludePath(JPATH_COMPONENT.DS.'tables'); 

$controller = new PublicationsController(); 
$controller->execute( JRequest::getVar( 'task' ) ); 
$controller->redirect();
?>
