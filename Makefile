# Suckless static site generator by hendry@iki.fi

INFILES = $(shell find . -name "*.mdwn")
#INFILES = $(shell git ls-files -- '*.mdwn')
OUTFILES = $(INFILES:.mdwn=.html)

all: $(OUTFILES)

%.html: %.mdwn footer.inc header.inc style.css
	@m4 -PE header.inc > $@
	@# First seen comment becomes page title
	@sed -n  '/<!--/{s/<!-- *//;s/ *-->//;p;q; }' $< >> $@
	@echo "</title></head><body>" >> $@
	# https://github.com/jgm/CommonMark
	@cmark $< >> $@
	@cat footer.inc >> $@
	@echo $< '→' $@

clean:
	rm -f $(OUTFILES)
