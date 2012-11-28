var iOS = (navigator.userAgent.match(/(iPad|iPhone|iPod)/i) ? true: false);

c = document.getElementById("where");
console.log(c);

if (iOS) {
	c.innerHTML = '<a href="maps://?q=' + c.innerText + '">' + c.innerText + '</a>';
} else {
	c.innerHTML = '<a href="http://gothere.sg/maps#q:' + c.innerText.replace(",", "%2C") + '">' + c.innerText + '</a>';
}
