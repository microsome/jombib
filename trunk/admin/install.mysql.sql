
/*
 * These (24 items) are standard bibtex field names except those (4) which conflict with SQL keywords. 
 */
DROP TABLE IF EXISTS `#__bib`;
CREATE TABLE IF NOT EXISTS `#__bib` (
   `id` int(11) NOT NULL auto_increment,
   `entrytype` enum('article', 'book', 'booklet', 'conference', 'inbook', 'incollection', 'inproceedings', 'manual', 'mastersthesis', 'misc', 'phdthesis', 'proceedings', 'techreport', 'unpublished'), -- Type of the entry, as defined in bibtex
   `address` varchar(255),	-- Publisher's address (usually just the city, but can be the full address for lesser-known publishers)
   `annote` varchar(255),	-- An annotation for annotated bibliography styles (not typical)
   `author` varchar(255),	-- The name(s) of the author(s) (in the case of more than one author, separated by and)
   `booktitle` varchar(255),	-- The title of the book, if only part of it is being cited
   `chapter` varchar(255), 	-- The chapter number
   `crossref` varchar(255),	-- The key of the cross-referenced entry
   `edition` varchar(255),	-- The edition of a book, long form (such as "first" or "second")
   `editor` varchar(255),	-- The name(s) of the editor(s)
   `howpublished` varchar(255),	-- How it was published, if the publishing method is nonstandard
   `institution` varchar(255),	-- The institution that was involved in the publishing, but not necessarily the publisher
   `journal` varchar(255),	-- The journal or magazine the work was published in
   `bibkey` varchar(255),	-- A hidden field used for specifying or overriding the alphabetical order of entries (when the "author" and "editor" fields are missing). Note that this is very different from the key (mentioned just after this list) that is used to cite or cross-reference the entry.
   `bibmonth` varchar(255),	-- The month of publication (or, if unpublished, the month of creation)
   `note` varchar(255),		-- Miscellaneous extra information
   `bibnumber` varchar(255),	-- The "number" of a journal, magazine, or tech-report, if applicable. (Most publications have a "volume", but no "number" field.)
   `organization` varchar(255),	-- The conference sponsor
   `pages` varchar(255),	-- Page numbers, separated either by commas or double-hyphens. For books, the total number of pages.
   `publisher` varchar(255),	-- The publisher's name
   `school` varchar(255),	-- The school where the thesis was written
   `series` varchar(255),	-- The series of books the book was published in (e.g. "The Hardy Boys")
   `title` varchar(255),	-- The title of the work
   `bibtype` varchar(255),	-- The type of tech-report, for example, "Research Note"
   `volume` varchar(255),	-- The volume of a journal or multi-volume book
   `bibyear` year(4),		-- The year of publication (or, if unpublished, the year of creation)
   PRIMARY KEY (`id`)
) TYPE=MyISAM CHARACTER SET `utf8`;