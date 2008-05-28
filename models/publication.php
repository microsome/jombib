<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

class PublicationsModelPublication extends JModel {
  var $_data = null;
  var $_id = null;
  
  function __construct() {
    parent::__construct();
    $menu = &JSite::getMenu();
    $item = $menu->getActive();
    $params =& $menu->getParams($item->id);
    $id = $params->get('id', 0);
    
    if(!$id) {
      $id = JRequest::getVar('id', '');
    }

    $this->_id = $id;
  }
  
  function getPublication() {
    if(!$this->_data) {
      $query = "SELECT * FROM #__publications WHERE id = '" . $this->_id . "'";
      $this->_db->setQuery($query);
      $this->_data = $this->_db->loadObject();
    }
    
    return $this->_data;
  }
}

?>