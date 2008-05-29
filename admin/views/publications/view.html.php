<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.view');

class PublicationsViewPublications extends JView {

  function display($tpl = null) {
    global $option;

    // Get data from the model
    $items= & $this->get( 'Data');
    $total= & $this->get( 'Total');
    $pagination = & $this->get( 'Pagination' );

    for($i = 0; $i < count($items); $i++) {
      $row =& $items[$i];
      //Link to the according record.
      $row->link = JRoute::_('index.php?option=' . $option . '&id=' . $row->id  . '&view=publication');
    }

    $this->assignRef('items',$items);
    $this->assignRef('pagination',$pagination);

    parent::display($tpl);
  }

}

?>
