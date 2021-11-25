<?
namespace Anon;


$adverts = knob
([
   'cols' =>
   [
      'advertID' => 'TEXT NOT NULL',
      'gtAdHref' => 'TEXT NOT NULL',
      'modified' => 'INT NOT NULL',
      'category' => 'TEXT NOT NULL',
      'flagTags' => 'TEXT NOT NULL', // ** see below
      'smallPic' => 'TEXT NOT NULL',
      'heroShot' => 'TEXT NOT NULL',
      'location' => 'TEXT NOT NULL',
      'thePrice' => 'INT NOT NULL',
      'theTitle' => 'TEXT NOT NULL',
      'theWords' => 'TEXT NOT NULL',
   ],
]);


/**
 * flagTags :: these are any of the following:
 * A - available
 * O - occupied
 * D - deleted
**/

 