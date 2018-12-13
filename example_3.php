<?php
/**
 * File contain example with Flash as html
 *
 * @package 	Greeting
 * @version 	1.1
 * @copyright 	Copyright (C)2006 Todor Iliev <todor.iliev@viplord.com> . All rights reserved.
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

$safe_op	=	(!empty($_REQUEST['op'])) ? $_REQUEST['op'] : '' ;

if(!empty($safe_op)) {
	$color 		= 	array('red','blue','green','white','gray','purple','black','yellow');
	$font		=	array('Arial','Balthazar','Chicago','Garamond','Georgia','Times New Roman','Victorian LET','Rage Italic LET');
	$size		=	array('xx-small','x-small','small','medium','large','x-large','xx-large');
	$style		=	array('bold','italic','underline');
	$position	=	array('left','center','right');
	$gc			=	array('1.png','2.png','3.png','4.swf');

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Greeting cards</title>
<link href="css/mainstyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php if(strcmp($safe_op,'send') == 0) : ?>
<?php
  	require('class.php5.greeting.php');
//	require('class.php5.greeting.php');

  	/**
  	 * Greeting cards url path
  	 * @var string
  	 */
  	$gc_url_path	=	'images/';

  	/**
  	 * Initialize variables
  	 */
  	settype($_POST['color'],'integer');
  	settype($_POST['text_color'],'integer');
  	settype($_POST['font'],'integer');
  	settype($_POST['size'],'string');
  	settype($_POST['style'],'integer');
  	settype($_POST['position'],'integer');
  	settype($_POST['text'],'string');
  	settype($_POST['op'],'string');
  	settype($_POST['gc'],'integer');
  	settype($_POST['from_name'],'string');
  	settype($_POST['from_mail'],'string');
  	settype($_POST['to_mail'],'string');

  	/**
  	 * Random file name
  	 * @var string
  	 */
  	$random_file_name = md5(time());

  	/**
  	 * Add text in creeting card
  	 * @var string
  	 */
  	$add_txt = 'You have greeting on this address [URL path]/'  . 's_greeting/' . $random_file_name . '.html';

  	/**
  	 * Mail subject
  	 * @var string
  	 */
  	$subject = 'Greeting card from ' . $_POST['from_name'];

  	/**
  	 * Create greeting object
  	 * @var object
  	 */
  	$greeting = new Greeting($gc_url_path . $gc[$_POST['gc']]);

  	/**
  	 * Initialize greeting object attributes
  	 */

  	/**
  	 * Background color
  	 * @var string
  	 */
  	$greeting->mBg				=	(!empty($_POST['color'])) ? $color[$_POST['color']] : $color[3];

  	/**
  	 * Text color
  	 * @var string
  	 */
  	$greeting->mTextColor 		= 	(!empty($_POST['text_color'])) ? $color[$_POST['text_color']] : $color[6];

  	/**
  	 * Text font
  	 * @var string
  	 */
  	$greeting->mTextFont		=	(!empty($_POST['font'])) ? $font[$_POST['font']] : $font[0];

  	/**
  	 * Text size
  	 * @var mixed
  	 */
  	$greeting->mTextSize		=	(!empty($_POST['size'])) ? $size[$_POST['size']] : $size[0];

  	/**
  	 * Text style
  	 * @var string
  	 */
  	$greeting->mTextStyle		=	(!empty($_POST['style'])) ? $style[$_POST['style']] : $style[0];

  	/**
  	 * Text position
  	 * @var string
  	 */
  	$greeting->mTextPos			=	(!empty($_POST['position'])) ? $position[$_POST['position']] : $position[0];

  	/**
  	 * Greeting text
  	 * @var mixed
  	 */
  	$greeting->mText			=	htmlspecialchars($_POST['text']);

  	/**
  	 * Sender name
  	 * @var string
  	 */
  	$greeting->mSendFromName	=	$_POST['from_name'];

  	/**
  	 * Sender mail address
  	 * @var string
  	 */
  	$greeting->mSendFromMail	=	$_POST['from_mail'];

  	/**
  	 * Addressee
  	 * @var string
  	 */
  	$greeting->mSendToMail		=	$_POST['to_mail'];

  	/**
  	 * Mail subject
  	 * @var mixed
  	 */
  	$greeting->mSubject			=	$subject;

  	/**
  	 * Type on greeting card (html or text)
  	 * @var string
  	 */
  	$greeting->mType			=	'flash';

  	// Create greeting file
 	if (!$handle = fopen('s_greeting/' . $random_file_name . '.html',"a")) {
  		echo "Cannot open file ('s_greeting/' . $random_file_name . '.html')";
    	exit;
   	}

   	if (fwrite($handle, $greeting->GetCard()) === FALSE) {
		echo "Cannot write to file ('s_greeting/' . $random_file_name . '.html')";
    	exit;
	}
   	fclose($handle);

   	// Send mail to recipient
   	/**
  	 * Add text in greeting card
  	 * @var mixed
  	 */
  	$greeting->mAddTxt			=	$add_txt;

  	if(empty($greeting->mError)) {

  		if($greeting->SendCard() === true) {
			echo 'Your greeting card sended successful.';
			} else {
				$greeting->ShowErrors();
			}//	if($greeting->SendCard() === true) {

  		} else {
			$greeting->ShowErrors();
		}//	if(empty($greeting->mError)) {


