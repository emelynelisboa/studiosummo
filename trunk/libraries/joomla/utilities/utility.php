<?php
/**
 * @version		$Id: utility.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Framework
 * @subpackage	Utilities
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('JPATH_BASE') or die;

/**
 * JUtility is a utility functions class
 *
 * @package		Joomla.Framework
 * @subpackage	Utilities
 * @since		1.5
 */
class JUtility
{
	/**
	 * Mail function (uses phpMailer)
	 *
	 * @param	string	$from		From email address
	 * @param	string	$fromname	From name
	 * @param	mixed	$recipient	Recipient email address(es)
	 * @param	string	$subject	Email subject
	 * @param	string	$body		Message body
	 * @param	boolean	$mode		false = plain text, true = HTML
	 * @param	mixed	$cc			CC email address(es)
	 * @param	mixed	$bcc		BCC email address(es)
	 * @param	mixed	$attachment	Attachment file name(s)
	 * @param	mixed	$replyto	Reply to email address(es)
	 * @param	mixed	$replytoname Reply to name(s)
	 * @return	boolean	True on success
	 *
	 * @since		1.5
	 * @deprecated  1.6
	 * @see			JMail::sendMail()
	 */
	public static function sendMail($from, $fromname, $recipient, $subject, $body, $mode=0, $cc=null, $bcc=null, $attachment=null, $replyto=null, $replytoname=null)
	{
		// Get a JMail instance
		$mail = JFactory::getMailer();

		return $mail->sendMail(
			$from, $fromname, $recipient, $subject, $body, $mode, $cc,
			$bcc, $attachment, $replyto, $replytoname
		);
	}

	/**
	 * Sends mail to administrator for approval of a user submission
	 *
	 * @param	string	$adminName	Name of administrator
	 * @param	string	$adminEmail	Email address of administrator
	 * @param	string	$email		[NOT USED TODO: Deprecate?]
	 * @param	string	$type		Type of item to approve
	 * @param	string	$title		Title of item to approve
	 * @param	string	$author		Author of item to approve
	 *
	 * @return	boolean True on success
	 *
	 * @deprecated  1.6
	 * @see			JMail::sendAdminMail()
	 */
	public static function sendAdminMail($adminName, $adminEmail, $email, $type, $title, $author, $url = null)
	{
		// Get a JMail instance
		$mail = JFactory::getMailer();

		return $mail->sendAdminMail(
			$adminName, $adminEmail, $email, $type, $title, $author, $url
		);
	}

	/**
	 * Provides a secure hash based on a seed
	 *
	 * @param	string	$seed	Seed string.
	 *
	 * @return	string
	 *
	 * @deprecated  1.6
	 * @see			JApplication:getHash()
	 */
	public static function getHash($seed)
	{
		$conf = JFactory::getConfig();

		return md5($conf->get('secret').$seed);
	}

	/**
	 * Method to determine a hash for anti-spoofing variable names
	 *
	 * @return	string	Hashed var name
	 *
	 * @since		1.5
	 * @deprecated  1.6
	 * @see			JApplication:getHash()
	 */
	public static function getToken($forceNew = false)
	{
		$session = JFactory::getSession();

		return $session->getFormToken($forceNew);
	}

	/**
	 * Method to extract key/value pairs out of a string with xml style attributes
	 *
	 * @param	string	$string	String containing xml style attributes
	 *
	 * @return	array	Key/Value pairs for the attributes
	 *
	 * @since		1.5
	 */
	public static function parseAttributes($string)
	{
		// Initialise variables.
		$attr		= array();
		$retarray	= array();

		// Lets grab all the key/value pairs using a regular expression
		preg_match_all('/([\w:-]+)[\s]?=[\s]?"([^"]*)"/i', $string, $attr);

		if (is_array($attr)) {
			$numPairs = count($attr[1]);
			for ($i = 0; $i < $numPairs; $i++)
			{
				$retarray[$attr[1][$i]] = $attr[2][$i];
			}
		}

		return $retarray;
	}

	/**
	 * Method to determine if the host OS is  Windows
	 *
	 * @return	boolean	True if Windows OS.
	 *
	 * @since		1.5
	 * @deprecated  1.6
	 * @see			JApplication::isWinOS()
	 */
	public static function isWinOS()
	{
		$application = JFactory::getApplication();

		return $application->isWinOS();
	}

	/**
	 * Method to dump the structure of a variable for debugging purposes
	 *
	 * @param	mixed	$var		A variable
	 * @param	boolean	$htmlSafe	True to ensure all characters are htmlsafe
	 *
	 * @return	string
	 *
	 * @since		1.5
	 * @deprecated  1.6
	 */
	public static function dump(&$var, $htmlSafe = true)
	{
		$result = var_export($var, true);

		return '<pre>'.($htmlSafe ? htmlspecialchars($result, ENT_COMPAT, 'UTF-8') : $result).'</pre>';
	}

	/**
	 * Prepend a reference to an element to the beginning of an array.
	 * Renumbers numeric keys, so $value is always inserted to $array[0]
	 *
	 * @param	$array array
	 * @param	$value mixed
	 *
	 * @return	int
	 *
	 * @since		1.5
	 * @deprecated  1.6
	 * @see			http://www.php.net/manual/en/function.array-unshift.php#40270
	 */
	function array_unshift_ref(&$array, &$value)
	{
		$return = array_unshift($array,'');
		$array[0] = &$value;

		return $return;
	}

	/**
	 * Return the byte value of a particular string
	 *
	 * @param	string	$val	String optionally with G, M or K suffix
	 *
	 * @return	int size in bytes
	 *
	 * @since		1.6
	 * @deprecated  1.6
	 * @see			JHtmlNumber::bytes
	 */
	function return_bytes($val)
	{
		$val = trim($val);
		$last = strtolower($val{strlen($val)-1});

		switch($last)
		{
			// The 'G' modifier is available since PHP 5.1.0
			case 'g':
				$val *= 1024;
			case 'm':
				$val *= 1024;
			case 'k':
				$val *= 1024;
		}

		return $val;
	}
}
