#!/bin/bash

YYYYMMDD=$(date -d"$1" +%Y%m%d)
if test $(date +%Y%m%d) -gt "${YYYYMMDD:-0}"; then
	echo "Usage: $0 [date string]"
	exit 1
fi

cat <<EOF | sed 's/^ *//'
	BEGIN:VCALENDAR
	VERSION:2.0
	PRODID:-//Hack and Tell//NONSGML v1.0//EN
	BEGIN:VEVENT
	UID:$(date +%s%N)@sg.hackandtell.org
	SUMMARY:Hack and Tell
	LOCATION:Hackerspace.SG, 344B King George's Avenue
	DESCRIPTION:Show and tell for hackers. Five minute demos, each followed by 5 minutes of Q&A.
	DTSTART;TZID=Asia/Singapore:${YYYYMMDD}T200000
	DTEND;TZID=Asia/Singapore:${YYYYMMDD}T220000
	END:VEVENT
	END:VCALENDAR
EOF
