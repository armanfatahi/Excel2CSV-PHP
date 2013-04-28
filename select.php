<!DOCTYPE html>
<?php session_start();?>
<html lang="en" >
    <head>
        <meta charset="utf-8" />
        <title>Assignment - Real Telekom</title>
        <link href="css/main.css" rel="stylesheet" type="text/css" />
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script>
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

		function UpdateSidebar() {
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
		</script>
		
    </head>
<body>
	<form enctype="multipart/form-data" action="download.php" method="POST">
	<div id="header">
		<h1><p>Real Telekom - Programming Assignment</p></h1>
	</div>
	<div class="colmask threecol">
		<div class="colmid">
			<div class="colleft">
				<div class="col1">
					<!-- Column 1 start -->
					<?php
					if ($_POST['step'] == 1)  //Step 1
					{
						// Where the file is going to be placed 
						$target_path = "uploads/";
						/* Add the original filename to our target path.  
						Result is "uploads/filename.extension" */
						$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
						if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
							require_once 'PHPExcel/IOFactory.php';
							$excelFile = "uploads/" . basename( $_FILES['uploadedfile']['name']);
							$objReader = PHPExcel_IOFactory::createReader('Excel2007');
							$objPHPExcel = $objReader->load($excelFile);
							$objPHPExcel = PHPExcel_IOFactory::load($excelFile);
							$objWorksheet = $objPHPExcel->getActiveSheet();
							$highestRow = $objWorksheet->getHighestRow(); 
							$highestColumn = $objWorksheet->getHighestColumn(); 
							$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); 
							$excelArray = array();
							for ($row = 1; $row <= $highestRow; ++$row) {
								$excelRow = array();
								for ($col = 0; $col <= $highestColumnIndex; ++$col) {
									$value = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
									if($value>1000){
										$value = PHPExcel_Style_NumberFormat::toFormattedString($value, "DD/MM/YYYY");
									}
									$excelRow[] = $value;
								}
								$excelArray[] = $excelRow; 
							}
							$ss = "<h3> Please select the header row (the row which contains titles). </h3> <br /><div class=\"tablecanvas\"><table id=\"fileInfo\" class=\"hovertable\" border='1'>"; // 
							//echo $data->sheets[0]['numCols'];
							$counter = 1;
							for ($j = 0; $j <= count($excelArray)-1; $j++)
							{
								$ss .= "<tr onmouseover=\"this.style.backgroundColor='#ffff66';\" title='".$counter."' onmouseout=\"this.style.backgroundColor='#d4e3e5';\" onclick=\"SelectColumns(this)\" >";
								$ss .= "<td><h3> <a> Select </a> </h3></button> </td>";
								for ($k = 0; $k <= count($excelArray[$j])-2; $k++)		
								{
									$ss .= "<td>";
									$ss .= $excelArray[$j][$k];
									$ss .= "</td>";
								}		
								$ss .= "</tr>";
								$counter +=1;
							}
							$ss .= "</table></div>";
							$s = "<p id='filePara' >" . $ss . "</p>";
							echo $s;
							$_SESSION['csvFile'] = $excelArray;

							echo <<<EOF
							<p id='results' > </p>
							<br />
							<h3>Please select the column which indicates:</h3><br />
							<div class="tablecanvas">
								<table>
									<tr>
										<td><p>Dial code(Number):</p></td>
										<td><p>Destination names(Text):</p></td>
										<td><p>Rate(0.0000):</p></td>
										<td><p>Effective date(dd/mm/yyyy):</p></td>
									</tr>
									<tr>
										<td><p id="DialCode"></p></td>
										<td><p id="DestNames"></p></td>
										<td><p id="Rate"></p></td>
										<td><p id="Date"></p></td>
									</tr>
								</table>
							</div>
							<br />
							<p id = 'StepTwoMessage'></p>
							
EOF;
						} else{
							echo "There was an error uploading the file, please try again!";
						}
					}
					?>
					<!-- Column 1 end -->
				</div>
				<div class="col2">
					<!-- Column 2 start -->
					<h2>Welcome to Excel to CSV file converter</h2><br />
					<h3>Steps:</h3><h4>
					<ul>
					  <li>1- Select an excel file (.xls or .xlsx formats only).</font></li>
					  <li>2- Upload your file (if your file is a valid excel file, upload button will appear).</li>
					  <li>3- If upload is successful you will see the file content.</li>
					  <li><font color="#000000">4- Please select the row which contains data headers.</font></li>
					  <li><font color="#000000">5- In the next table below the file contents, select the columns which indicate Dial Code, Destination names, Rate, and Effective date.</font></li>
					  <li><font color="#000000">6- Press 'Next' button to see the generated CSV file and the download link. </font></li>
					  <li>7- Right click on the link and select "Save the link as ..."</li>
					</ul><button onclick='window.location = "index.php";'>Go back to the first page.</button></h4>
					
					<!-- Column 2 end -->
				</div>
				<div class="col3">
					<!-- Column 3 start -->
					<p id ='selectedRow'></p><br />
					<p id ='selectedCol'></p><br />
					<!-- Column 3 end -->
				</div>
			</div>
		</div>
	</div>
	<div id="footer">
		<p></p>
	</div>
	</form>
</body>
</html>