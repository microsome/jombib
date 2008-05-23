<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class TOOLBAR_publications {
  function _NEW() {
    JToolBarHelper::save();
    JToolBarHelper::apply();
    JToolBarHelper::cancel();
  }

  function _DEFAULT() {
    JToolBarHelper::title( JText::_( 'Publications' ), 'generic.png' );
    JToolBarHelper::publishList();
    JToolBarHelper::unpublishList();
    JToolBarHelper::editList();
    JToolBarHelper::deleteList();
    JToolBarHelper::addNew();
  }
}

?>

