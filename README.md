# Notes on the list manager [list.cgi](https://github.com/kaihendry/sg-hackandtell/blob/master/list.cgi)

Inspired by <http://sivers.org/emailer> and
[HackerNews](http://news.ycombinator.com/item?id=4929997). Hinged on [random
string](http://stackoverflow.com/questions/13948487). <100 SLOC.

## Does not say whether already subscribed

Duplicate subscriptions can be handled by sysop. Git commit, then:

	awk '!a[$NF]++' subs.txt
	git diff

## subs/ directory

`subs/.htaccess` reads:

	deny from all

Probably should be on some other non-www path, but where?

`subs/list` is managed in its own private git repository

## Does not send a verification email to say whether one is subscribed or unsubscribed

I don't think this is needed. If it is abused, you should be able to see patterns in the IP column.

## why

When unsubscribing `http://sg.hackandtell.org/list/6b813f10/foobar`, the "foobar"
should indicate the subject of that correspondence so you know where&why people
unsubscribed.

## TODO

simple inotifywait process on subs/ to see who has subscribed or unsubscribed

mail tool, that inserts the appropriate unsubscribe link

	02:17 <greybot> Some sed(1)s have a -i flag that allow you to "modify" files. Sed is NOT A FILE EDITOR: its -i flag does not edit a file, it deletes and re-writes it. Thi s has many problems, including breaking open handles and symlinks. Worse, -i usage is very unportable: your command can break or do bad things on other systems. Use ed(1) , vi(1) or ex(1) instead!
