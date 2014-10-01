<!DOCTYPE html>

<html lang="en">
<head>

	<meta charset="utf-8">

	<meta name="author" content="Steve Raskin, aka Stylvs Cascadivs" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title>Weight Tracker</title>

	<style media="screen, projection" type="text/css">

		/* nano-reset + LAYOUT */
		*		{ margin: 0; padding: 0; border: 0; }
		body	{ padding: 1.5rem 7.5rem; }

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
		#input, #output	{ clear: both; padding: 1.5rem; border: 1px dotted #ccc; }
		#input	{
			display: flex;
			flex-direction: column; /* stack 'em */
			flex-direction: row;
			margin-bottom: 1.5rem;
			}
		#input:hover, #output:hover	{ background: #f6f6f6; border: 1px solid #666; border-radius: .9rem; }

			#set-date-range,
			#add-data			{ min-width: 15rem; /* at least this way a too-small browser window hides rather than crushes */ padding: 1.5rem; }

			#set-date-range	{ order: 0; flex: 1; border-right: 0px dotted #ccc; }
			#add-data			{ order: 1; flex: 1; }



		/* INPUT FORM */
		input, select	{ width: 15rem; }
		input[type="date"]			{ display: block; clear: both; margin-bottom: 1.5rem; padding: .3rem .6rem; border: 1px solid #ccc; }
		input[type="date"]:focus	{ border: 1px solid #090; border-radius: .9rem; }
		button, input[type="submit"]	{
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
		select	{ clear: both; display: block; margin-bottom: 1.5rem; padding-left: .6rem; border: 1px solid #ccc; }
		option	{ padding: .3rem .6rem; }
		

		/* OUTPUT */
		#output:after	{ clear: both; display: table; content: ""; }
		#output dt 	{ clear: both; display: block; float: left; margin-right: .9rem;color: #666; border: 0px dotted #f00; }
		#output dd 	{ display: block; float: left; margin-bottom: .9rem; border: 0px dotted #0f0; }

		#scale		{ float: left; }
		#scale li	{
			list-style: none;
			clear: both;
			float: left;
			text-align: right;
			margin-bottom: 3rem;
			border: 1px solid #ccc;
			}
		#graph	{
			width: 100%;
			height: 100%;
			vertical-align: bottom;
			border: 1px solid #000;
			border: 0 0 1px 1px;
			}

	</style>

</head>

<body>

	<div id="input">
		<div id="set-date-range">
			<form>
				<h3>Select Date Range:</h3>
				<label>From: <input type="date" id="date-start" /></label>
				<label>To: <input type="date" id="date-end" /></label>

				<button type="submit" id="submitter">load data</button>
			</form>
		</div><!--	END div id="set-date-range"	-->

		<div id="add-data">
			<form>
				<h3>Add Data:</h3>
				<label>Date (current date or datepicker?): <input type="date" id="date-current" /></label>

				<label>Select weight:</label>
				<select id="selector">
					<option selected>Select weight:</option>
				</select>

				<button type="submit" id="submit-new-data">submit new data</button>

			</form>
		</div><!--	END div id="add-data"	-->

	</div><!--	END div id="input"	-->

	<div id="output-wrapper">
		<dl id="output">
			<dt class="date">Date: </dt>
			<dd class="value">[ weight ]</dd>

			<dt class="date">Date: </dt>
			<dd class="value">[ weight ]</dd>

			<dt class="date">Date: </dt>
			<dd class="value">[ weight ]</dd>
		</dl><!--	END dl id="output"	-->
		
	</div><!--	END div id="output-wrapper"	-->

	<script>

		// set current date
		var dateInput = document.getElementById('date-current');
		console.log(dateInput);
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
		dateInput.value = today;
	


		// GENERATE OPTIONS
		function populateSelect(){
			var selector = document.getElementById('selector');
			var min = 150;
			var max = 180;
			for (var i=min; i<max; i+=0.2) {
				var option = document.createElement('option');
				var val = (parseFloat(i).toFixed(1));
				option.value = option.innerHTML = val; // set both option's value attribute & option text
				selector.appendChild(option);
			} // loop
		} // populateSelect
	
		populateSelect();


	</script>



</body>
</html>

	<!--
	<ul id="scale">
		<li>scale</li>
		<li>scale</li>
		<li>scale</li>
		<li>scale</li>
		<li>scale</li>
		<li>scale</li>
		<li>scale</li>
		<li>scale</li>
		<li>scale</li>
		<li>scale</li>
	</ul>
	<div id="graph">
		graph
	</div>END div id="graph"
	-->	

