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
        'entrytype', 'class="inputbox" '. 'onchange="entrytypeChanged()"', 
        'value', 'text', $pub->entrytype );
    $lists['bibmonth'] = $this->integerlist(1, 12, 1, 'bibmonth', 
        array ('value'=>'', 'text'=> '-- Select Month  --'), '',  $pub->bibmonth);
    $lists['bibyear'] = $this->integerlist(1990, date('Y'), 1, 'bibyear', 
        array ('value'=>'', 'text'=>'-- Select Year  --'), '', $pub->bibyear);
    $lists['published'] = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', 
        $pub->published);
    $this->assignRef('lists',$lists);
    $this->assignRef('row', $pub);
    parent::display($tpl);
  }

  function integerlist( $start, $end, $inc, $name, $specialFirstOptionValueTextPair, 
      $attribs = null, $selected = null, $format = "" ) {
    $start = intval( $start );
    $end = intval( $end );
    $inc = intval( $inc );
    $arr = array();

    for ($i=$start; $i <= $end; $i+=$inc) {
      $fi = $format ? sprintf( "$format", $i ) : "$i";
      $arr[] = JHTML::_('select.option',  $fi, $fi );
    }

    if($specialFirstOptionValueTextPair != null) {
      array_unshift($arr, $specialFirstOptionValueTextPair);
    }
      
    return JHTML::_('select.genericlist',   $arr, $name, $attribs, 'value', 
        'text', $selected );
  }

  function _createEntryTypeInput() {
    $entrytype = array ( 
      '0' => array('value' => '', 'text' => '-- Entry Type --'), 
      '1' => array('value' => 'article', 'text' => 'Article'), 
      '2' => array('value' => 'book', 'text' => 'Book'),
      '3' => array('value' => 'booklet', 'text' => 'Booklet'), 
      '4' => array('value' => 'conference', 'text' => 'Conference'), 
      '5' => array('value' => 'inbook', 'text' => 'Inbook'),
      '6' => array('value' => 'incollection', 'text' => 'Incollection'),
      '7' => array('value' => 'inproceedings', 'text' => 'Inproceedings'),
      '8' => array('value' => 'manual', 'text' => 'Manual'),
      '9' => array('value' => 'mastersthesis', 'text' => 'Mastersthesis'),
      '10' => array('value' => 'misc', 'text' => 'Misc'),
      '11' => array('value' => 'phdthesis', 'text' => 'Phdthesis'),
      '12' => array('value' => 'proceedings', 'text' => 'Proceedings'),
      '13' => array('value' => 'techreport', 'text' => 'TechReport'),
      '14' => array('value' => 'unpublished', 'text' => 'Unpublished')       
    );
    return $entrytype;
  }

}

?>
