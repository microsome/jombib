<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.controller' );

class PublicationsController extends JController {
  
  function __construct( $default = array() ) { 
    parent::__construct( $default );
    //register function names that are NOT standardized.
    $this->registerTask( 'add' , 'edit' ); 
    $this->registerTask( 'apply', 'save' );
    //$this->registerTask( 'unpublish', 'publish' );
  }

  function save() { 
    global $option; 

    $row =& JTable::getInstance('Publication', 'Table');
    
    if (!$row->bind(JRequest::get('post'))) { 
      echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n"; 
      exit(); 
    }

    if (!$row->store()) { 
      echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n"; 
      exit(); 
    }    
    
    switch ($this->_task) {
    case 'apply': 
      $msg = 'Changes to Publication saved'; 
      $link = 'index.php?option=' . $option . '&task=edit&cid[]='. $row->id; 
      break;
	
    case 'save': 
    default: 
      $msg = 'Publication Saved'; 
      $link = 'index.php?option=' . $option; 
      break; 
    }
     
    $this->setRedirect($link, $msg); 
  }

  /**
   * Shared by add and edit
   */
  function edit() {
    global $option; 

    $row =& JTable::getInstance('Publication', 'Table');
    //cid: row id
    $cid = JRequest::getVar( 'cid', array(0), '', 'array' );
    $id = $cid[0]; 
    $row->load($id); 
    $lists = array();

    HTML_publications::editPublication($row, $lists, $option); 
  }

  function showPublications() { 
    global $option, $mainframe;
    
    $limit = JRequest::getVar('limit', $mainframe->getCfg('list_limit')); 
    $limitstart = JRequest::getVar('limitstart', 0); 
    
    $db =& JFactory::getDBO();
    $query = "SELECT count(*) FROM #__publications"; 
    $db->setQuery( $query ); 
    $total = $db->loadResult(); 
    
    $query = "SELECT * FROM #__publications"; 
    $db->setQuery( $query, $limitstart, $limit ); 
    $rows = $db->loadObjectList(); 
    
    if ($db->getErrorNum()) { 
      echo $db->stderr(); 
      return false; 
    } 
    
    jimport('joomla.html.pagination'); 
    
    $pageNav = new JPagination($total, $limitstart, $limit); 
    
    HTML_publications::showPublications( $option, $rows, $pageNav );
  }

  /**
   * Removes the publication(s)
   */
  function remove() { 
    global $option; 
    $cid = JRequest::getVar( 'cid', array(), '', 'array' ); 
    $db =& JFactory::getDBO();
     
    if(count($cid)) { 
      $cids=implode(',',$cid);$cids = implode( ',', $cid ); 
      $query = "DELETE FROM #__publications WHERE id IN ( $cids )"; 
      $db->setQuery( $query );
      if (!$db->query()) {
	echo "<script> alert('".$db->getErrorMsg()."'); window. history.go(-1); </script>\n"; 
      } 
    }
    
    $this->setRedirect( 'index.php?option=' . $option ); 
  }
}

?>
