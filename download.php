<!DOCTYPE html>
<?php session_start();?>
<html lang="en" >
    <head>
        <meta charset="utf-8" />
        <title>Assignment - Real Telekom</title>
        <link href="css/main.css" rel="stylesheet" type="text/css" />
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery-ui.min.js"></script>		
    </head>
<body>
	<form enctype="multipart/form-data" action="index.php" method="POST">
	<div id="header">
		<h1><p>Real Telekom - Programming Assignment</p></h1>
	</div>
	<div class="colmask threecol">
		<div class="colmid">
			<div class="colleft">
				<div class="col1">
					<!-- Column 1 start -->
					 <?php
					if ($_POST['step'] == 2)  //Step 2
					{
						$_SESSION['RowCol'] = $_POST['RowCol'];
						$csvFile = $_SESSION['csvFile'];
						
						echo "<h3>Generated CSV file(please use following link to download the file):</h3><br /><br /><h4> <a target='_blank' href='information.csv'>Download CSV version</a> (right click and select \"save link as...\") </h4><br /><br /><table>";
						$fp = fopen('information.csv', 'w');
						$csvTable = "<table><tr><td>Dial code</td><td>Destination names</td><td>Rate</td><td>Effective date</td></tr>";
						$csvHeader = array();
						$csvHeader[] = "Dial code";
						$csvHeader[] = "Destination names";
						$csvHeader[] = "Rate";
						$csvHeader[] = "Effective date";
						fputcsv($fp, $csvHeader);
						for ($j = $_POST['RowCol']; $j < count($csvFile); $j++){
							$csvTable .= "<tr>";
							$csvTable .= "<td>".$csvFile[$j][$_POST['DialCodeCol']-1]."</td>";
							$csvTable .= "<td>".$csvFile[$j][$_POST['DestNamesCol']-1]."</td>";
							$csvTable .= "<td>".$csvFile[$j][$_POST['RateCol']-1]."</td>";
							$csvTable .= "<td>".$csvFile[$j][$_POST['DateCol']-1]."</td>";
							$csvTable .= "</tr>";
							$csvRow = array();
							$csvRow[] = $csvFile[$j][$_POST['DialCodeCol']-1];
							$csvRow[] = $csvFile[$j][$_POST['DestNamesCol']-1];
							$csvRow[] = $csvFile[$j][$_POST['RateCol']-1];
							$csvRow[] = $csvFile[$j][$_POST['DateCol']-1];
							fputcsv($fp, $csvRow);
						}
						$csvTable .= "</table>";
						echo $csvTable;
						fclose($fp);
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
					  <li>4- Please select the row which contains data headers.</li>
					  <li>5- In the next table below the file contents, select the columns which indicate Dial Code, Destination names, Rate, and Effective date.</li>
					  <li>6- Press 'Next' button to see the generated CSV file and the download link. </li>
					  <li><font color="#000000">7- Right click on the link and select "Save the link as ..."</font></li>
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