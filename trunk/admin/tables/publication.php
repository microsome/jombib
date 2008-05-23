<?php
defined('_JEXEC') or die('Restricted access');

class TablePublication extends JTable {
  var $id = null;
  var $address = null;
  var $annote = null;
  var $author = null;
  var $booktitle = null;
  var $chapter = null;
  var $crossref = null;
  var $edition = null;
  var $editor = null;
  var $eprint = null;
  var $howpublished = null;
  var $institution = null;
  var $journal = null;
  var $bibkey = null;
  var $bibmonth = null;
  var $note = null;
  var $number = null;
  var $organization = null;
  var $pages = null;
  var $publisher = null;
  var $school = null;
  var $series = null;
  var $title = null;
  var $bibtype = null;
  var $url = null;
  var $volume = null;
  var $bibyear = null;

  function __construct(&$db) {
    parent::__construct( '#__bib', 'id', $db );
  }
}

?>
