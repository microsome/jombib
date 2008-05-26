<?php
defined( '_JEXEC' ) or die( 'Restricted access' ); 

jimport( 'joomla.application.component.controller' ); 

class PublicationsController extends JController {
  
  function __construct( $default = array() ) { 
    parent::__construct( $default );
    $this->registerTask( 'save' , 'addPublication' );
  }

  /**
   * Called by default.
   */
  function display() { 
    $document =& JFactory::getDocument(); 
    $viewName = JRequest::getVar('view', 'all');
    $layout = JRequest::getVar('layout', 'default');
    $viewType = $document->getType();
    $view = &$this->getView($viewName, $viewType); 
    $model =& $this->getModel( $viewName, 'PublicationsModel' ); 
    
    if (!JError::isError( $model )) { 
      $view->setModel( $model, true ); 
    }

    $view->setLayout($layout); 
    $view->display();
  }

  function addPublication() { 
    global $mainframe;
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
    $row->load();

    $mainframe->redirect('index.php?option=' . $option . '&id=' . $row->id . '&view=publication', 'Publication Added.'); 
  }

}

?>
