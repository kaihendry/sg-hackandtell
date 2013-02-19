INFILES = `find . -name "*.mdwn"`
OUTFILES=${INFILES:%.mdwn=%.html}

all:V: $OUTFILES

%.html: %.mdwn footer.inc header.inc style.css
	m4 -PEIinc header.inc > $target
	markdown $stem.mdwn >> $target
	cat footer.inc >> $target

clean:V:
	rm -f $OUTFILES
