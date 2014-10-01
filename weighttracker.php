<!doctype html>

<html>

<head>

	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/weighttracker/db_connect.php'); ?>

	<!--	https://stackoverflow.com/questions/22466913/google-fonts-url-break-html5-validation-on-w3-org	-->
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto+Condensed%7COpen+Sans+Condensed:300,300italic%7CRaleway:400,300%7CUbuntu:400,300,300italic%7CPT+Sans+Narrow%7COxygen:400,300%7CTitillium+Web:400,300italic,300" />

	<meta charset='UTF-8' />

	<link rel="stylesheet" type="text/css" href="jquery-ui-1.11.1.custom/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="DataTables-1.10.2/media/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="weighttracker.css" />
	<style media="screen, projection" type="text/css"></style>




	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="jquery-ui-1.11.1.custom/jquery-ui.min.js"></script>

	<script src="js/jquery.paging.min.js"></script>
	<script type="text/javascript" src="DataTables-1.10.2/media/js/jquery.dataTables.min.js"></script>


	<title>Weight Tracker</title>

</head>

<body>

	<div id="debug">
		<p>This is div#debug</p>
	</div><!-- END div id="debug" -->

	<!-- http://www.berkeleywellness.com/healthy-eating/diet-weight-loss/article/weighing-bathroom-scales -->
	
	<header>
		<h1>weighttracker</h1>
		<!--
			<img id="logo" src="img/salter_scale_255x300.jpg" alt="logo" />
		<img id="logo" src="img/scale4.jpg" alt="logo" />
		-->
	</header>

	<!-- #app = page -->
	<div id="app">

		<form id="select-user-form">
			<fieldset class="select inline-label-input" id="select-user-fieldset">
				<label>Select User:</label>
				<select id="select-user">
					<option value="" selected>Select User:</option>
					<option id="user01" value="Herbie">Herbie</option>
					<option id="user02" value="Wayne">Wayne</option>
					<option id="user03" value="Freddie">Freddie</option>
					<option id="user04" value="Ron">Ron</option>
					<option id="user05" value="Tony">Tony</option>
					<option id="user06" value="Shecky">Shecky</option>
					<option id="user07" value="wtf">wtf</option>
				</select>
			</fieldset>
		</form>

			<!-- #flexbox: solely to wrap #input-wrapper & #output-wrapper -->
			<div id="flexbox">

				<!-- DATA INPUT: filters, options, etc. ================================================ -->
				<div id="input-wrapper">

					<!-- ADD DATA -->
					<div id="new-data-wrapper">

						<h3>Weigh In <span>(form#new-data)</span></h3>
						<form id="new-data" action="#">

							<fieldset class="checkbox">
								<legend>Weigh-in Date:</legend>
								<label><input type="checkbox" id="date-use-current" /><span>Use Today's Date</span></label>
								<p class="hint">(deselect to specify date)</p>
							</fieldset>

							<!-- Weigh-In DATE -->
							<fieldset class="text-input inline-label-input disabled" id="weigh-in-date-wrapper">
								<label>
									<span>Date:</span>
									<input type="date" class="datepicker" id="weigh-in-date" />
								</label>
							</fieldset>

							<!-- Weigh-In WEIGHT -->
							<fieldset class="text-input inline-label-input" id="weigh-in-weight-wrapper">
								<label>
									<span>Weight:</span>
									<input type="number" id="weigh-in-weight" min="144" max="180" value="165" step="0.2" />
								</label>
							</fieldset><!-- END div class="inline-label-input" -->

							<button type="submit" id="submit-new-data">add new data</button>

						</form><!-- END form  id="new-data" -->
					</div><!-- END div id="new-data-wrapper" -->


					<!-- LOAD DATA (filters) -->
					<div id="load-data-wrapper">
						<fieldset class="text-input inline-label-input" id="set-date-range">
							<legend>Set Date Range</legend>

							<fieldset class="checkbox">
								<label><input type="checkbox" id="show-all"  /><span>Show all</span></label>
								<p class="hint">(deselect to specify date range)</p>
							</fieldset>

							<fieldset class="text-input inline-label-input">
								<label>
									<span>From:</span>
									<input type="date" id="date-start" class="datepicker" />
								</label>
							</fieldset>
							<fieldset class="text-input inline-label-input">
								<label>
									<span>To:</span>
									<input type="date" id="date-end" class="datepicker" />
								</label>
							</fieldset>

						</fieldset><!--	END set-date-range	-->

						<button type="submit" id="data-loader">show data</button>
					</div><!-- END div id="show-data-wrapper" -->
				</div><!-- END id="input-wrapper" -->


				<!-- OUTPUT; eventually, a line graph? -->	
				<div id="output-wrapper">

					<table id="user-metadata"><!--	this should be the def list	-->
					   <colgroup>
						  <col />
						  <col />
						  <col />
					   </colgroup>
						<thead>
							<tr>
								<th id="user-display-metadata" colspan="4"></th>
							</tr>
							<tr>
								<th># of Weigh-Ins:</th>
								<th>Low Weight:</th>
								<th>Peak Weight:</th>
								<th>Goal Weight:</th>
							</tr>
						</thead>
						<tbody id="metadata-rows">
							<tr>
								<td id="weigh-in-count"></td>
								<td id="weight-low"></td>
								<td id="weight-high"></td>
								<td id="weight-goal"></td>
							</tr>
						</tbody>			
					</table><!-- END table id="user-metadata" -->


					<table id="weigh-in-data">
					   <colgroup>
						  <col />
						  <col />
					   </colgroup>
						<thead>
							<tr>
								<th id="user-display-weigh-in-data" colspan="3"></th>
							</tr>
							<tr>
								<th>id:</th>
								<th>DATE:</th>
								<th>WEIGHT:</th>
							</tr>
						</thead>
						<tbody id="data-rows">
							<tr>
								<td class="id"></td>
								<td class="date"></td>
								<td class="value"></td>
							</tr>
						</tbody>			
					</table><!-- END table id="weigh-in-data" -->


				</div><!-- END div id="output-wrapper" -->
			</div><!--	END div id="flexbox"	-->
	</div><!-- END div id="app" -->

	<!-- ======================================================================================================================== -->

	<script>

		window.onload = function(){

			// LOAD DATA: 'Show All data' checked, Date Range inputs disabled
			// if GLOBAL variables are bad, what about some of these which are used by more than one function?
			var userSelector = document.getElementById("select-user");
			userSelector.onchange = function(){
				selUser = this.value;
			}
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
					dateRangeFieldset.className = "text-input inline-label-input";
					dateStart.focus();
				}
				else {
					dateStart.disabled = true;
					dateEnd.disabled = true;
					dateRangeFieldset.className = "text-input inline-label-input disabled";
				}
			} // showAll.onclick

			
			// ============ DATA LOADER BUTTON ============
			var dataLoader = document.getElementById('data-loader');
			dataLoader.addEventListener('click', function(e){
				if (typeof selUser === 'undefined') {
					alert("no user selected");
				}
				else {
					getWeighInData(urlData, selUser);
					getUserData(urlUser, selUser);
				}
				e.preventDefault();
			},
			false); // dataLoader.addEventListener

