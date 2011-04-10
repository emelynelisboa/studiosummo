<!--
/**
* Module Super Scroll RSS for Joomla 1.5 / 1.6 by Federico Luzi
* http://www.pc-sapiens.net/
* pcsapiens@gmail.com
*--------------------------------------------------------
* Super Scroll RSS is licensed GPL
* Super Scroll RSS is inspired by code found on the Internet.
* Special thanks for Antonio Lupetti (http://woork.blogspot.com) and Capitol Media (http://www.capitolmedia.com)
**/
-->

<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
// echo JText::_( 'Ciao Mondo! vita dura!' );

//Recupero parametri dal file xml
$altezza           = $params->get( 'altezza' );
$larghezza         = $params->get( 'larghezza' );
$feed 	           = $params->get( 'feed' );
$mootools		   = $params->get( 'mootools' );


//Imposto parametri default se le variabili restano vuote
if( $altezza=='' ) {
    $altezza = '250';
}

if( $larghezza=='' ) {
    $larghezza = '170';
}

if( $feed=='' ) {
    $feed = 'http://www.pc-sapiens.net/feed';
}

if( $mootools =='' ) {
    $mootools = 'No';
}


// Lettura del Feed
$insideitem = false; 
$tag = ''; 
$title = ''; 
$description = ''; 
$link = ''; 

function startElement($parser, $name, $attrs) { 
 global $insideitem, $tag, $title, $description, $link; 
 if ($insideitem) { 
  $tag = $name; 
 } elseif ($name == 'ITEM') { 
  $insideitem = true; 
 } 
} 

// FUNZIONE CHE DIVIDE LA STRINGA A TOT CARATTERI SENZA TAGLIARE LE PAROLE // E AGGIUNGENDO IN FONDO (SE CONTINUA) ... // 
function troncaTesto($testo, $caratteri) { if (strlen($testo) <= $caratteri) return $testo; $nuovo = wordwrap($testo, $caratteri, "|"); $nuovotesto=explode("|",$nuovo); return $nuovotesto[0]."..."; } 

function endElement($parser, $name) { 

 global $insideitem, $tag, $title, $description, $link; 
 if ($name == 'ITEM') { 
 	printf('<li><strong><a href=\'%s\' target="_blank">%s</a></strong><br>',trim($link),trim($title));
             
  // Richiamo la funzione tronca testo 
  $description = troncaTesto($description, 120); 
  
  printf('%s</li>'."\n",trim($description));
  $title = ''; 
  $description = ''; 
  $link = ''; 
  $insideitem = false; 
 } 
} 

function characterData($parser, $data) { 
 global $insideitem, $tag, $title, $description, $link; 
 if ($insideitem) { 
 switch ($tag) { 
  case 'TITLE': 
  $title .= $data; 
  break; 
  case 'DESCRIPTION': 
  $description .= $data; 
  break; 
  case 'LINK': 
  $link .= $data; 
  break; 
 } 
 } 
} 
		$module_base = JURI::base() . "modules/mod_super_scroll_rss/";
?>

<style>
/* Ticker Vertical */

#FeedVertical {
	display: block;
	overflow: hidden;
	position: relative;
  	width:  <?php echo $larghezza; ?>px;
  	height: <?php echo $altezza; ?>px;
}

#TickerVertical {
	display: block;
	list-style: none;
	margin: 0px;
	margin-bottom: 15px;
	padding: 0px;
	width:  <?php echo $larghezza; ?>px;
	height: <?php echo $altezza; ?>px;
}

#TickerVertical li {
	width:  <?php echo $larghezza; ?>px;
	display: block;
	text-align: left;
	margin: 0px;
	padding: 0px;
	padding-top:5px;
	float: left;
}
</style>

<?php
	
	// Questa if mostra il mootools personalizzato quando l'amministratore lo ritiene opportuno
	if( $mootools =='Si' ) {
 		?><script type="text/javascript" src="<?php echo $module_base; ?>js/mootools.svn.js"></script><?php
	}

?>


        <div id="FeedVertical">
          <ul id="TickerVertical">
            <!--YOUR SCROLL CONTENT HERE-->

<?php

$xml_parser = xml_parser_create(); 
xml_set_element_handler($xml_parser, 'startElement', 'endElement'); 
xml_set_character_data_handler($xml_parser, "characterData"); 
$fp = fopen($feed,'r') 
 or die('Error reading RSS data.'); 
while ($data = fread($fp, 4096)) { 
 xml_parse($xml_parser, $data, feof($fp)) 
  or die(sprintf('XML error: %s at line %d', 
 xml_error_string(xml_get_error_code($xml_parser)), 
 xml_get_current_line_number($xml_parser))); 
} 
fclose($fp); 
xml_parser_free($xml_parser); 
?>

	          <!--YOUR SCROLL CONTENT HERE-->

         </ul>
        </div>
          <script type="text/javascript" src="<?php echo $module_base; ?>js/newsticker.js"></script>