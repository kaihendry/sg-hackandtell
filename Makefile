index.html: index.src.html style.css map.js
	m4 -PEIinc $< > $@

organisation/index.html: organisation/index.src.html organisation/nyc.html organisation/berlin.html style.css
	m4 -PEIinc $< > $@

organisation/nyc.html: organisation/nyc.md
	markdown $< > $@

organisation/berlin.html: organisation/berlin.md
	markdown $< > $@

clean:
	rm -f organisation/nyc.html organisation/berlin.html organisation/index.html index.html
