<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.view');

class PublicationsViewPublication extends JView {

  function display($tpl = null) {
    global $option;

    if($this->getLayout() == 'form') {
      $this->_displayForm($tpl);
      return;
    }
    
  }

  function _displayForm($tpl) {
    $pub =& $this->get('Data');
    $this->assignRef('row', $pub);
    parent::display($tpl);
  }

}

?>
