<!doctype html>

<html>

<head>

	<meta charset='UTF-8' />

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
		fieldset				{ clear: both; margin-bottom: 1.5rem; }
		fieldset:last-of-type	{ margin-bottom: 3rem; } /* space above submit button */
		fieldset>fieldset:last-of-type	{ margin-bottom: 0; } /* if last fieldset contains a fieldset */
		legend		{ margin-bottom: .9rem; font-weight: bold; }

		input[type="date"],
		input[type="number"]		{ padding: .3rem .6rem; border: 1px solid #ccc; }
		input[type="date"]:focus,
		input[type="number"]:focus	{ border: 1px solid #090; border-radius: .9rem; }


		fieldset.checkbox	{}
		.checkbox label span		{ border-bottom: 1px dotted #666; }
		.checkbox label span:hover	{ border-bottom: 1px solid #000; }
		.checkbox input[type="checkbox"]	{ margin-right: .9rem; }

		fieldset.inline	{ display: inline; margin-right: 1.5rem; }/* this is gonna need att'n */
		
		fieldset.inline span,
		fieldset.inline label	{ display: inline-block; }

		/* custom  label/'label' widths, per content */ 
		fieldset#set-date-range span	{ width: 3.3rem;}

		fieldset#weigh-in-date span 	{ width: 7.5rem; }
		fieldset#weigh-in-date input	{ width: 12rem; }

		fieldset#scale-wrapper			{ /*display: none; */}
		fieldset#scale-wrapper label	{ width: 7.5rem; margin-right: -5px; /* something buggy about this or my error? */}
		
		select	{ /*clear: both; display: block;*/ min-width: 15rem; padding-left: .6rem; border: 1px solid #ccc; }
		option	{ padding: .3rem .6rem; }

		.hint	{ display: inline; color: #333; }

		/* one-offs */
		#set-date-range label	{ display: block; margin-bottom: 1.5rem; }
		.disabled	{ opacity: 0.45; }

		/* customized form elements */
		fieldset.scale-limit input	{ width: 6rem; vertical-align: bottom; }
		/* button#make-scale	{ margin-bottom: -3px; }*/



		button[type="submit"], input[type="submit"]	{
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
		#output dt,
		#output dd		{ clear: both; display: block; float: left; color: #000; font-weight: bold; border: 0px dotted #000; }
		#output dt span,
		#output dd span	{ display: inline-block; width: 6rem; margin-right: .9rem; text-align: right; font-weight: normal; color: #666; }
		#output dd		{ margin-bottom: .9rem; }
		#output dd:after	{ content: " lbs.";}


	</style>
	<title>Weight Tracker</title>

</head>

<body>

	<div id="debug">
		<p>This is div#debug</p>
	</div><!--	END div id="debug"	-->
	

	<!-- DATA INPUT: filters, options, etc. -->
	<div id="input">

		<!-- LOAD DATA (filters) -->
		<div id="load-data-wrapper">

			<h3>Load data</h3>
			<form id="load-data">

				<fieldset class="checkbox">
					<label><input type="checkbox" id="show-all"  /><span>Show all</span></label>
					<p class="hint">(deselect to specify date range)</p>
				</fieldset>

				<fieldset class="text-input inline disabled" id="set-date-range">
					<legend>Set Date Range</legend>
					<label>
						<span>From:</span>
						<input type="date" id="date-start" />
					</label>

					<label>
						<span>To:</span>
						<input type="date" id="date-end" />
					</label>
				</fieldset>

				<button type="submit" id="data-loader">load data</button>
			</form>
		</div><!--	END div id="load-data-wrapper"	-->


		<!-- ADD DATA -->
		<div class="add-data-wrapper">

			<h3>Add data</h3>
			<form id="add-data" action="#" validate>

				<!-- ADD DATA -->

				<!-- WEIGHT-IN DATE -->
				<fieldset id="weigh-in-date-wrapper">
					<fieldset class="checkbox">
						<legend>Weigh-in Date:</legend>
						<label><input type="checkbox" id="date-use-current" /><span>Use Current Date</span></label>
						<p class="hint">(deselect to specify date)</p>
					</fieldset>

					<fieldset class="text-input inline disabled" id="weigh-in-date">
						<label><span>Weigh-In Date:</span><input type="date" class="datepicker" id="new-date" placeholder="placeholder" /></label>
					</fieldset>
				</fieldset><!--	END div id="weigh-in-date-wrapper"	-->


				<!--
					THE SCALE, USER-DEFINED (populateSelect.js)
					I SPENT A STUPID AMOUNT OF TIME ON THIS 'CAUSE I WANTED TO LEARN HOW TO GENERATE A SELECT'S OPTIONS ACCORDING TO USER INPUT,
					AND TO DO SOME BASIC VALIDATION AND ERROR HANDLING ON BLUR/ON FOCUS, ETC.
					NOW THAT I HAVE IT WORKING I'LL RETIRE IT IN LIEU OF A TEXT INPUT FOR THE WEIGHT VALUE
				-->
				<fieldset id="scale-wrapper">
					<legend>Define Scale:</legend>

					<fieldset class="text-input inline scale-limit">
						<label>
							<span>Lower Limit:</span>
							<input type="number" id="lower-limit" value="100" min="100" step="1" />
						</label>
					</fieldset>
					<fieldset class="text-input inline scale-limit">
						<label>
							<span>Upper Limit:</span>
							<input type="number" id="upper-limit" max="600" step="1" />
						</label>
					</fieldset>
					<fieldset class="button-wrapper inline">
						<button class="button2" id="make-scale">Make Scale</button>
					</fieldset>
					<fieldset class="select" id="scale-select">
						<label>Select weight:</label>
						<select id="scale">
							<option value="Select weight" selected>Select weight:</option>
						</select>
					</fieldset>
				</fieldset><!--	END fieldset id="scale-wrapper"	-->

				<button type="submit" id="submit-new-data">add new data</button>

			</form><!--	END form  id="add-data"	-->
		</div><!--	END div class="add-data-wrapper"	-->
	</div><!--	END div id="input"	-->


	<!--	RENDER OUTPUT (eventually, a line graph?	-->	
	<div id="output-wrapper">
		<dl id="output">
		</dl><!--	END dl id="output"	-->
	</div><!--	END div id="output-wrapper"	-->

	<!-- ======================================================================================================================== -->

	<script src="/weighttracker/js/populateSelect.js"></script>

	<script>

		window.onload = function(){

			// LOAD DATA: 'Show All data' checked, Date Range inputs disabled
			var showAll = document.getElementById("show-all");
			var dateStart = document.getElementById("date-start");
			var dateEnd = document.getElementById("date-end");
			showAll.checked = true;
			dateStart.disabled = true;
			dateEnd.disabled = true;

			// LOAD DATA: Toggle 'Show All'/'Select Date Range'
			var dateRangeFieldset = document.getElementById("set-date-range");
			showAll.onclick = function(){
				if (!this.checked) {
					dateStart.disabled = false;
					dateEnd.disabled = false;
					dateRangeFieldset.className = "text-input inline";
					dateStart.focus();
				}
				else {
					dateStart.disabled = true;
					dateEnd.disabled = true;
					dateRangeFieldset.className = "text-input inline disabled";
				}
			} // showAll.onclick

			
			// LOAD DATA: submit button event listener
			var dataLoader = document.getElementById('data-loader');
			dataLoader.addEventListener('click', function(e){
				getData(url); // def need param here
				e.preventDefault();
				},
				false);

			//var url = "/weighttracker/json/weigh-in_data.json";
			var url = "json/weigh-in_data.json";
			var debug = document.getElementById("debug");


			// AJAX REQUEST
			function ajaxReq(){
				if(window.XMLHttpRequest) {
					var request = new XMLHttpRequest();
				}
				else if (window.ActiveXObject) {
					var request = new ActiveXObject("Microsoft.XMLHTTP");
				}
				return request;
			}

			// LOAD DATA
			function getData(){
				var request = ajaxReq();
				request.onreadystatechange = function() {
					if (request.readyState === 4 && request.status === 200) {
						var type = request.getResponseHeader("Content-Type");
						if (type === "application/json") {// check for others when necessary?
							processResponse(request.responseText); // [ returns a json string ]
						}
						else {
							alert("type is not json: " + type);
						}
					} // if readyState/status
				} // onreadystatechange
				request.open('GET', url);
				request.send(null);

				// LOAD DATA: response (json) > html
				function processResponse(response){
					var myObj = JSON.parse(response); // now it's an object
					var defList = document.getElementById("output");
					for (var key in myObj) {
						var dtTag = "<dt class=\"date\"><span>Date: </span>" + key + " </dt>";
						var ddTag = "<dd class=\"value\"><span>Weight: </span>" + myObj[key] + "</dd>";
						defList.innerHTML += dtTag;
						defList.innerHTML += ddTag;
					} // loop
				} // processResponse
			} // getData


			// NEW DATA: useCurrentDate checked, #new-date disabled
			var useCurrentDate = document.getElementById("date-use-current");
			var newDate = document.getElementById('new-date');
			var weighInDateFieldset = document.getElementById('weigh-in-date');
			useCurrentDate.checked = true;
			weighInDateFieldset.className = "text-input inline disabled";
			newDate.disabled = true;

			// NEW DATA: set current date in #new-date input
			var today = new Date();
			var date = today.getDate();
			var month = today.getMonth()+1; // January is 0
			var year = today.getFullYear();
			if (date<10) {
				date = "0" + date;
			}
			if (month<10) {
				month = "0" + month;
			}
			today = year + "." + month + "." + date;
			newDate.value = today;

			// NEW DATA: Toggle 'Use Current Date'/'Specify Date'
			useCurrentDate.onclick = function() {
				if (!this.checked) {
					weighInDateFieldset.className = "text-input inline";
					newDate.disabled = false;
					newDate.focus();
					newDate.value = "(pop up datepicker on focus?)";
				}
				else newDate.value = today;
			} // useCurrentDate.onclick

	
			// NEW DATA: scale event listener
			// see: populateSelect.js
			// scale.addEventListener('change', function(){},false); // seems to be unnecessary

			// NEW DATA: submit button event listener
			var submitData = document.getElementById('submit-new-data');
			submitData.addEventListener('click', function(e){
				e.preventDefault();
				ajaxPost();
				},
				false);


			// NEW DATA: AJAX POST
			function ajaxPost(){
				var request = ajaxReq();
				//var newData = {};

				// Date
				if (useCurrentDate.checked) {
					var newDateVal = today;
				}
				else {
					var newDateVal = newDate.value;
				}
				//console.log("newDateVal: "+ newDateVal);

				// Weight
				if (scale.selectedIndex == 0) {
					alert("OOPS! a weight selection is required");
					scale.focus();
				}
				else {
					var newWeightValue = scale.value;
					//console.log("newWeightValue: " + newWeightValue);
				}



				// var newData = JSON.stringify(newDateVal + ", " + newWeightValue); // use stringify method on an obj
				/*
				var newWeighin = {
					date: newDateVal,
					weight: newWeightValue
					}
				console.log("newWeighin: " + newWeighin);
				*/

				var newData = "date= "+ encodeURIComponent(newDateVal) + "&weight= "+ encodeURIComponent(newWeightValue);

				request.onreadystatechange = function() {
					if (request.readyState === 4 && request.status === 200) {
						var responseText = request.responseText;
						// document.getElementById("output").innerHTML = responseText;
						var dtTag = "<dt class=\"date\">" + responseText + ": </dt>";
						var ddTag = "<dd class=\"value\">" + responseText + "</dd>";
						var output = document.getElementById("output");
						output.innerHTML += responseText;



					} // if readyState/status
				} // onreadystatechange
				request.open('POST', "process_post.php", true);
				request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				//var newData = "firstName="+firstName+"&lastName="+lastName;
				request.send(newData);



/*

per Khoury demo

			request.onreadystatechange = function() {
				if(request.readyState == 4 && request.status == 200) {
					var responseText = request.responseText;
					document.getElementById("status").innerHTML = responseText;
				}
			}

			// Send the data to PHP now ... and wait for response to update the status div
			request.send(vars); // Actually execute the request
			document.getElementById("status").innerHTML = "processing...";







https://stackoverflow.com/questions/4935632/how-to-parse-json-in-javascript
var json = '{"result":true,"count":1}',
var obj = JSON.parse(json);


var mydata; // [{"id":"67","name":"TestString"}]
var json = $.parseJSON(mydata);
the json variable will contain the de-serialized json object



*/



				
				//request.send(newWeightValue, newDateVal);
			} // ajaxReq
		} // window.onload

	</script>





</body>
</html>
