<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
echo '<div class="componentheading">Publications</div>';

require_once( JPATH_COMPONENT.DS.'controller.php' );

JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS. 'com_publications'.DS.'tables'); 

$controller = new PublicationsController(); 
$controller->execute( JRequest::getVar( 'task' ) ); 
$controller->redirect(); 
?>