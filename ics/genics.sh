#!/bin/bash
if ! test "$1" || test $(date +%Y%m%d) -gt "$1"
then
	echo Missing \$ $0 $(date --date='2 week' +%Y%m%d) \# argument
	exit 1
fi

cat <<EOF
BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//Hack and Tell//NONSGML v1.0//EN
BEGIN:VEVENT
UID: $(date +%s%N)
SUMMARY: Hack and Tell
LOCATION: Hackerspace.SG, 344B King George's Avenue
DESCRIPTION: Show and tell for hackers. Five minute demos, each followed by five minutes of questions.
DTSTART;TZID=Asia/Singapore: ${1}T200000
DTEND;TZID=Asia/Singapore: ${1}T220000
END:VEVENT
END:VCALENDAR
EOF
