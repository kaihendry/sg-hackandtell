# Suckless static site generator by hendry@iki.fi

INFILES = $(shell find . -name "*.mdwn")
OUTFILES = $(INFILES:.mdwn=.html)

all: $(OUTFILES)

%.html: %.mdwn footer.inc header.inc style.css
	@m4 -PE header.inc > $@
	@# First seen comment becomes page title
	@grep -m1 -oP '(?<=<!-- ).*?(?= -->)' $< >> $@ || true
	@echo "</title></head><body>" >> $@
	@markdown $< >> $@
	@cat footer.inc >> $@
	@echo $< '→' $@

clean:
	rm -f $(OUTFILES)
