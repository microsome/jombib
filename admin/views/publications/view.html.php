<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.view');

class PublicationsViewPublications extends JView {

  function display($tpl = null) {
    global $mainframe, $option;

    $filter_order= $mainframe->getUserStateFromRequest( $option.'filter_order','filter_order','title','cmd' );
    $filter_order_Dir= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir','filter_order_Dir','','word' );
    $uri = &JFactory::getURI();
    // Get data from the model
    $items= & $this->get( 'Data');
    $total= & $this->get( 'Total');
    $pagination = & $this->get( 'Pagination' );

    // table ordering
    $lists['order_Dir'] = $filter_order_Dir;
    $lists['order'] = $filter_order;

    for($i = 0; $i < count($items); $i++) {
      $row =& $items[$i];
      //Link to the according record.
      $row->link = JRoute::_('index.php?option=' . $option . '&id=' . $row->id  . '&view=publication');
    }

    $this->assignRef('lists',$lists);
    $this->assignRef('items',$items);
    $this->assignRef('pagination',$pagination);
    $this->assign('action',$uri->toString());
    parent::display($tpl);
  }

}

?>
