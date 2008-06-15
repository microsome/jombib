<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.view');

class PublicationsViewPublications extends JView {

  function display($tpl = null) {
    global $mainframe, $option;

    $filter_order= $mainframe->getUserStateFromRequest( $option.'filter_order','filter_order','title');
    $filter_order_Dir= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir','filter_order_Dir','','word' );
    $filter_state= $mainframe->getUserStateFromRequest( $option.'filter_state','filter_state','','word' );
    $filter_tag1= $mainframe->getUserStateFromRequest( $option.'filter_tag1','filter_tag1','');
    $uri = &JFactory::getURI();

    // Get the page/component configuration
    if($mainframe->isSite()) {
      $params = &$mainframe->getParams();
      $filter_from_menu_params = $params->get('menu_pub_filter', 0);
      $mainframe->setUserState('menu_pub_filter', $filter_from_menu_params);
    } else {
    }

    // Get data from the model
    $items= & $this->get( 'Data');
    $total= & $this->get( 'Total');
    $pagination = & $this->get( 'Pagination' );

    // table ordering
    $lists['order_Dir'] = $filter_order_Dir;
    $lists['order'] = $filter_order;
    // state filter
    $lists['state']= JHTML::_('grid.state',  $filter_state );
    // build list of tags
    $javascript = 'onchange="document.adminForm.submit();"';
    $lists['f_tag1'] = JHTML::_('select.genericlist', $this->getModel()->getTag1($mainframe->isSite() ? true : false),
                              'filter_tag1', 'class="inputbox" '. $javascript,
                              'value', 'text', $filter_tag1 );

    for($i = 0; $i < count($items); $i++) {
      $row =& $items[$i];
      //Link to the according record.
      $row->link = JRoute::_('index.php?option=' . $option . '&id=' . $row->id  . '&view=publication');
    }

    $this->assignRef('params',$params);
    $this->assignRef('lists',$lists);
    $this->assignRef('items',$items);
    $this->assignRef('pagination',$pagination);
    $this->assign('action',$uri->toString());
    parent::display($tpl);
  }

}

?>
