<?php
/*
Plugin Name: mmyReferences  
Plugin URI: http://www.mkswork.de/mmyreferences-wordpress-plugin/
Description: Schnell und einfach &uuml;ber Tags (z.B &lt;ref&gt;URL&lt;/ref&gt;) Quellenangaben in Betr&auml;ge einf&uuml;gen.
Version: 1.3
Author: Markus Kau&szlig;en
Author URI: http://www.mkswork.de

mmyReferences based on the Wordpress Plugin TicTagTo form Olaf A.Schmitz (http://blogshop.de/18012005,199)
mmyReferences is XHTML 1.1 valid; thanks to Norman Schwaneberg (http://www.normanschwaneberg.de)

add this to your css
----------
.mmyref {
  font-family: arial, verdana, tahoma, helvetica, sans-serif;
  font-size:10px;
  padding:0px 0px 0px 20px;
  margin:0px 0px 0px 230px;
  float:right;
}
----------
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

You can also view a copy of the HTML version of the GNU General Public
License at http://www.gnu.org/copyleft/gpl.html
*/

function mmyReferences($linkalllinks) {

   //customref
  $linkalllinks = preg_replace('/<cref>(.*?),(.*?),(.*?),(.*?)<\/cref>/i','<span class="mmyref">($1 <a href="$2" title="Link zu $2">$3</a> $4)</span>',$linkalllinks);
    	
  //link
  $linkalllinks = preg_replace('/<url>(.*?),(.*?),(.*?)<\/url>/i','<span class="mmyref">($1 <a href="$2" title="$1 $3">$3</a>)</span>',$linkalllinks);
	
	//(via)
	$linkalllinks = preg_replace('/<via>(.*?)<\/via>/i','<span class="mmyref">(<a href="$1" title="Quelle: $1">via</a>)</span>',$linkalllinks);
	
	//(Quelle)
	$linkalllinks = preg_replace('/<ref>(.*?)<\/ref>/i','<span class="mmyref">(<a href="$1" title="Quelle: $1">Quelle</a>)</span>',$linkalllinks);
	
	//(Quelle: www.url.de)
	$linkalllinks = preg_replace('/<refurl>(.*?)<\/refurl>/i','<span class="mmyref">(Quelle: <a href="$1" title="Quelle: $1">$1</a>)</span>',$linkalllinks);
	
	//(Siehe auch www.url.de)
	$linkalllinks = preg_replace('/<see>(.*?)<\/see>/i','<span class="mmyref">(Siehe auch <a href="$1" title="$1">$1</a>)</span>',$linkalllinks);

		//(Weitere Infos: www.url.de)
	$linkalllinks = preg_replace('/<more>(.*?)<\/more>/i','<span class="mmyref">(Weitere Infos <a href="$1" title="Weitere Infos unter $1">hier</a>)</span>',$linkalllinks);
	
	//(Weitere Infos: www.url.de)
	$linkalllinks = preg_replace('/<moreurl>(.*?)<\/moreurl>/i','<span class="mmyref">Weitere Infos: <a href="$1" title="Weitere Infos unter $1">$1</a></span>',$linkalllinks);
	
  return $linkalllinks;
}
add_filter('the_content', 'mmyReferences');
add_filter('comment_linkalllinks', 'mmyReferences');

?>
