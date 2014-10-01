// function processResponse, back up of defintion list output ... dt/dd
/*
	function processResponse(response){
		var myObj = JSON.parse(response); // convert string to object
		var weighInData = myObj["WEIGH-INS"]; // case-sensitive
		var dataRows = document.getElementById("data-rows");
		dataRows.innerHTML = "";

		for (var obj in weighInData) {
			if (weighInData[obj].user === selUser) {
				//var dtTag = "<dt class=\"date\"><span>Date: </span>" + weighInData[obj].date + " </dt>";
				//var ddTag = "<dd class=\"value\"><span>Weight: </span>" + weighInData[obj].weight + "</dd>";
				var row = "<tr>" +
								"<td class=\"date\">" + weighInData[obj].date + " </td>" +
								"<td class=\"value\">" + weighInData[obj].weight + "</td>" +
							"</tr>";
				var userDisplayEl = document.getElementById("user-display");
				userDisplayEl.innerHTML = weighInData[obj].user;
				//output.innerHTML += dtTag;
				//output.innerHTML += ddTag;
				output.innerHTML += row;
			} // if ... === selUser
		} // for var obj in weighInData
	} // processResponse
*/




/*
var userObj = null;    
for (var i = 0; i < array.length; i++) {
    if (array[i].name == selUser) {
        userObj = array[i];
        break;
    }
}
===
function search(selUser, userArr){
    for (var i=0, i < userArr.length; i++) {
        if (userArr[i].name === selUser) {
            return userArr[i];
        }
    }
}

var array = [
    { name:"string 1", value:"this", other: "that" },
    { name:"string 2", value:"this", other: "that" }
];

var resultObject = search("string 1", array);
*/


						else if (usersArray[user].userName === selUser) {
							//console.log(usersArray[user]["weigh-in data"]); // CRUCIAL
							var weighInData = usersArray[user]["weigh-in data"];

							for (var date in weighInData){
								//console.log("date: " + date + ", weight: " + weighInData[date]);
/*
								var dtTag = "<dt class=\"date\"><span>Date: </span>" + date + " </dt>";
								var ddTag = "<dd class=\"value\"><span>Weight: </span>" + weighInData[date] + "</dd>";
								output.innerHTML += dtTag;
								output.innerHTML += ddTag;
								*/
							}




						}
