<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

class PublicationsModelPublications extends JModel {
  var $_data = null;

  var $_total = null;

  var $_pagination = null;

  function __construct() {
    parent::__construct();

    global $mainframe, $option;
    $limit = JRequest::getVar('limit', $mainframe->getCfg('list_limit'));
    $limitstart = JRequest::getVar('limitstart', 0);
    $this->setState('limit', $limit);
    $this->setState('limitstart', $limitstart);
  }
  
  /**
   * Gets the list of publications
   */
  function getData() {
    if(empty($this->_data)) {
      $query = $this->_buildQuery();
      $this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
    }

    return $this->_data;
  }

  function getTotal() {
    if (empty($this->_total)) {
      $query = $this->_buildQuery();
      $this->_total = $this->_getListCount($query);
    }

    return $this->_total;
  }

  function getPagination() {
    if (empty($this->_pagination)) {
      jimport('joomla.html.pagination');
      $this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
    }

    return $this->_pagination;
  }

  function _buildQuery() {
    $orderby= $this->_buildContentOrderBy();
    $query = "SELECT * FROM #__publications"
      . $orderby;
    return $query;
  }

  function _buildContentOrderBy() {
    global $mainframe, $option;

    $filter_order= $mainframe->getUserStateFromRequest( $option.'filter_order','filter_order','title','cmd' );
    $filter_order_Dir= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir','filter_order_Dir','','word' );

    $orderby = ' ORDER BY '.$filter_order.' '.$filter_order_Dir.' ';

    return $orderby;
  }
}

?>
