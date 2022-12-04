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

function checkDate2() {
  var dateString3 = document.getElementById("startDate2").value;
  var dateString4 = document.getElementById("endDate2").value;
	var dateStart2 = new Date(dateString3).getTime();
  var dateEnd2 = new Date(dateString4).getTime();
  var startTime2 = $('#startTime2').timepicker('getTime');
  var endTime2 = $('#endTime2').timepicker('getTime');

	if (dateEnd2 < dateStart2) {
		alert("The end date cannot be earlier than the start date.");
		document.getElementById('endDate2').value = "";
		return false;
  }
  if(dateEnd2 == dateStart2) {
    if(endTime2 <= startTime2) {
      alert("The end time cannot be earlier than or equal to the start time.");
      document.getElementById('endTime2').value = "";
      return false;
    }
  }
	return true;
};

function extendFunction(){
  var form1 = document.getElementById("reservation_extend_form")
  if(form1.style.display=="none"){
    document.getElementById("reservation_extend_form").style.display="block";
   
  } else{
    document.getElementById("reservation_extend_form").style.display="none";
  }
}

