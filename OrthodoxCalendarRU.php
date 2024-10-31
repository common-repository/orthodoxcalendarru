<?php
/*
Plugin Name: Православный календарь
Plugin URI: http://www.holytrinityorthodox.com/ru/calendar/
Description: Православный календарь.
Version: 1.1
Author: David L.
License: GPL2
*/

function Orthodox_CalendarRU()
{
$js = '<SCRIPT TYPE="text/javascript">
<!--
var currentDayRU = new Date();

function popup(mylink, windowname)
{
if (! window.focus)return true;
var href;
if (typeof(mylink) == \'string\')
   href=mylink;
else
   href=mylink.href;
var showWin = window.open(href, windowname, \'width=600,height=500,resizable=yes,dependent=yes,scrollbars=yes\');
showWin.focus();
return false;
}

function callCalendarRU(x) {

var mm=x.getMonth()+1;
var dd=x.getDate();
var yy=x.getFullYear();
var dt=1;
var hh=1;
var ll=4;
var tt=0;
var ss=1;

loadCalendar2RU(mm,dd,yy,dt,hh,ll,tt,ss);
}

function todayDateRU() {
var today=new Date();
callCalendarRU(today);
currentDayRU = today;
}

function nextdayDateRU() {
var next = new Date(currentDayRU.getTime() + 24*60*60*1000);
callCalendarRU(next);
currentDayRU = next;
}

function previousDateRU() {
var previous = new Date(currentDayRU.getTime() - 24*60*60*1000);
callCalendarRU(previous);
currentDayRU = previous;
}

var xmlHttpRU;
function loadCalendar2RU(mm, dd, yy, dt, hh, ll, tt, ss)
{
xmlHttpRU=null;
if (window.XMLHttpRequest)
  {// code for Firefox, Opera, IE7, etc.
  xmlHttpRU=new XMLHttpRequest();
  }
else if (window.ActiveXObject)
  {// code for IE6, IE5
  xmlHttpRU=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
if (xmlHttpRU!=null)
  {
  var par="' . WP_PLUGIN_URL . '/orthodoxcalendarru/OrthodoxCalenadrPRXRU.php";
  par=par+"?month="+mm + "&today="+dd + "&year="+yy + "&dt="+dt + "&header="+hh + "&lives="+ll + "&trp="+tt + "&scripture="+ss;
  par=par+"&sid="+Math.random();

  xmlHttpRU.onreadystatechange=stateChanged2RU;

  xmlHttpRU.open("GET", par,true);
  xmlHttpRU.send(null);
  }
else
  {
  alert("Your browser does not support XMLHTTP.");
  }
}

function stateChanged2RU() 
{ 
if (xmlHttpRU.readyState==4)
 {
   if (xmlHttpRU.status==200)
    {
 document.getElementById(\'T1RU\').innerHTML=xmlHttpRU.responseText 
    }
  else
    {
	 document.getElementById(\'T1RU\').innerHTML="<a href=\"http://www.holytrinityorthodox.com/ru/\">holytrinityorthodox.com</a>";   
    }
 } 
}

callCalendarRU(currentDayRU);

// timer every 2 hour
setInterval(adjust_to_Today, 2000*60*60);
function adjust_to_Today() {
  today=new Date();	
currentDayRU = today;
callCalendarRU(currentDayRU);
}
//-->
</SCRIPT>';

$buttons = '<div class="ocButtonsBar"  align="left">
<button onclick="previousDateRU()" class="ocButton">❰</button>
<button onclick="todayDateRU()" class="ocButton">▇</button>
<button onclick="nextdayDateRU()" class="ocButton">❱</button>
</div>
<div id="T1RU"></div>
';

$title = '<div class="widget"><h2 class="widget-title"><a href="http://www.holytrinityorthodox.com/ru/calendar/" title="Православный календарь">Православный календарь</a></h2>';

echo $title . $js . $buttons . "</div>";
}

function Orthodox_Calendar_init_RU(){
		register_sidebar_widget('Православный календарь', 'Orthodox_CalendarRU');
}

function add_Orthodox_Calendar_stylesheet_RU() {
	$myStyleUrl = WP_PLUGIN_URL . '/orthodoxcalendarru/OrthodoxCalendarRU.css';
	$myStyleFile = WP_PLUGIN_DIR . '/orthodoxcalendarru/OrthodoxCalendarRU.css';
	if ( file_exists($myStyleFile) ) {
		wp_register_style('myStyleSheets', $myStyleUrl);
		wp_enqueue_style( 'myStyleSheets');
	}
}

add_action("plugins_loaded", "Orthodox_Calendar_init_RU");
add_action('wp_print_styles', 'add_Orthodox_Calendar_stylesheet_RU');

?>
