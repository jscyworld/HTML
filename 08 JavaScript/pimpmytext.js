function timerFunc(adder) {
	var mytimer = setInterval("onclickFunc(" + adder + ")", 500);
}

function onclickFunc(adder) {
	// alert("Hello, world!");
	var paragraph = document.getElementById("text");
	// paragraph.style.fontSize = "24pt";
	if (paragraph.style.fontSize == "") {
		paragraph.style.fontSize = "12pt";
	}
	paragraph.style.fontSize = parseInt(paragraph.style.fontSize) + adder + "pt";

}

function checkboxFunc() {
	var checkbox = document.getElementById("checkbox");
	var paragraph2 = document.getElementById("text");
	if (checkbox.checked) {
		// alert("Text changed!");
		paragraph2.style.color = "green";
		paragraph2.style.textDecoration = "underline";

		// Extra 01
		document.body.style.backgroundImage = "url('http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/8/hundred.jpg')";
	} else {
		// alert("Undo text change!");
		paragraph2.style.color = "black";
		paragraph2.style.textDecoration = "none";
		document.body.style.backgroundImage = "none";
	}
}

function snoopifyFunc() {
	var paragraph3 = document.getElementById("text");
	paragraph3.style.color = "black";
	paragraph3.style.textDecoration = "none";
	var capitalized = paragraph3.value.toUpperCase();
	document.getElementById("text").value = capitalized;

	var s1 = paragraph3.value.toString();
	var a1 = s1.split(".");
	s1 = a1.join("-izzle.");
	document.getElementById("text").value = s1;
}

// Extra 03
function malkoFunc() {
	var paragraph4 = document.getElementById("text");
	paragraph4.style.color = "black";
	paragraph4.style.textDecoration = "none";
	var s2 = paragraph4.value.toString();
	var a2 = s2.split(" ");
	for (var i = 0; i < a2.length; i++) {
		if (a2[i].length >= 5) {
			a2[i] = "Malkovitch";
		}
	}
	s2 = a2.join(" ");
	document.getElementById("text").value = s2;
}