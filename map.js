var iOS = (navigator.userAgent.match(/(iPad|iPhone|iPod)/i) ? true: false);

c = document.getElementById("where");

if (iOS) {
	c.innerHTML = '<a href="maps://?q=' + c.textContent + '">' + c.textContent + '</a>';
} else {
	c.innerHTML = '<a href="http://gothere.sg/maps#q:' + c.textContent.replace(",", "%2C") + '">' + c.textContent + '</a>';
}
