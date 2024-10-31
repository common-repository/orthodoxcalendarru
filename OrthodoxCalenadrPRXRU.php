<?php header("Content-Type:text/html; charset=windows-1251");

$month = $_GET['month'];
$year = $_GET['year'];
$today = $_GET['today'];
$trp = $_GET['trp'];
$header = $_GET['header'];
$lives = $_GET['lives'];
$scripture = $_GET['scripture'];
$dt = $_GET['dt'];

#$contents = file_get_contents("http://www.holytrinityorthodox.com/ru/calendar/calendar2.php?month=$month&today=$today&year=$year&dt=$dt&header=$header&lives=$lives&trp=$trp&scripture=$scripture");

if( ini_get('allow_url_fopen') ) {
    $contents2 = file_get_contents("http://www.holytrinityorthodox.com/ru/calendar/calendar2.php?month=$month&today=$today&year=$year&dt=$dt&header=$header&lives=$lives&trp=$trp&scripture=$scripture");
    
    $contents = str_replace("<img height=\"16pt\" style=\"vertical-align:text-bottom\"",
"<img class=\"octhButton\"",
$contents2);
} else {
    $contents = "Функция PHP allow_url_fopen отключена. Попросите хостинг включить эту функцию.";
}

echo $contents;
?>
