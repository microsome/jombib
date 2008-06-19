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
    /* This doesn't work for front-end but works for backend.
    $limit= JRequest::getVar('limit', $mainframe->getCfg('list_limit'),'', 'int');
    $limitstart = JRequest::getVar('limitstart', 0);
    */
    
    // Get the pagination request variables
    $limit= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
    $limitstart= $mainframe->getUserStateFromRequest( $option.'.limitstart', 'limitstart', 0, 'int' );

    // In case limit has been changed, adjust limitstart accordingly
    $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

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
    $where= $this->_buildContentWhere();
    $query = "SELECT * FROM #__publications"
      . $where
      . $orderby;
    return $query;
  }

  function _buildContentOrderBy() {
    global $mainframe, $option;

    $filter_order= $mainframe->getUserStateFromRequest( $option.'filter_order','filter_order','bibyear' );
    $filter_order_Dir= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir','filter_order_Dir','desc','word' );

//     $filter_order   = JFilterInput::clean($filter_order, 'cmd');
//     $filter_order_dir = JFilterInput::clean($filter_order_dir, 'word');

    //take special care to journalbooktile filter
    if($filter_order == 'journalbooktile'){
      $orderby = ' ORDER BY journal, booktitle' .' '.$filter_order_Dir.' ';
    } else {
      $orderby = ' ORDER BY '.$filter_order.' '.$filter_order_Dir.' ';
    }

    return $orderby;
  }

  function _buildContentWhere() {
    global $mainframe, $option;
    $db=& JFactory::getDBO();
    $filter_state= $mainframe->getUserStateFromRequest( $option.'filter_state','filter_state','','word' );
    $filter_tag1= $mainframe->getUserStateFromRequest( $option.'filter_tag1','filter_tag1','');

    $where = array();
    if($filter_tag1) {
      $where[] = 'tag1 = '. $db->Quote($db->getEscaped($filter_tag1, true), false);
    }

    // Add filters only for front site view
    if($mainframe->isSite()) {
      // This param comes from the menu params and was set in view.html.php
      $menu_filter = $mainframe->getUserState('menu_pub_filter');
      if(intval($menu_filter) == 1) {
        // Show only the publications submitted by the current user.
        $user =& JFactory::getUser();
        $where[] = 'submitted_by = ' . $user->id;
      } else {
        // only show published items on front-end.
        $filter_state = 'P';
      }
    }
    
    if ( $filter_state ) {
      if ( $filter_state == 'P' ) {
        $where[] = 'published = 1';
      } else if ($filter_state == 'U' ) {
        $where[] = 'published = 0';
      }
    }
    
    $where = ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );
    return $where;
  }

  function getTag1($onlyPublished = false) {
    $db =& JFactory::getDBO();

    $query = 'SELECT DISTINCT tag1 as value, tag1 as text'
      . ' FROM #__publications'
      . ' WHERE tag1 IS NOT NULL AND tag1 <> ""'
      . ($onlyPublished ? ' AND published = 1' : '')
      . ' ORDER BY tag1'
      ;
    $db->setQuery( $query );
    // Let the first option to be a information option w/o value.
    $sel_tag = 1;
    if ( $sel_tag ) {
      $tags[] = JHTML::_('select.option',  '', '- '. JText::_( 'Select a Tag' ) .' -' );
      $tags = array_merge( $tags, $db->loadObjectList() );
    } else {
      $tags = $db->loadObjectList();
    }
    return $tags;
  }


  function storeBibtexContent($data) {
    $db =& JFactory::getDBO();
    $bibtex = $data['bibtex'];
    $pubids = $data['pubids'];
    $query = 'INSERT INTO #__publications_bibtex (bibtex, pubids)'
      . " VALUES (" . $db->Quote($bibtex) . ","
      . $db->Quote($pubids) . ')';
    $db->setQuery( $query );
    $db->query();
  }
}

?>
