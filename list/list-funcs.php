<?php
function subscribe($email) {
$id=trim(`head -c 4 /dev/urandom | xxd -p`);
if (! is_writable("subs/$id")) { return false; }
file_put_contents("subs/$id", gethostbyaddr($_SERVER["REMOTE_ADDR"]) . " " . $_SERVER['HTTP_REFERER'] . " " . $email . "\n", FILE_APPEND);
return $id;
}

function unsubscribe($id) {
if (! is_writable("subs/$id")) { return false; }
$fp = fopen("subs/$id", "r");
$row = fgetcsv($fp, 0, " ");
$email = end($row);
$unsubscription_details = implode(' ', array(time(), time() - filemtime("subs/$id"), implode(' ', $row), filter_var(trim($_REQUEST[why]), FILTER_SANITIZE_STRING)));
file_put_contents("usubs.private", $unsubscription_details . "\n", FILE_APPEND);
fclose($fp);
unlink("subs/$id");
return $email;
}

function valid_id($id) {
if (ctype_xdigit($id) && strlen($id) == 8) { return true; }
return false;
}
?>
