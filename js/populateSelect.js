/*
Scale v.1: scale range specified in the js:

function makeScale(){
	var scale = document.getElementById('scale');
	var min = 150;
	var max = 180;
	for (var i=min; i<max; i+=0.2) {
		var option = document.createElement('option');
		var val = (parseFloat(i).toFixed(1));
		option.value = option.innerHTML = val; // sets both value & text
		scale.appendChild(option);
	} // loop
} // makeScale
makeScale();
*/

// Scale v.2: scale range is user-defind

var makeScale = function(){

	var minInput = document.getElementById("lower-limit");
	var maxInput = document.getElementById("upper-limit");
	var scale = document.getElementById("scale");
	scale.disabled = true;

	minInput.onfocus = function(){
		if(this.value == "0") {
			this.value = "100";
		}
	}
	minInput.onblur = function(){
		this.value = parseInt(Math.round(this.value)); // round, strip decimal
	}
	maxInput.onfocus = function(){
		this.setAttribute("min", (parseInt(minInput.value)+1)); // w/out parseInt, fails to allow increment using arrow key
		if(!this.value || this.value <= minInput.value){
			this.value = parseInt(minInput.value)+1;
		}
	}

	function validateScale(){
		var min = parseInt(Math.round(minInput.value));
		var max = parseInt(Math.round(maxInput.value));
		var scaleMax = 360; // besides reflecting real-world scale, also prevent runaway script

		// 1. CHECK FOR 2 VALUES:
		if (!min || !max) {
			if (!min) {
				alert("missing value for LOWER limit");
				minInput.focus();
			}
			else if (!max) {
				alert("missing value for UPPER limit");
				maxInput.focus();
			}
		} // if !min || !max

		// 2. TYPICAL BATHROOM SCALE MAXES OUT @ 300LBS
		else if (min >= scaleMax || max >= scaleMax) {
			alert("Pardon me, but if you need a scale that exceeds " +scaleMax+ " lbs,\n"+
			"maybe you should step away from the software and\n"+
			"haul your arse to a nutritionist");
			minInput.focus();
			maxInput.value = "";
		}

		// 3. WITH 2 LEGIT VALUES ...
		else if (min && max) {
			// Totally unnecessary, just for the excercise:
			if (min >= max){
				alert("upper limit must be greater than lower limit");
				maxInput.focus();
			}
			// GET ON WITH IT ALREADY:
			else {
				populateSelect(min, max);
			}
		}// if min && max
	} // validateScale


	// BUTTON: "MAKE SCALE"
	var button = document.getElementById("make-scale");
	button.addEventListener('click', function(e){ // dunno why it needs the argument but it does
		validateScale();
		e.preventDefault();
		},
		false);

	function populateSelect(min, max){
		console.log("lower limit: " + min);
		console.log("upper limit: " + max);

		scale.disabled = false;
		scale.innerHTML = "";
		for (var i=min; i<max; i+=0.2) {
			var option = document.createElement('option');
			var val = (parseFloat(i).toFixed(1));
			option.value = option.innerHTML = val; // set both option's value attribute & option text
			scale.appendChild(option);
		} // loop
	} // populateSelect

} // makeScale

makeScale();