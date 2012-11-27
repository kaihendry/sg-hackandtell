index.html: index.src.html nyc.html berlin.html
	m4 -PEIinc $< > $@

nyc.html: nyc.md
	markdown $< > $@

berlin.html: berlin.md
	markdown $< > $@

clean:
	rm -f nyc.html berlin.html index.html
