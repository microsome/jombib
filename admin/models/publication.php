<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

class PublicationsModelPublication extends JModel {
  var $_data = null;
  var $_id = null;

  function __construct() {
    parent::__construct();
    
    $array = JRequest::getVar('cid', array(0), '', 'array');
    $this->setId((int)$array[0]);
  }
  
  function setId($id) {
    // Set weblink id and wipe data
    $this->_id= $id;
    $this->_data= null;
  }

  function &getData() {
    if(!$this->_loadData()) {
      //
    } else {
      $this->_initData();
    }

    return $this->_data;
  }

  function _loadData() {
    // Lets load the content if it doesn't already exist
    if (empty($this->_data)) {
      $query = "SELECT * FROM #__publications WHERE id = '" . $this->_id . "'";
      $this->_db->setQuery($query);
      $this->_data = $this->_db->loadObject();
      return (boolean) $this->_data;
    }
    return true;
  }

  function _initData() {
    // Lets load the content if it doesn't already exist
    if (empty($this->_data)) {
      $weblink = new stdClass();
      $this->_data= $weblink;
      return (boolean) $this->_data;
    }
    return true;
  }
  
  function store($data) {
    $row =& $this->getTable();

    if (!$row->bind($data)) {
      echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
      exit();
    }

    if(intval($row->id) < 1) {
      //new
      $datenow =& JFactory::getDate();
      $row->submitted_time = $datenow->toMySQL();
    }

    if (!$row->store()) {
      echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
      exit();
    }
  }
}

?>
