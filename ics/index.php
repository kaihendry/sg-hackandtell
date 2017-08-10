<?php

date_default_timezone_set('Asia/Singapore');
$fp = fopen('debug.log', 'a');
@fwrite($fp, date("c") . " " . gethostbyaddr($_SERVER['REMOTE_ADDR']) . " " . $_SERVER['HTTP_USER_AGENT'] . "\n");
fclose($fp);

header('Content-type: text/calendar');
readfile("hacktell-singapore.ics");

?>
