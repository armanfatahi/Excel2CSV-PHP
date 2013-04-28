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
		</script>
    </head>
<body>
<form enctype="multipart/form-data" action="select.php" method="POST">
<div id="header">
	<h1><p>Real Telekom - Programming Assignment</p></h1>
</div>
<div class="colmask threecol">
	<div class="colmid">
		<div class="colleft">
			<div class="col1">
				<!-- Column 1 start -->
				 <?php
					$contents = "Choose a file to upload:";
					$contents .= "<input onchange ='check_file()' id='uploadedfile' name='uploadedfile' type='file' /><br />";
					$contents .= "<input name='step' type='number' style='display: none' value ='1'/>";//$contents .= "<input type='submit' value='Upload File' />";
					$contents .= "<p id = 'StepOneMessage'></p>";
					echo $contents;
				?>
				<!-- Column 1 end -->
			</div>
			<div class="col2">
				<!-- Column 2 start -->
				<h2>Welcome to Excel to CSV file converter</h2><br />
				<h3>Steps:</h3><h4>
				<ul>
				  <li><font color="#000000">1- Select an excel file (.xls or .xlsx formats only).</font></li>
				  <li><font color="#000000">2- Upload your file (if your file is a valid excel file, upload button will appear).</font></li>
				  <li><font color="#000000">3- If upload is successful you will see the file content.</font></li>
				  <li>4- Please select the row which contains data headers.</li>
				  <li>5- In the next table below the file contents, select the columns which indicate Dial Code, Destination names, Rate, and Effective date.</li>
				  <li>6- Press 'Next' button to see the generated CSV file and the download link. </li>
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