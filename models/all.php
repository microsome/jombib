<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

class PublicationsModelAll extends JModel {
  var $_pubs = null;

  function getList() {
    if(!$this->_pubs) {
      $query = "SELECT * FROM #__bib";
      $this->_pubs = $this->_getList($query, 0, 0);
    }
    
    return $this->_pubs;
  }
}

?>