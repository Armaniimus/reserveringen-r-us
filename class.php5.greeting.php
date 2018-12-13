<?php
/**
 * File contain the greeting class.
 *
 * @package 	Greeting
 * @version 	1.1
 * @copyright 	Copyright (C)2006 Todor Iliev. All rights reserved.
 * @license 	http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @filesource
 */

/**
 * 	LICENSE
 * 	This program is free software; you can redistribute it and/or
 * 	modify it under the terms of the GNU General Public License (GPL)
 * 	as published by the Free Software Foundation; either version 2
 * 	of the License, or (at your option) any later version.
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU General Public License for more details.
 *	To read the license please visit http://www.gnu.org/copyleft/gpl.html
 *	----------------------------------------------------------------------
 *	Original Author of file:
 *	Purpose of file:
 *	----------------------------------------------------------------------
 * 	Tested with IE 6,IE 7, Netscape 7, Opera 9, Firefox 2.0
 * 	This is free software. Use at your own risk.
 */

/**
 * Greeting card class for php 5.x
 *
 *
 * @package 	Greeting
 * @author 		Todor Iliev (TheLordOfWeb) <todor.iliev@viplord.com> <http://viplord.com/>
 * @version 	1.1
 * @copyright 	Copyright (C)2006 Todor Iliev . All rights reserved.
 * @license 	http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @example		example_1.php
 * @example		example_2.php
 * @example     example_3.php
 */
class Greeting  {
	/**
	 * Additional text to card
	 *
	 * @access public
	 * @var string
	 */
	public $mAddTxt 		=	'';

	/**
	 * Card background
	 *
	 * @access public
	 * @var string
	 */
	public $mBg				=	'#FFFFFF';

	/**
	 * Full URL path to card image
	 *
	 * @access public
	 * @var string
	 */
	public $mFileName		=	'';

	/**
	 * Sender e-mail address
	 *
	 * @access public
	 * @var string
	 */
	public $mSendFromMail	=	'';

	/**
	 * Sender name
	 *
	 * @access public
	 * @var string
	 */
	public $mSendFromName	=	'';

	/**
	 * e-mail address to send
	 *
	 * @access public
	 * @var string
	 */
	public $mSendToMail		=	'';

	/**
	 * e-mail mSubject
	 *
	 * @access public
	 * @var string
	 */
	public $mSubject		=	'Greeting card';

	/**
	 * Greeting text
	 *
	 * @access public
	 * @var string
	 */
	public $mText			=	'';

	/**
	 * Text color
	 *
	 * @access public
	 * @var string
	 */
	public $mTextColor		=	'#000000';

	/**
	 * Font name on text
	 *
	 * @access public
	 * @var string
	 */
	public $mTextFont		=	'Verdana, Arial, Helvetica, sans-serif';

	/**
	 * card position
	 *
	 * @access public
	 * @var string
	 */
	public $mTextPos		=	'center';

	/**
	 * text size
	 *
	 * @access public
	 * @var string
	 */
	public $mTextSize		=	'medium';

	/**
	 * text style
	 *
	 * @access public
	 * @var string
	 */
	public $mTextStyle		=	'';

	/**
	 * type on e-mail( html or plaint)
	 *
	 * @access public
	 * @var string
	 */
	public $mType			=	'html';

	/**
	 * Array with errors
	 *
	 * @access public
	 * @var	array(int=>string)	$error
	 */
	public $mError 			= array();

	/**
	 * Greeting card constructor
	 *
	 * @param string $mFileName		Greeting card(file) path and name
	 * @return void
	 */
	function __construct($fileName) {
		$this->mFileName 		= (!empty($fileName)) ? strval(htmlentities($fileName)) : $this->mError[] = 'Empty file name';
	}

	/**
	 * Crete greeting card header
	 *
	 * @access protected
	 * @return string 		header on html card content
	 */
	protected function HeaderCard() {
		$header = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title>Greeting by ' . $this->mSendFromName  . '</title>
				<style type="text/css">
				<!--
				body { background-color:' . $this->mBg . ';}
				#cb img {
					margin-top: 0px;
					margin-right: 5px;
					margin-bottom: 5px;
					margin-left: 0px;
					padding-top: 0px;
					padding-right: 5px;
					padding-bottom: 5px;
					padding-left: 0px;
					background-color: #808080;}

				p#text {
				color		:	' .	$this->mTextColor . ';
				font-family: \'' . $this->mTextFont . '\';
				font-size:	' . $this->mTextSize . ';';
		if(!empty($this->mTextStyle)) {
			switch($this->mTextStyle) {
				case 'bold':
					$header .= 	'font-weight: bold;';
					break;
				case 'italic':
					$header .= 	'font-style: italic;';
					break;
				case 'underline':
					$header .= 	'text-decoration: underline;';
					break;
			}
		}
		$header .= 	'}
					-->
				</style>
			</head>';


		return $header;
	}

