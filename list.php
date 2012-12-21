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
global $s, $u;
$fp = fopen($s, "r");
while ($row = fgetcsv($fp, 0, " ")) {
	if ($id != $row[0]) {
		$new .= implode(' ', $row) . PHP_EOL;
	} else {
		$email = $row[3];
		file_put_contents($u, "$row[1] $row[2] $row[3] " . trim($_GET[why]) . "\n", FILE_APPEND);
	}
}
fclose($fp);
file_put_contents($s, $new);
return $email;
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>email list</title>
<style>
<?php
include("style.css");
?>
</style>
</head>
<body>
<?php
if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
	$email = $_POST["email"];
	$id=subscribe($email);
?>
<h3>Thank you for subscribing <?= $email ?> !</h3>
<form action="/list.php" method=get>
<input required=required type=email name=email title="We will never sell or distribute your email address" placeholder="Your email address" value="<?= $email ?>"/>
<input name=id type=hidden value=<?= $id ?>>
<input name=submit type=submit value="Unsubscribe"/>
</form>
<p>
<a href="http://<?= "$_SERVER[HTTP_HOST]/list/$id" ?>">One-click unsubscribe</a>
</p>
<?php
} else {
	if (isset($_GET['id'])) {
		$email=unsubscribe($_GET['id']);
		echo "<h3>We are sorry to see you go $email !</h3>";
	}
?>
<form action="/list.php" method=post>
<input required=required type=email name=email title="We will never sell or distribute your email address" placeholder="Your email address" value="<?= $email ?>"/>
<input name=submit type=submit value="Subscribe"/>
</form>
<?php
}
include ("reminder.html");
?>
<small><a href="https://github.com/kaihendry/sg-hackandtell">MIT source</a></small>
</body>
</html>
