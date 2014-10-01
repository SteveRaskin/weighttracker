<!DOCTYPE html>

<html lang="en">
<head>

	<meta charset="utf-8">

	<meta name="author" content="Steve Raskin, aka Stylvs Cascadivs" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title>populate select element</title>

	<style media="screen, projection" type="text/css">
	</style>
	<style media="screen, projection" type="text/css">

		/* nano-reset + LAYOUT */
		*		{ margin: 0; padding: 0; border: 0; }
		body	{ padding: 3rem 4.5rem; font-size: .96rem; }

		/*
			FLEXBOX:
				- parent element:
					- display: flex;
					- flex-direction: row; (or column; this is likely reversed in media query)

				- flex boxes:
					- order: 0; [ sequence ]
					- flex: 3;  [ ? flex values are *relative* to each other, so two divs with flex: 1 are equal;
									with more than two divs, if flex values total 10, these are effectively percentages/10, e.g., if two divs each have flex 5, they're each 50% width ]
		*/

		h3	{ margin-bottom: 1.5rem; }
		#debug, #input, #output	{ clear: both; padding: 1.5rem; border: 1px dotted #ccc; }

		#debug	{ display: none; margin-bottom: 1.5rem; border: 1px dotted #ccc; }

		#input	{
			display: flex;
			flex-direction: column; /* stack 'em */
			flex-direction: row;
			margin-bottom: 1.5rem;
			}
		#input:hover, #output:hover	{ background: #f6f6f6; border: 1px solid #666; border-radius: .9rem; }

		div#load-data-wrapper	{ flex: 1; order: 0; margin-right: 3rem; padding-right: 3rem; border-right: 1px dotted #ccc; }
		div.add-data-wrapper	{ flex: 2; }
		
		h3	{ text-transform: uppercase; }
		
		/* FORM ELEMENTS */
		fieldset				{ clear: both; margin-bottom: 1.5rem; border: 1px solid #fff;  }
		fieldset:last-of-type	{ margin-bottom: 3rem; } /* space above submit button */
		fieldset>fieldset:last-of-type	{ margin-bottom: 0; } /* if last fieldset contains a fieldset */
		legend		{ margin-bottom: .9rem; font-weight: bold; }

		input[type="date"],
		input[type="number"]		{ display: block; margin-bottom: 1.5rem; padding: .3rem .6rem; border: 1px solid #ccc; }
		input[type="date"]:focus,
		input[type="number"]:focus	{ border: 1px solid #090; border-radius: .9rem; }


		fieldset.checkbox	{}
		.checkbox label span		{ border-bottom: 1px dotted #666; }
		.checkbox label span:hover	{ border-bottom: 1px solid #000; }
		.checkbox input[type="checkbox"]	{ margin-right: .9rem; }

		fieldset.inline span,
		fieldset.inline label	{ display: inline-block; }

		/* custom  label/'label' widths, per content */ 
		fieldset#set-date-range span	{ width: 3.3rem;}

		fieldset#weigh-in-date span 	{ width: 7.5rem; }
		fieldset#weigh-in-date input	{ width: 12rem; }

		fieldset#scale-wrapper label	{ width: 7.5rem; margin-right: -5px; /* something buggy about this or my error? */}
		
		select	{ clear: both; display: block; min-width: 15rem; padding-left: .6rem; border: 1px solid #ccc; }
		option	{ padding: .3rem .6rem; }

		.hint	{ display: inline; color: #333; }

		/* one-offs */
		#set-date-range label	{ display: block; margin-bottom: 1.5rem; }
		.disabled	{ opacity: 0.45; }

		button, input[type="submit"]	{
			clear: both;
			display: block;
			line-height: 1.2rem;
			padding: .3rem .9rem;
			font-size: 1rem;
			color: #09f;
			background: #fff;
			border: 1px dotted #09f;
			box-shadow: 1px 1px 1px #09f;
			}
		button:hover	{ border: 1px solid #09f; border-radius: .45rem; }
		button:active	{ color: #fff; background: #09f; box-shadow: 2px 2px 1px #fff inset; }


		/* OUTPUT */
		#output:after	{ clear: both; display: table; content: ""; }
		#output dt 			{ clear: both; display: block; float: left; margin-right: .9rem;color: #666; border: 0px dotted #f00; }
		#output dt:before 	{ content: "DATE: "; }
		#output dd			{ display: block; float: left; margin-bottom: .9rem; border: 0px dotted #0f0; }
		#output dd:before 	{ content: "WEIGHT: "; }


	</style>

</head>

<body>

	<form>

		<!--	USER-DEFINED SCALE	-->
		<h3>User defines scale range:</h3>
		<div>
			<label>Set scale low value:
				<input type="number" id="lower-limit" value="100" min="100" step="1" />
			</label>
		</div>
		<div>
			<label>Set scale high value:
				<input type="number" id="upper-limit" max="600" step="1" />
			</label>
		</div>

		<!--	MAYBE HIDE THE SELECT ELEMENT ON LOAD, THEN TOGGLE VISIBILITY OF THE INPUTS & BUTTON, AND THE SELECT 	-->
		<button id="make-scale">Make Scale</button>
		<br />
		<div id="scale-select">
			<div id="weight-selector-wrapper">
				<label>Select weight:</label>
				<select id="weight-selector">
					<option value="Select weight" selected>Select weight:</option>
				</select>
			</div>
		</div><!--	END div id="scale-select"	-->

	</form>


	<script>

		window.onload = function(){

			var makeScale = function(){

				var minInput = document.getElementById("lower-limit");
				var maxInput = document.getElementById("upper-limit");

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
					console.log("validateScale called");

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
						"maybe you should stop playing around with this app\n"+
						"and instead haul your arse to a doctor");
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
					var selector = document.getElementById("weight-selector");
					console.log("populateSelect called");
					console.log("lower limit: " + min);
					console.log("upper limit: " + max);

					selector.innerHTML = "";
					for (var i=min; i<max; i+=0.2) {
						var option = document.createElement('option');
						var val = (parseFloat(i).toFixed(1));
						option.value = option.innerHTML = val; // set both option's value attribute & option text
						selector.appendChild(option);
					} // loop
				} // populateSelect
			
			} // makeScale
			makeScale();
		} // window.onload
	</script>

</body>
</html>
