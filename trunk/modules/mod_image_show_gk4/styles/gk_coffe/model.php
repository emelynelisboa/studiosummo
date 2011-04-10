<?php

/**
* GK Image Show - model file
* @package Joomla!
* @Copyright (C) 2009-2011 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ version $Revision: GK4 1.0 $
**/

// no direct access
defined('_JEXEC') or die;

// import com_content route helper
require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');

class GKIS_gk_coffe_Model {
	// configuration array
	private $config;
	// constructor
	function __construct($config) {
		// init the style config
		$this->config = $config;
	}
	// getData function
	function getData($ids) {
		// prepare an array
		$results = array();
		// prepare an query part
		$query_ids = implode(',', $ids);
		// generate the query
		$database = JFactory::getDBO();
		// SQL query for slides
		$query = '
		SELECT 
			`c`.`id` AS `id`,
			`c`.`catid` AS `cid`,
			`c`.`title` AS `title`
		FROM 
			#__content AS `c` 
		WHERE 
			`c`.`id` IN ('.$query_ids.')
		;';
		// running query
		$database->setQuery($query);
		// if results exists
		if( $datas = $database->loadObjectList() ) {
			// parsing data
			foreach($datas as $item) {
				// array with prepared image
			 	$results[$item->id] = array(
					'id' => $item->id,
					'cid' => $item->cid,
					'title' => stripslashes($item->title),
					'link' => JRoute::_(ContentHelperRoute::getArticleRoute($item->id, $item->cid))
				);
			}
		}
		// return the results
		return $results;
	}
}

/* eof */