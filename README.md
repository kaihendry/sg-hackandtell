# Notes on the list manager, a "suck less" feedburner

For low volume announcements, with emails generated from a RSS feed ideally.

* [Code that manages the list](https://github.com/kaihendry/sg-hackandtell/tree/master/list)
* [Script that sends the emails with unsubscribe link in footer and header](https://github.com/kaihendry/sg-hackandtell/blob/master/list/maillist)

Inspired by <http://sivers.org/emailer> and
[HackerNews](http://news.ycombinator.com/item?id=4929997). Hinged upon [random
strings](http://stackoverflow.com/questions/13948487). Very low SLOC, aims to
be [suck less](http://suckless.org).

* Direct GET /unsub/$id/$reason for list-unsubscribe: mail header and POST otherwise from /unsubscribe/$id/$reason

# Why use this over Campaign Monitor, madmimi, Mail Chimp, Feedburner, Dreamhost announce et al?

* Implements RFC 2369 `List-Unsubscribe:`
* Writes down reasons for leaving in `usubs.private`
* More control and simpler
* MIT licensed

## subs/ directory

`subs/.htaccess` must read:

	deny from all

Probably should be on some other non-www path, but where?

## Does not send a verification email to say whether one is subscribed or unsubscribed

I don't think this is needed. If subscription is abused, you should be able to see patterns in the IP column.

## Reason why unsubscribed

	http://$domain/unsubscribe/$id/$reason

When unsubscribing `http://sg.hackandtell.org/unsubscribe/6b813f10/foobar`, the "foobar"
should indicate the subject of that correspondence so you know where&why people
unsubscribed.

## Demonstration

<http://sg.hackandtell.org>

## TODO

* Simple inotifywait process on subs/ to see who has subscribed or unsubscribed
* Some automated way to handle bounces
