<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.view');

class PublicationsViewPublication extends JView
{
  function display($tpl = null)
  {
    global $option, $mainframe;
    
    $model = &$this->getModel();
    
    $pub = $model->getPublication();
    $pathway =& $mainframe->getPathWay();
    
    $menu = &JSite::getMenu();
    $item = $menu->getActive();
    $params =& $menu->getParams($item->id);
        
    $pathway->addItem($pub->title, '');
    
    $this->assignRef('publication', $pub);
    $this->assignRef('option', $option);
            
    parent::display($tpl);
  }
}

?>