?>

<?php elseif(strcmp($safe_op,'options') == 0) : ?>
<form id="gc_form" name="gc_form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="4"><h3>Background color </h3></td>
    </tr>
    <tr>
      <td id="red"><input name="color" type="radio" value="0" accesskey="r" tabindex="1" id="rb1" />
      <label for="rb1">Red</label></td>
      <td id="blue"><input name="color" type="radio" value="1" accesskey="u" tabindex="2" id="rb2" />
      <label for="rb2">Blue</label></td>
      <td id="green"><input name="color" type="radio" value="2" accesskey="g" tabindex="3" id="rb3" />
      <label for="rb3">Green</label></td>
      <td id="white"><input name="color" type="radio" value="3" accesskey="w" tabindex="4" id="rb4" />
      <label for="rb4">White</label></td>
    </tr>
    <tr>
      <td id="gray"><input name="color" type="radio" value="4" accesskey="y" tabindex="5" id="rb5" />
      <label for="rb5">Gray</label></td>
      <td id="purple"><input name="color" type="radio" value="5" accesskey="p" tabindex="6" id="rb6"/>
      <label for="rb6">Purple</label></td>
      <td id="black"><input name="color" type="radio" value="6" accesskey="b" tabindex="7" id="rb7" />
      <label for="rb7">Black</label></td>
      <td id="yellow"><input name="color" type="radio" value="7" accesskey="y" tabindex="8" id="rb8" />
      <label for="rb8">Yellow</label></td>
    </tr>
    <tr>
      <td colspan="4"><h3>Text color </h3></td>
    </tr>
    <tr>
      <td id="red"><input name="text_color" type="radio" value="0" accesskey="r" tabindex="1" id="rb9" />
          <label for="rb9">Red</label></td>
      <td id="blue"><input name="text_color" type="radio" value="1" accesskey="u" tabindex="2" id="rb10" />
          <label for="rb10">Blue</label></td>
      <td id="green"><input name="text_color" type="radio" value="2" accesskey="g" tabindex="3" id="rb11" />
          <label for="rb11">Green</label></td>
      <td id="white"><input name="text_color" type="radio" value="3" accesskey="w" tabindex="4" id="rb12" />
          <label for="rb12">White</label></td>
    </tr>
    <tr>
      <td id="gray"><input name="text_color" type="radio" value="4" accesskey="y" tabindex="5" id="rb13" />
          <label for="rb13">Gray</label></td>
      <td id="purple"><input name="text_color" type="radio" value="5" accesskey="p" tabindex="6" id="rb14"/>
          <label for="rb14">Purple</label></td>
      <td id="black"><input name="text_color" type="radio" value="6" accesskey="b" tabindex="7" id="rb15" />
          <label for="rb15">Black</label></td>
      <td id="yellow"><input name="text_color" type="radio" value="7" accesskey="y" tabindex="8" id="rb16" />
          <label for="rb16">Yellow</label></td>
    </tr>

    <tr>
      <td colspan="4"><h3>Text font </h3></td>
    </tr>
    <tr>
      <td id="f1"><input name="font" type="radio" value="0" accesskey="a" tabindex="9" id="rb17" />
      <label for="rb17">Arial</label></td>
      <td id="f2"><input name="font" type="radio" value="1" accesskey="z" tabindex="10" id="rb18" />
      <label for="rb18">Balthazar</label></td>
      <td id="f3"><input name="font" type="radio" value="2" accesskey="c" tabindex="11" id="rb19" />
      <label for="rb19">Chicago</label></td>
      <td id="f4"><input name="font" type="radio" value="3" accesskey="m" tabindex="12" id="rb20" />
      <label for="rb20">Garamond</label></td>
    </tr>
    <tr>
      <td id="f5"><input name="font" type="radio" value="4" accesskey="i" tabindex="13" id="rb21" />
      <label for="rb21">Georgia</label></td>
      <td id="f6"><input name="font" type="radio" value="5" accesskey="t" tabindex="14" id="rb22" />
      <label for="rb22">Times New Roman</label></td>
      <td id="f7"><input name="font" type="radio" value="6" accesskey="v" tabindex="15" id="rb23" />
      <label for="rb23">Victorian LET</label></td>
      <td id="f8"><input name="font" type="radio" value="7" accesskey="e" tabindex="16" id="rb24" />
      <label for="rb24">Rage Italic LET</label></td>
    </tr>
    <tr>
      <td colspan="4"><h3>Text size </h3></td>
    </tr>
    <tr>
      <td id="s1"><input name="size" type="radio" value="0" accesskey="1" tabindex="17" id="rb25" />
      <label for="rb25">xx-small</label></td>
      <td id="s2"><input name="size" type="radio" value="1" accesskey="2" tabindex="18" id="rb26" />
      <label for="rb26">x-small</label></td>
      <td id="s3"><input name="size" type="radio" value="2" accesskey="3" tabindex="19" id="rb27" />
      <label for="rb27">small</label></td>
      <td id="s4"><input name="size" type="radio" value="3" accesskey="4" tabindex="20" id="rb28" />
      <label for="rb28">medium</label></td>
    </tr>
    <tr>
      <td id="s5"><input name="size" type="radio" value="4" accesskey="5" tabindex="21" id="rb29" />
      <label for="rb29">large</label></td>
      <td id="s6"><input name="size" type="radio" value="5" accesskey="6" tabindex="22" id="rb30" />
      <label for="rb30">x-large</label></td>
      <td id="s7"><input name="size" type="radio" value="6" accesskey="7" tabindex="23" id="rb31" />
      <label for="rb31">xx-large</label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><h3>Text style </h3></td>
    </tr>
    <tr>
      <td id="st1"><input name="style" type="radio" value="0" accesskey="d" tabindex="24" id="rb32" />
      <label for="rb32">Bold</label></td>
      <td id="st2"><input name="style" type="radio" value="1" accesskey="t" tabindex="25" id="rb33" />
      <label for="rb33">italic</label></td>
      <td id="st3"><input name="style" type="radio" value="2" accesskey="n" tabindex="26" id="rb34" />
      <label for="rb34">underline</label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><h3>Text position </h3></td>
    </tr>
    <tr>
      <td id="p1"><input name="position" type="radio" value="2" accesskey="f" tabindex="26" id="rb35" />
      <label for="rb35">left</label></td>
      <td id="p2">&nbsp;</td>
      <td><input name="position" type="radio" value="1" accesskey="c" tabindex="27" id="rb36" />
          <label for="rb36">center</label></td>
      <td><input name="position" type="radio" value="0" accesskey="h" tabindex="28" id="rb37" />
          <label for="rb37">right</label></td>
    </tr>
    <tr>
      <td colspan="4"><h3>Text</h3></td>
    </tr>
    <tr>
      <td colspan="4" class="p"><label for="text" class="hide">Text</label>
      <textarea name="text" cols="64" rows="10" id="text" accesskey="x" tabindex="29"></textarea>
      <input name="op" type="hidden" id="op" value="send" />
      <input name="gc" type="hidden" id="gc" value="<?php echo $_GET['gc']; ?>" /></td>
    </tr>
    <tr>
      <td colspan="4" class="p"><label for="from"></label>
        <label for="from_name">Your name</label>
      <input type="text" name="from_name" id="from_name" />
      <label for="label">&nbsp;</label>
      <label for="from_mail">Your mail</label>
      <input type="text" name="from_mail" id="from_mail" /></td>
    </tr>
    <tr>
      <td colspan="4" class="p"><label for="to_mail">To mail</label>
      <input type="text" name="to_mail" id="to_mail" /></td>
    </tr>
    <tr>
      <td colspan="4" class="p"><label for="Submit" class="hide">Send greeting card</label>
      <input type="submit" name="Submit" value="Send greeting card" accesskey="s" tabindex="30" id="Submit" /></td>
    </tr>
  </table>
</form>

<?php else: ?>
<p align="center"><a href="<?php echo $_SERVER['PHP_SELF'] . '?op=options&gc=3'; ?>"><img src="images/small_4.jpg" alt="Flash card 4" width="128" height="96" border="0" /></p>
<p>
  <?php endif; ?>
</p>
</body>
</html>
