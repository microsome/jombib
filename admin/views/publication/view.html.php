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
    $lists = array();
    
    $lists['entrytype'] = JHTML::_('select.genericlist', $this->_createEntryTypeInput(), 
        'entrytype', 'class="inputbox" '. '', 'value', 'text', $pub->entrytype );
    $this->assignRef('lists',$lists);
    $this->assignRef('row', $pub);
    parent::display($tpl);
  }

  function _createEntryTypeInput() {
    $entrytype = array ( 
      '0' => array('value' => 'article', 'text' => 'Article'), 
      '1' => array('value' => 'booklet', 'text' => 'Booklet'), 
      '2' => array('value' => 'conference', 'text' => 'Conference'), 
      '3' => array('value' => 'inbook', 'text' => 'Inbook'),
      '4' => array('value' => 'incollection', 'text' => 'Incollection'),
      '5' => array('value' => 'inproceedings', 'text' => 'Inproceedings'),
      '6' => array('value' => 'manual', 'text' => 'Manual'),
      '7' => array('value' => 'mastersthesis', 'text' => 'Mastersthesis'),
      '8' => array('value' => 'misc', 'text' => 'Misc'),
      '9' => array('value' => 'phdthesis', 'text' => 'Phdthesis'),
      '10' => array('value' => 'proceedings', 'text' => 'Proceedings'),
      '11' => array('value' => 'techreport', 'text' => 'TechReport'),
      '12' => array('value' => 'unpublished', 'text' => 'Unpublished')       
    );
    return $entrytype;
  }

}

?>
