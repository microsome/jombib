<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.controller' );

class PublicationsController extends JController {
  
  function __construct( $default = array() ) { 
    parent::__construct( $default );
    // Register function names that are different from task names.
    // the default task is 'display'
    $this->registerTask( 'add' , 'edit' ); 
    $this->registerTask( 'apply', 'save' );
    $this->registerTask( 'unpublish', 'publish' );
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
    JRequest::setVar( 'layout', 'form' );
    JRequest::setVar( 'view', 'publication' );
    parent::display(); 
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

  /**
   * Publish/unpublish the publication
   */
  function publish() { 
    global $option;

    $cid = JRequest::getVar( 'cid', array(), '', 'array' ); 
    
    if( $this->_task == 'publish') { 
      $publish = 1; 
    }
    else { 
      $publish = 0; 
    }
    
    $pubTable =& JTable::getInstance('Publication', 'Table'); 
    $pubTable->publish($cid, $publish); 
    $this->setRedirect( 'index.php?option=' . $option ); 
  }
}

?>
