<?php
function subscribe($email) {
$id=trim(`head -c 4 /dev/urandom | xxd -p`);
file_put_contents("subs/$id", time() . " " . $_SERVER["REMOTE_ADDR"] . " " . $email . "\n", FILE_APPEND);
return $id;
}

function unsubscribe($id) {
$fp = fopen("subs/$id", "r");
while ($row = fgetcsv($fp, 0, " ")) {
	$email = $row[2];
	file_put_contents("usubs.csv", "$row[0] $row[1] $row[2] " . filter_var(trim($_POST[why]), FILTER_SANITIZE_STRING) . "\n", FILE_APPEND);
}
fclose($fp);
unlink("subs/$id");
return $email;
}

function valid_id($id) {
if (ctype_xdigit($id) && strlen($id) == 8) { return true; }
return false;
}
?>
