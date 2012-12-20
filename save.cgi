#!/bin/bash
. ./cgi.sh

# Assuming
# $CGI_id GET + ?id= = one click unsubscribe
# $CGI_email POST = subscribing

subscribe() {
rid=$(head -c 4 /dev/urandom | xxd -p)
echo $(date +%s) $REMOTE_ADDR $CGI_email >> subs/$rid
echo $rid
test -f "subs/$rid" || return 1
}

unsubscribe() {
if test -f "subs/$1"
then
	awk '{print $3}' subs/$1
	rm subs/$1
else
	echo Already unsubscribed
fi
}

cat <<EOF
Content-type: text/html

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>email list</title>
<style>
$(cat style.css)
</style>
</head>
<body>
EOF

if test $REQUEST_METHOD = "POST" && test "$CGI_email"
then
# code that subscribes
	id=$(subscribe $CGI_email)
	if test $? -eq 1
	then
		echo "<h2>permissions incorrect. chown -R :www-data .</h2>"
		exit
	fi
	cat <<EOF
<h3>Thank you for subscribing !</h3>
<form action="save.cgi" method=get>
<input required=required type=email name=email title="We will never sell or distribute your email address" placeholder="Your email address" value="$CGI_email"/>
<input name=id type=hidden value=$id>
<input name=submit type=submit value="Unsubscribe"/>
</form>
<p>
<a href="http://$HTTP_HOST/list/$id">One-click unsubscribe</a>
</p>

<pre>$(printenv)</pre>
</body>
</html>
EOF

else

if test "$CGI_id"
then
	email=$(unsubscribe $CGI_id)
	echo "<h3>We are sorry to see you go $email !</h3>"
fi

cat <<EOF
<form action="save.cgi" method=post>
<input required=required type=email name=email title="We will never sell or distribute your email address" placeholder="Your email address" value="$email"/>
<input name=submit type=submit value="Subscribe"/>
</form>
EOF
fi