	/**
	 * Greeting card footer
	 *
	 * @access protected
	 * @return string 		end of HTML content
	 */
	protected function FooterCard() {
		$footer = ("</body>
				</html>");

		return $footer;
	}

	/**
	 * Create card with image as HTML
	 *
	 * @access protected
	 * @return string 		body without '</body><html>' tags
	 */
	protected function CreateHtml() {

		$body = '<body>
					<div id="cb">
						<div align="center">
	 				 		<p><img src="' . $this->mFileName . '" align="' . $this->mTextPos . '"/>  </p>
	  						<p id="text">' . nl2br($this->mText) . '</p>
						</div>
					</div>';

		$body .= $this->mAddTxt;

		return $body;
	}

	/**
	 * Create card with Flash as HTML
	 *
	 * @access protected
	 * @return string 		body without '</body><html>' tags
	 */
	protected function CreateFlash() {

		$body = '<body>
					<div id="cb">
						<div align="center">
						<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="400" height="300" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0">
                            <param name="movie" value="' . $this->mFileName . '" />
                            <param name="quality" value="high" />
                            <param name="play" value="true" />
                            <param name="loop" value="true" />
                            <param name="scale" value="noborder">
                            <embed src="' . $this->mFileName . '" quality="high" loop="true" width="400" height="300" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
                            </object>
	  						<p id="text">' . nl2br($this->mText) . '</p>
						</div>
					</div>';

		$body .= $this->mAddTxt;

		return $body;
	}

	/**
	 * Create body as TEXT
	 *
	 * @access protected
	 * @return string 		Body
	 */
	protected function CreateText() {

		$body = $this->mAddTxt;

		return $body;
	}

	/**
	 * get greeting card
	 *
	 * @access public
	 * @return string 		full greeting card content
	 */
	public function GetCard() {
		$card  = $this->HeaderCard();

		if(strcmp($this->mType,"flash") == 0) {
		    $card .= $this->CreateFlash();
		} else {
		  $card .= $this->CreateHtml();
		}

		$card .= $this->FooterCard();

		return $card;
	}

	/**
	 * Show errors
	 *
	 * @access public
	 * @return void
	 */
 	public function ShowErrors() {
 		for($i = 0;$i < count($this->mError);$i++) {
 			echo ($this->mError[$i]);
 		}
 	}

	/**
	 * Send greeting card
	 *
	 * @access public
	 * @return boold		true on success or false on fail
	 */
	public function SendCard() {

		$charset = "utf-8";

		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "From: " . $this->mSendFromMail . "\r\n";
		$headers .= "Reply-To: " . $this->mSendFromMail . "\r\n";
		$headers .= "X-Sender: <" . $this->mSendFromMail . ">\r\n";
		$headers .= "X-Mailer: PHP\r\n"; 									// mailer
		$headers .= "X-Priority: 3\r\n"; 									// 1-Urgent message! 2-very 3-normal
		$headers .= "Return-Path: <" . $this->mSendFromMail . ">\r\n";  	// Return path for errors

		switch($this->mType) {

		    // Send as html
			case 'html':
				$card = $this->HeaderCard();
				$card .= $this->CreateHtml();
				$card .= $this->FooterCard();
				$headers .= "Content-Type: text/html; charset=$charset\r\n";
				$headers .= "Content-Transfer-Encoding: 8bit\r\n";
				break;

		    // Send as flash
			case 'flash':
				$card = $this->CreateText() ;
				$headers .= "Content-type: text/plain; charset=$charset\r\n";
				$headers .= "Content-Transfer-Encoding: 8bit\r\n";
				break;

			// Send as text
			case 'text':
				$card = $this->CreateText() ;
				$headers .= "Content-type: text/plain; charset=$charset\r\n";
				$headers .= "Content-Transfer-Encoding: 8bit\r\n";
				break;
		}

		if(false === @mail($this->mSendToMail, $this->mSubject, $card, $headers)) {
		    $this->mError[] = "Can't send greeting card";
			return false;
		} else {
		    return true;
		}

	}

}


?>