var urlData = "process_LOAD_data.php";
var urlUser = "json/user_data.json";

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


			// LOAD DATA fn 1: get Weigh-In data
			function getWeighInData(urlData, selUser){
				var limit = 15; // the query using the limit is commented out in process_LOAD_data.php
				var queryString = "?selUser=" + selUser + "&limit=" + limit;
				var request = ajaxReq();
				
				request.open("GET", "process_LOAD_data.php" + queryString, true);
				request.setRequestHeader("content-type", "application/json");
				request.onreadystatechange = function() {
					if (request.readyState === 4 && request.status === 200) {
						processResponse(request.responseText); // call processResponse fn
					} // if readyState/status
				} // onreadystatechange
				request.send("user="+selUser+"&limit=3"); // ? guessing these are only seen by php $_POST

				function processResponse(response){
					var myObj = JSON.parse(response); // convert string to object
					var weighInData = myObj["WEIGH-INS"]; // case-sensitive
					var weights = []; // re: weigh-in count and calculating highest/lowest

					var userDisplayEl1 = document.getElementById("user-display-weigh-in-data");
					var weighInCountEl = document.getElementById("weigh-in-count");
					var weightLowEl = document.getElementById("weight-low");
					var weightHighEl = document.getElementById("weight-high");
					var weightgoalEl = document.getElementById("weight-goal");

					var dataRows = document.getElementById("data-rows");

					userDisplayEl1.innerHTML = "";
					weighInCountEl.innerHTML = "";
					weightLowEl.innerHTML = "";
					weightHighEl.innerHTML = "";
					weightgoalEl.innerHTML = "";
					dataRows.innerHTML = "";

					for (var obj in weighInData) {
						if (weighInData[obj].user === selUser) { // ***
							// v1
							// var weights = JSON.parse("[" + weighInData[obj].weight + "]"); // convert to object
							// arr.push(weights);
							weights.push(weighInData[obj].weight);

							var row = "<tr>" +
											"<td class=\"id\">" + weighInData[obj].id + "</td>" +
											"<td class=\"date\">" + weighInData[obj].date + " </td>" +
											"<td class=\"value\">" + weighInData[obj].weight + "</td>" +
										"</tr>";
							console.log(weights);
							dataRows.innerHTML += row;


						} // if ... === selUser
					} // for var obj in weighInData

var table =  $('#weigh-in-data');

for (var i=0; i<10; i++) {
	var $newRows = $(row);
	table.append($newRows);
}

// after table is populated, initiate plug-in
$('#weigh-in-data').DataTable(
	{
		"destroy": true,
		"lengthMenu": [[3, 6, 9, -1], [3, 6, 9, "All"]], // [rows displayed, rows displayed, rows displayed], [select>option text]
		"pagingType": "simple_numbers" // "full_numbers"
	}
);


					var weighInCount = weights.length;
					var weightLowest = Math.min.apply(null, weights);
					var weightHighest = Math.max.apply(null, weights);

					userDisplayEl1.innerHTML = weighInData[obj].user + "'s weigh-ins:";
					weightLowEl.innerHTML += weightLowest;
					weightHighEl.innerHTML += weightHighest;
					weighInCountEl.innerHTML = weighInCount;
				} // processResponse
			} // getWeighInData


			// LOAD DATA fn 2: get User (meta) data
			function getUserData(urlUser, selUser){
				var request = ajaxReq();
				request.open("GET", urlUser, true);
				request.setRequestHeader("content-type", "application/json");
				request.onreadystatechange = function() {
					if (request.readyState === 4 && request.status === 200) {
						showUserData(request.responseText);
					} // if readyState/status
				} // onreadystatechange
				request.send(null);

				function showUserData(response) {
					var userDataObj = JSON.parse(response);
					console.log(userDataObj);
					var userDisplayEl2 = document.getElementById("user-display-metadata");
					var usersArray = userDataObj.Users;
					for (var obj in usersArray) {
						if (usersArray[obj].userName === selUser) {
							var user = usersArray[obj].userName;
							var goalWeight = usersArray[obj]["goal weight"];

							userDisplayEl2.innerHTML = user + "'s metadata:";
							document.getElementById("weight-goal").innerHTML = goalWeight;
						}
					}
				} // showUserData
			} // getUserData



			// ========================================================================================================================
			// NEW DATA: useCurrentDate checked, #weigh-in-date disabled
			var useCurrentDate = document.getElementById("date-use-current");
			var newDate = document.getElementById('weigh-in-date');
			var weighInDateFieldset = document.getElementById('weigh-in-date-wrapper');
			useCurrentDate.checked = true;
			weighInDateFieldset.className = "text-input inline-label-input disabled";
			newDate.disabled = true;
			var weightInput = document.getElementById("weigh-in-weight");

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
					weighInDateFieldset.className = "text-input inline-label-input";
					newDate.disabled = false;
					newDate.focus();
					newDate.value = "(pop up datepicker on focus?)";
				}
				else newDate.value = today;
			} // useCurrentDate.onclick


			// NEW DATA: submit button event listener
			var submitData = document.getElementById('submit-new-data');
			submitData.addEventListener('click', function(e){
				if (typeof selUser === 'undefined') {
					alert("no user selected");
				}
				else {
					ajaxPost();
					getWeighInData(urlData, selUser);
					getUserData(urlUser, selUser);
				}
				e.preventDefault();
				},
				false);

			// NEW DATA: AJAX POST
			function ajaxPost(){
				var request = ajaxReq();
				// Date
				if (useCurrentDate.checked) {
					var newDateVal = today;
					console.log("newDateVal: " + newDateVal);
				}
				else {
					var newDateVal = newDate.value;
					console.log("newDateVal: " + newDateVal);
				}
				// Weight
				if (!weightInput.value) {
					alert("OOPS! a weight selection is required");
					weightInput.focus();
				}
				else {
					var newWeightVal = weightInput.value;
					console.log("newWeightVal: " + newWeightVal);
				}
				var newWeighInData = { "user" : selUser, "date" : newDateVal, "weight" : newWeightVal }; // [ object Object ]
				var newWeighInData = JSON.stringify(newWeighInData); // convert OBJECT to STRING (but I've read not to)
				console.log("newWeighInData is: " + newWeighInData);

				request.onreadystatechange = function() {
					if (request.readyState === 4 && request.status === 200) {
						var responseText = request.responseText;
						var dtTag = "<dt class=\"date\">" + responseText + ": </dt>";
						var ddTag = "<dd class=\"value\">" + responseText + "</dd>";
					} // if readyState/status
				} // onreadystatechange
				request.open('POST', "process_INSERT_data.php", true); // MySQL
				request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				request.send("newWeighInData=" + newWeighInData);
			} // ajaxPost
		} // window.onload

/*
What benefit, if any, in using a constructor? And how to implement?

function weighInData(user, date, weight) {
	this.user	= selUser;
	this.date	= newDateVal;
	this.weight	= newWeightVal;
}
*/
				//var newData = "date= "+ encodeURIComponent(newDateVal) + " & weight= "+ encodeURIComponent(newWeightVal);

	</script>

	<script>
		$(function() {
			$(".datepicker").datepicker();
		});
	</script>

	<script>
		$(document).ready(function() {
		});

	</script>

</body>
</html>


