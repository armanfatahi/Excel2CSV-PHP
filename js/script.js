
function myfunction(row) {
	var para = document.getElementById("results");
	var resTable = "<table border = '3px'><tr>";
	for (var j = 1, col; col = row.cells[j]; j++) {
		if(col.innerHTML!="")
			{
			resTable += "<td>" + col.innerHTML + "</td>";
			}
   }
   resTable +=  "</tr></table>";
   para.innerHTML = resTable;
   
}

function UpdateSidebar()
{
	var selectedCol = document.getElementById("selectedCol");
	
	var DialCode = document.getElementById("DialCodeSelect");
	var DestNames = document.getElementById("DestNamesSelect");
	var Rate = document.getElementById("RateSelect");
	var Date = document.getElementById("DateSelect");			
			
	var selectedColTable = "<h3>Selected columns:</h3><table>";
	
	for (var i = 0; i  < DialCode.options.length; i++) {
	   if(DialCode.options[i].selected ) {
			selectedColTable += "<tr><td><h4>Dial code(Number): </h4></td><td><h5> "+DialCode.options[i].value+"</h5> <input name='DialCodeCol' type='number' style='display: none' value ='"+DialCode.options[i].title+"'/></td></tr>";
	   }
	}
	
	for (var i = 0; i  < DestNames.options.length; i++) {
	   if(DestNames.options[i].selected ) {
			selectedColTable += "<tr><td><h4>Destination names(Text): </h4></td><td><h5>"+DestNames.options[i].value+"</h5> <input name='DestNamesCol' type='number' style='display: none' value ='"+DestNames.options[i].title+"'/></td></tr>";
	   }
   }
   
   for (var i = 0; i  < Rate.options.length; i++) {
	   if(Rate.options[i].selected ) {
			selectedColTable  +=  "<tr><td><h4>Rate(0.0000): </h4></td><td><h5> "+Rate.options[i].value+"</h5> <input name='RateCol' type='number' style='display: none' value ='"+Rate.options[i].title+"'/></td></tr>";
	   }
   }
   
   for (var i = 0; i  < Date.options.length; i++) {
	   if(Date.options[i].selected ) {
			 selectedColTable += "<tr><td><h4>Effective date(dd/mm/yyyy): </h4></td><td><h5> "+Date.options[i].value+"</h5> <input name='DateCol' type='number' style='display: none' value ='"+Date.options[i].title+"'/></td></tr>";
	   }
   }
   selectedCol.innerHTML = selectedColTable + "</table>";
   
	output = document.getElementById('StepTwoMessage');
	output.innerHTML = "<input name='step' type='number' style='display: none' value ='2'/><h4> Please select the column headers and press Next to see the results.</h4><br /><input type='submit' value='Next...' />";
}
function SelectColumns(row) {
	//myfunction(row);
	row.style.backgroundColor='#aaaaaa';
	var selectedRowLabel = document.getElementById("selectedRow");
	var DialCode = document.getElementById("DialCode");
	var DestNames = document.getElementById("DestNames");
	var Rate = document.getElementById("Rate");
	var Date = document.getElementById("Date");
	
	var DialCodeHeader = "<select onchange=\"UpdateSidebar()\" name=\"myselect\" id=\"DialCodeSelect\" size=\"0\" name=\"mydropdown\">";
	var DestNamesHeader = "<select onchange=\"UpdateSidebar()\" name=\"myselect\" id=\"DestNamesSelect\" size=\"0\" name=\"mydropdown\">";
	var RateHeader = "<select onchange=\"UpdateSidebar()\" name=\"myselect\" id=\"RateSelect\" size=\"0\" name=\"mydropdown\">";
	var DateHeader = "<select onchange=\"UpdateSidebar()\" name=\"myselect\" id=\"DateSelect\" size=\"0\" name=\"mydropdown\">";
	var SelectBody = "";
	
	var selectedRowTable = "<h3>Selected Headers:</h3><br /><table><tr>";
	
	var RowCol = row.title;
	for (var j = 1, col; col = row.cells[j]; j++) {
		if(col.innerHTML!="")
		{
			SelectBody += "<option title='"+j+"' value='"+col.innerHTML+"'>"+col.innerHTML+"</option>";
			selectedRowTable += "<tr><td>";
			selectedRowTable += col.innerHTML;
			selectedRowTable += "</td></tr>";
		}
		else
		{
			selectedRowTable += "<tr><td>";
			selectedRowTable += "Temp Title "+j;
			SelectBody += "<option title='"+j+"' value='Temp Title "+j+"'>Temp Title "+j+"</option>";
			selectedRowTable += "</td></tr>";
		}
   }
   selectedRowTable += "</tr></table>";
   SelectBody +=  "</select>";
   
   selectedRowLabel.innerHTML = selectedRowTable;
   DialCode.innerHTML = DialCodeHeader + SelectBody;
   DestNames.innerHTML = DestNamesHeader + SelectBody;
   Rate.innerHTML = RateHeader + SelectBody;
   Date.innerHTML = DateHeader + SelectBody + "<input name='RowCol' type='number' style='display: none' value ='"+RowCol+"'/>";
   
}

function check_file(){
	output = document.getElementById('StepOneMessage');
	str=document.getElementById('uploadedfile').value.toUpperCase();
	filename = document.getElementById('uploadedfile').value;
	suffix=".XLS";
	suffix2=".XLSX";
	if(!(str.indexOf(suffix, str.length - suffix.length) !== -1||
				   str.indexOf(suffix2, str.length - suffix2.length) !== -1)){
	output.innerHTML = 'File type not allowed,\nAllowed file: *.xls,*.xlsx';
		document.getElementById('uploadedfile').value='';
	}
	else
	{
		output.innerHTML = "<h4>" + filename + " is selected.</h4><br /><input type='submit' value='Upload and Display...' />";
	}
}
		