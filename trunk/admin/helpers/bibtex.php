<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once 'Structures/BibTex.php';
JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS. 'com_publications'.DS.'tables');

class PublicationsHelperBibTeX {

  var $_bibtex;

  function __construct() {
    $this->_bibtex = new Structures_BibTex();
  }

  /**
   * @return PEAR_Error if there was a problem.
   */
  function loadBibtex($bibtexStr) {
    $this->_bibtex->content = $bibtexStr;
    return $this->_bibtex->parse();
  }

  /**
   * @return An array of TablePublication objects.
   */
  function toPubArray($store = false) {
    $ret_array = array();
    foreach($this->_bibtex->data as $entry) {
      $pub =& JTable::getInstance('Publication', 'Table');
      foreach($entry as $key => $val) {
        switch($key) {
        case 'author':
          $author_arr = array();
          foreach($val as $author) {
            $author_arr[] = $author['first'] . ' ' . $author['von'] . ' '
              . $author['last'] . ' ' . $author['jr'];
          }
          $author_str = array_reduce($author_arr,
            create_function('$a, $b', 'return empty($a) ? $b : "$a and $b";'));
          $pub->author = $author_str;
          break;
        case 'cite':
          break;
        case 'key':
        case 'month':
        case 'number':
        case 'type':
        case 'year':
          $key = 'bib' . $key;
          $pub->$key = $val;
          break;
        case 'entryType':
          $pub->entrytype = strtolower($val);
          break;
        default:
          $pub->$key = $val;
        }
      }

      $user =& JFactory::getUser();
      $pub->submitted_by = $user->id;

      $datenow =& JFactory::getDate();
      $pub->submitted_time = $datenow->toMySQL();
      
      if($store) {
        if (!$pub->store()) {
          echo "<script> alert('".$pub->getError()."'); window.history.go(-1); </script>\n";
          exit();
        }
      }
      $ret_array[] = $pub;
    }
    return $ret_array;
  }

  /**
   * @return The author string.
   */
  static function parseAuthorNameString($authorStr, $formatStr='LAST, FIRST') {
    if(empty($authorStr)) return '';
    $bibtex = new Structures_BibTex();
    $bibtex->content = '@misc {, author=' . $authorStr . '}';
    $bibtex->parse();
    $bibtex->authorstring = $formatStr;
    $bibtex->htmlstring = 'AUTHORS';
    $html = $bibtex->html();
    // Get rid of <p> and </p>
    return substr($html, 3, strlen($html) - 8);
  }

  

}

?>