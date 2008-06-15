<?php
defined('_JEXEC') or die('Restricted access');

class TablePublication extends JTable {
  /* System fileds  */
  var $id = null;
  var $entrytype = null;
  var $published = null;
  var $submitted_by = null;
  var $submitted_time = null;
  /* Standard bibtex fileds */
  var $address = null;
  var $annote = null;
  var $author = null;
  var $booktitle = null;
  var $chapter = null;
  var $crossref = null;
  var $edition = null;
  var $editor = null;
  var $howpublished = null;
  var $institution = null;
  var $journal = null;
  var $bibkey = null;
  var $bibmonth = 0;
  var $note = null;
  var $bibnumber = null;
  var $organization = null;
  var $pages = null;
  var $publisher = null;
  var $school = null;
  var $series = null;
  var $title = null;
  var $bibtype = null;
  var $volume = null;
  var $bibyear = null;
  /* Other data fields */
  var $abstract = null;
  var $keywords = null;
  var $tag1 = null;
  var $tag2 = null;
  var $tag3 = null;
  var $tags = null;
  var $url = null;
 
  function __construct(&$db) {
    parent::__construct( '#__publications', 'id', $db );
  }
}

?>
