function storeTimeGarage() {
  var garage = document.getElementById("garageSelect").value;
	var dateString = document.getElementById("startTime").value;
	var dateString2 = document.getElementById("endTime").value;

	var DateStart = new Date(dateString);
	var DateEnd = new Date(dateString2);
	var startDate =  DateStart.toLocaleDateString();
	var startTime =  DateStart.toLocaleTimeString();
	var endDate =  DateEnd.toLocaleDateString();
	var endTime =  DateEnd.toLocaleTimeString();

  var startDateTime = startDate + " " + startTime;
  var endDateTime = endDate + " " + endTime;

	localStorage.setItem("garage", garage);
	localStorage.setItem("startDateTime", startDateTime);
	localStorage.setItem("endDateTime", endDateTime);


};

function checkDate() {
  var dateString1 = document.getElementById("startDate").value;
  var dateString2 = document.getElementById("endDate").value;
	var dateStart = new Date(dateString1).getTime();
  var dateEnd = new Date(dateString2).getTime();
  var startTime = $('#startTime').timepicker('getTime');
  var endTime = $('#endTime').timepicker('getTime');

	if (dateEnd < dateStart) {
		alert("The end date cannot be earlier than the start date.");
		document.getElementById('endDate').value = "";
		return false;
  }
  if(dateEnd == dateStart) {
    if(endTime <= startTime) {
      alert("The end time cannot be earlier than or equal to the start time.");
      document.getElementById('endTime').value = "";
      return false;
    }
  }
	return true;
};

