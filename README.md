# Notes on the list manager, a "suck less" feedburner

Designed for low volume announcements, with emails generated from a RSS feed
ideally.

* [Code that manages the list](https://github.com/kaihendry/sg-hackandtell/tree/master/list)
* [Code that sends the emails](https://github.com/kaihendry/sg-hackandtell/blob/master/maillist)

Inspired by <http://sivers.org/emailer> and
[HackerNews](http://news.ycombinator.com/item?id=4929997). Hinged upon [random
strings](http://stackoverflow.com/questions/13948487). Very low SLOC, aims to
be [suck less](http://suckless.org).

## Does not say whether already subscribed

Not leaking who or who is not subscribed.

Duplicate subscriptions can be handled by sysop. Git commit, then:

	awk '!a[$NF]++' subs.txt
	git diff

## subs/ directory

`subs/.htaccess` reads:

	deny from all

Probably should be on some other non-www path, but where?

`subs/list` is managed in its own private git repository

## Does not send a verification email to say whether one is subscribed or unsubscribed

I don't think this is needed. If subscription is abused, you should be able to see patterns in the IP column.

## Reason why unsubscribed

	http://$domain/list/$id/$reason

When unsubscribing `http://sg.hackandtell.org/list/6b813f10/foobar`, the "foobar"
should indicate the subject of that correspondence so you know where&why people
unsubscribed.

## Example of where to subscribe

<http://sg.hackandtell.org>

## TODO

* Simple inotifywait process on subs/ to see who has subscribed or unsubscribed
* Some automated way to handle bounces
