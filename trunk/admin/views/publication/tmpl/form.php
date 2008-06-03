<?php
function createFieldRow($fieldName, $field, $inputElem, $fieldLabel = "") {
  if(empty($fieldLabel)) {
    $fieldLabel = ucfirst($fieldName);
  }
?>
  <tr id="<?php echo $fieldName; ?>row">
    <td align="right" class="key" nowrap="nowrap">
      <label for="<?php echo $fieldName; ?>">
        <?php echo $fieldLabel; ?>:
      </label>
    </td>
    <td width="100%">
      <?php echo $inputElem; ?>
    </td>
    <!--
    <td>
      <input id="<?php echo $fieldName . 'enabled'; ?>" type="checkbox" 
          name="<?php echo $fieldName . 'enabled';  ?>" class="inputbox" 
          onclick="enableInputElement('<?php echo $fieldName; ?>')" />
    </td>
    -->
  </tr>
  <?php
}

function makeTextInput($fieldName, $field) {
  $textinput = '<input class="text_area" type="text" name="' . $fieldName . '" '
      . 'id="' . $fieldName . '" style="width: 100%" maxlength="250" '
      . 'value="'. $field. '"';
  return $textinput;
}

function makeTextarea($fieldName, $field) {
  $textarea = '<textarea class="text_area" rows="5" style="width: 100%" name="'
      . $fieldName . '" id="' . $fieldName . '">' . $field . '</textarea>';
  return $textarea;
}
?>

<form action="index.php" method="post"
    name="adminForm" id="adminForm">
<div class="col width-70">
  <fieldset class="adminform">
    <legend>Details</legend>
    <table class="admintable" id="entrytable" width="100%">
      <tr id="entrytyperow">
        <td align="right" class="key" nowrap>
          <label for="entrytype">Entry Type:</label>
        </td>
        <td>
          <?php echo $this->lists['entrytype']; ?>
        </td>                
      </tr>
      <?php createFieldRow('title',$this->row->title, makeTextInput('title', $this->row->title)); ?>
      <!-- alphabetic order bibtex fields  -->
      <?php createFieldRow('address',$this->row->address, makeTextInput('address', $this->row->address)); ?>      
      <?php createFieldRow('annote',$this->row->annote, makeTextInput('annote', $this->row->annote)); ?>
      <?php createFieldRow('author',$this->row->author, makeTextInput('author', $this->row->author), 'Author(s)'); ?>
      <?php createFieldRow('booktitle',$this->row->booktitle, makeTextInput('booktitle', $this->row->booktitle)); ?>
      <?php createFieldRow('chapter',$this->row->chapter, makeTextInput('chapter', $this->row->chapter)); ?>
      <?php createFieldRow('crossref',$this->row->crossref, makeTextInput('crossref', $this->row->crossref)); ?>
      <?php createFieldRow('edition',$this->row->edition, makeTextInput('edition', $this->row->edition)); ?>
      <?php createFieldRow('editor',$this->row->editor, makeTextInput('editor', $this->row->editor), 'Editor(s)'); ?>
      <?php createFieldRow('howpublished',$this->row->howpublished, makeTextInput('howpublished', $this->row->howpublished)); ?>
      <?php createFieldRow('institution',$this->row->institution, makeTextInput('institution', $this->row->institution)); ?>
      <?php createFieldRow('journal',$this->row->journal, makeTextInput('journal', $this->row->journal)); ?>
      <?php createFieldRow('bibkey',$this->row->bibkey, makeTextInput('bibkey', $this->row->bibkey), 'Key'); ?>
      <?php createFieldRow('bibmonth',$this->row->bibmonth, $this->lists['bibmonth'], 'Month'); ?>
      <?php createFieldRow('note',$this->row->note, makeTextInput('note', $this->row->note)); ?>
      <?php createFieldRow('bibnumber',$this->row->bibnumber, makeTextInput('bibnumber', $this->row->bibnumber), 'Number'); ?>
      <?php createFieldRow('organization',$this->row->organization, makeTextInput('organization', $this->row->organization)); ?>
      <?php createFieldRow('pages',$this->row->pages, makeTextInput('pages', $this->row->pages)); ?>
      <?php createFieldRow('publisher',$this->row->publisher, makeTextInput('publisher', $this->row->publisher)); ?>
      <?php createFieldRow('school',$this->row->school, makeTextInput('school', $this->row->school)); ?>
      <?php createFieldRow('series',$this->row->series, makeTextInput('series', $this->row->series)); ?>
      <?php createFieldRow('bibtype',$this->row->bibtype, makeTextInput('bibtype', $this->row->bibtype), 'Type'); ?>      
      <?php createFieldRow('volume',$this->row->volume, makeTextInput('volume', $this->row->volume)); ?>
      <?php createFieldRow('bibyear',$this->row->bibyear, $this->lists['bibyear'], 'Year'); ?>
      <?php createFieldRow('abstract',$this->row->abstract, makeTextarea('abstract', $this->row->abstract)); ?>
      <!-- other data fields  -->
      <?php createFieldRow('keywords',$this->row->keywords, makeTextInput('keywords', $this->row->keywords)); ?>
      <?php createFieldRow('tag1',$this->row->tag1, makeTextInput('tag1', $this->row->tag1), 'Tag 1'); ?>
      <?php createFieldRow('tag2',$this->row->tag2, makeTextInput('tag2', $this->row->tag2), 'Tag 2'); ?>
      <?php createFieldRow('tag3',$this->row->tag3, makeTextInput('tag3', $this->row->tag3), 'Tag 3'); ?>
      <?php createFieldRow('tags',$this->row->tags, makeTextInput('tags', $this->row->tags), 'Other Tags'); ?>
      <?php createFieldRow('url',$this->row->url, makeTextInput('url', $this->row->url), 'URL'); ?>
    </table>
  </fieldset>
