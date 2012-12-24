<?php header("Cache-Control: no-store"); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>really simple announce list</title>
<style>
<?php
include("../style.css");
?>
</style>
</head>
<body>
<?php
include("list-funcs.php");

if ($_POST["email"]) {
if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
	$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
	$id=subscribe($email);
	echo "<h3 class=sub>Thank you for subscribing $email !</h3>";
} else { die("<h1 class=un>Invalid email</h1>"); }
}

if (empty($id)) {
	if (valid_id($_GET["id"])) {
	$id = $_GET["id"];
	} else {
		die("<h1 class=un>Invalid unsubscription ID</h1>");
	}
}

?>
<form action="/list/subscribe.php" method=post>
<label for="why">Reason why?</label>
<input onkeyup="setOneClick(this.value);" id=why name=why size=30 placeholder="Any reason why?" value="<?= htmlspecialchars($_GET[why], ENT_QUOTES, 'UTF-8'); ?>"/>
<input name=id type=hidden value=<?= $id ?>>
<input name=submit type=submit value="1-click Unsubscribe"/>
</form>
<?php
echo "<p><a id=oneclick href=http://$_SERVER[HTTP_HOST]/unsub/$id>http://$_SERVER[HTTP_HOST]/1-click-unsubscribe/$id</a></p>";
include ("reminder.html");
?>
<script>
var l = document.getElementById('oneclick');
var orig = l.getAttribute('href');
function setOneClick(why) {
l.setAttribute('href', orig + "/" + why);
l.innerHTML = orig + "/" + why;
}
setOneClick(document.getElementById('why').value);
</script>
</body>
</html>
