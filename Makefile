INFILES = $(shell find . -name "*.mdwn")
OUTFILES = $(INFILES:.mdwn=.html)

all: $(OUTFILES)

%.html: %.mdwn footer.inc header.inc style.css
	m4 -PEIinc header.inc > $@
	markdown $< >> $@
	cat footer.inc >> $@

clean:
	rm -f $(OUTFILES)

PHONY: all clean