</div>

<div class="col width-30">
  <fieldset class="adminform">
    <legend>Display Options</legend>
    <table id="displayoptiontable" class="admintable">
      <tr>
        <td align="right" class="key">
          <label for="">Show Non-BibTeX Fields</label>
        </td>
        <td>
          <input id="shownonbibcheckobx" type="checkbox"
              name="shownonbibcheckbox" class="inputbox"
              onclick="changeNonBibtexFieldsDisplay()" />
        </td>
      </tr>
      <tr>
        <td align="right" class="key">
          <label for="">Show All BibTeX Fields</label>
        </td>
        <td>
          <input id="showallbibcheckobx" type="checkbox"
              name="showallbibcheckbox" class="inputbox"
              onclick="changeAllBibtexFieldsDisplay()" />
        </td>
      </tr>
    </table>
  </fieldset>
</div>

<div class="col width-30">
  <fieldset class="adminform">
    <legend>System Fileds</legend>
    <table id="sysfieldtable" class="admintable">
      <?php createFieldRow('published',$this->row->published, $this->lists['published']); ?>
      <?php createFieldRow('id', null, $this->row->id, 'ID'); ?>
      <?php createFieldRow('submitted_by', null, $this->lists['submitted_by'], 'Submitted By'); ?>
      <?php createFieldRow('submitted_time', null, JHTML::_('date',$this->row->submitted_time, '%Y-%m-%d %H:%M:%S, %Z'), 'Submitted Time'); ?>
    </table>
  </fieldset>
</div>

  <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <?php
  if($this->row->id < 1) {
    //new
    ?>
    <input type="hidden" name="submitted_by" value="<?php echo $this->user->id;?>" />
    <?php
  }
  ?>
  <input type="hidden" name="task" value="" />
</form>

<script language="javascript" type="text/javascript">

var articleEntry = {
 required: ["author", "title", "journal", "bibyear"],
 optional: ["volume", "bibnumber", "pages", "bibmonth", "note", "bibkey"]
};

var bookEntry = {
 required: ["author", "editor", "title", "publisher", "bibyear"],
 optional: ["volume", "series", "address", "edition", "bibmonth", "note", "bibkey", "pages"]
};

var bookletEntry = {
 required: ["title"],
 optional: ["author", "howpublished", "address", "bibmonth", "bibyear", "note", "bibkey"]
};

var conferenceEntry = {
 required: ["author", "title", "booktitle", "bibyear"],
 optional: ["editor", "pages", "organization", "publisher", "address", "bibmonth", "note", "bibkey"]
};

var inbookEntry = {
 required: ["author", "editor", "title", "chapter", "pages", "publisher", "bibyear"],
 optional: ["volume", "series", "address", "edition", "bibmonth", "note", "bibkey"]
};

