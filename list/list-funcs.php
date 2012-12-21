<?php
$s="subs/list";
$u="subs/ulist";

function subscribe($email) {
global $s;
$rid=trim(`head -c 4 /dev/urandom | xxd -p`);
file_put_contents($s, $rid . " " . time() . " " . $_SERVER["REMOTE_ADDR"] . " " . $email . "\n", FILE_APPEND);
return $rid;
}

function unsubscribe($id) {
// TODO Perhaps lock in case a subscribe comes in at the very same time?
global $s, $u;
$fp = fopen($s, "r");
while ($row = fgetcsv($fp, 0, " ")) {
	if ($id != $row[0]) {
		$new .= implode(' ', $row) . PHP_EOL;
	} else {
		$email = $row[3];
		file_put_contents($u, "$row[1] $row[2] $row[3] " . trim($_POST[why]) . "\n", FILE_APPEND);
	}
}
fclose($fp);
file_put_contents($s, $new);
return $email;
}
?>
