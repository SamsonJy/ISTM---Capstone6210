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
function show(n) {
    document.getElementById("table1").style.display="none";
    document.getElementById("table2").style.display="none";
    document.getElementById("table3").style.display="none";
    document.getElementById("table" + t).style.display="block";
};