var incollectionEntry = {
 required: ["author", "title", "booktitle", "bibyear"],
 optional: ["editor", "pages", "organization", "publisher", "address", "bibmonth", "note", "bibkey"]
};

var inproceedingsEntry = conferenceEntry;

var manualEntry = {
 required: ["title"],
 optional: ["author", "organization", "address", "edition", "bibmonth", "bibyear", "note", "bibkey"]
};

var mastersthesisEntry = {
 required: ["author", "title", "school", "bibyear"],
 optional: ["address", "bibmonth", "note", "bibkey"]
};

var miscEntry = {
 required: [],
 optional: ["author", "title", "howpublished", "bibmonth", "bibyear", "note", "bibkey"]
};

var phdthesisEntry = mastersthesisEntry;

var proceedingsEntry = {
 required: ["title", "bibyear"],
 optional: ["editor", "publisher", "organization", "address", "bibmonth", "note", "bibkey"]
};

var techreportEntry = {
 required: ["author", "title", "institution", "bibyear"],
 optional: ["editor", "publisher", "organization", "address", "bibmonth", "note", "bibkey"]
};

var unpublishedEntry = {
 required: ["author", "title", "note"],
 optional: ["bibmonth", "bibyear", "bibkey"]
};

var nonBibtexFields = {
 required: [],
 optional: ["abstract", "keywords", "tag1", "tag2", "tag3", "tags", "url"]
};

document.body.onload = load();

function load() {
  var entrytypeSelect = document.getElementById('entrytype');
  entrytypeSelect.selectedIndex = 1;
  entrytypeChanged();
  changeNonBibtexFieldsDisplay();
}

function entrytypeChanged() {
  var entrytypeSelect = document.getElementById('entrytype');
  var selectedValue = entrytypeSelect.options[entrytypeSelect.selectedIndex].value;
  var visibleRowPrefixes;
  if(selectedValue != "") {
    var ruleEntry = this[selectedValue + "Entry"];
    visibleRowPrefixes = ruleEntry.required.concat(ruleEntry.optional);
  } else {
    // When the first item is selected.
    visibleRowPrefixes = [];
  }
  
  var entryTable = document.getElementById('entrytable');
  var lastbibindex = 24;
  for(var i = 0; i <= lastbibindex; i++) {
    var tbrow = entryTable.rows[i];
    if(tbrow.id != "entrytyperow") {
      tbrow.style.display = "none";
    }
  }

  changeRowsDisplay(visibleRowPrefixes, true);
}

function enableInputElement(elemName) {
  var checkbox = document.getElementById(elemName + "enabled");
  var inputElem = document.getElementById(elemName);
  if(checkbox.checked == true) {
    inputElem.disabled = false;
  } else {
    inputElem.disabled = true;
  }
}

function changeRowsDisplay(visibleRowPrefixes, show) {
  for(i = 0; i < visibleRowPrefixes.length; i++) {
    tbrow = document.getElementById(visibleRowPrefixes[i] + "row");
    if(show == true) {
      tbrow.style.display = "table-row";
    } else {
      tbrow.style.display = "none";
    }
  }
}

function changeNonBibtexFieldsDisplay() {
  var visibleRowPrefixes = nonBibtexFields.required.concat(nonBibtexFields.optional);
  var checkbox = document.getElementById("shownonbibcheckobx");
  if(checkbox.checked == true) {
    changeRowsDisplay(visibleRowPrefixes, true);
  } else {
    changeRowsDisplay(visibleRowPrefixes, false);
  }
}

function changeAllBibtexFieldsDisplay() {
  var entryTable = document.getElementById('entrytable');
  var checkbox = document.getElementById("showallbibcheckobx");
  if(checkbox.checked == true) {
    var lastbibindex = 24;
    // begin at 1 so that entrytype select is not included.
    for(var i = 1; i <= lastbibindex; i++) {
      var tbrow = entryTable.rows[i];
      tbrow.style.display = "table-row";
    }
  } else {
    entrytypeChanged();
  }
}

function submitbutton(pressbutton) {
  var form = document.adminForm;
  var submittedBy = <?php echo $this->user->id;  ?>;
  var pubId = <?php echo intval($this->row->id);  ?>;
  var submittedTime = new Date();
  if (pressbutton == 'cancel') {
    submitform( pressbutton );
    return;
  }

  if(pubId < 1) {
    //new
  } else {
  }
  submitform( pressbutton );
}

</script>
