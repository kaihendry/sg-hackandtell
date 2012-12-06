<style>
<?php
include ('style.css');
?>
</style>
<?php

if (empty($_POST["email"])) {
	die();
}

$fp = fopen('.emails.txt', 'a');
fwrite($fp, date("c") . " " . $_SERVER["REMOTE_ADDR"] . " " . $_POST["email"] . "\n");
fclose($fp);
?>

<h1>Hey <?php echo $_POST["email"]; ?>, you will be notified of our next event.</h1>

<p><?php system('wc -l < .emails.txt'); ?> signed up so far.</p>
