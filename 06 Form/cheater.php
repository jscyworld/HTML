<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Grade Store</title>
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/labResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<?php
		# Ex 4 : 
		# Check the existance of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)
		if (!isset($_POST["name"])&&$_POST["name"]==""||!isset($_POST["ID"])&&$_POST["ID"]==""||!isset($_POST["course"])&&$_POST["course"]==""||!isset($_POST["card_num"])&&$_POST["card_num"]==""||!isset($_POST["cc"])&&$_POST["cc"]=="") {

		?>

<!-- 		 Ex 4 : 
			Display the below error message :  -->
			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. <a href="gradestore.html">Try again?</a></p>
		 

		<?php
		# Ex 5 : 
		# Check if the name is composed of alphabets, dash(-), ora single white space.
		} elseif (!preg_match("/^[a-zA-Z]+(\s[a-zA-Z])*/", $_POST["name"])) { 
		?>

<!-- 		 Ex 5 : 
			Display the below error message :  -->
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. <a href="gradestore.html">Try again?</a></p>
		 

		<?php
		# Ex 5 : 
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5. 
		} elseif (
			(preg_match('/^[4]{1}[0-9]{15}$/', $_POST["card_num"])&&$_POST["cc"]!="visa") ||
			(preg_match('/^[5]{1}[0-9]{15}$/', $_POST["card_num"])&&$_POST["cc"]!="mastercard")) {
		?>

<!-- 		 Ex 5 : 
			Display the below error message :  -->
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. <a href="gradestore.html">Try again?</a></p>
		 

		<?php
		# if all the validation and check are passed 
		} else {
		?>

		<h1>Thanks, looser!</h1>
		<p>Your information has been recorded.</p>
		
		<!-- Ex 2: display submitted data -->
		<ul> 
			<li>Name: <?= $_POST["name"] ?></li>
			<li>ID: <?= $_POST["ID"] ?></li>
			<!-- use the 'processCheckbox' function to display selected courses -->
			<li>Course: <?= processCheckbox($_POST["course"]) ?></li>
			<li>Grade: <?php if ($_POST["grade"] != "") {$submitted_grade = $_POST["grade"];}?> <?= $submitted_grade ?> </li>
			<li>Credit <?= $_POST["card_num"] ?> 
				<?php if (($_POST["cc"]=="visa"||($_POST["cc"])=="mastercard")) {
					$submitted_cc = $_POST["cc"];}?> (<?= $submitted_cc ?>)</li>
		</ul>
		
		<!-- Ex 3 :  -->
			<p>Here are all the loosers who have submitted here:</p>
		<?php
			$filename = "loosers.txt";
			$filedata = file_get_contents($filename);
			$rawdata = array($_POST["name"], $_POST["ID"], $_POST["card_num"], $_POST["cc"]);
			$info = implode('; ', $rawdata);

			if (filesize($filename)==0)
				file_put_contents($filename, $info);
			else
				file_put_contents($filename, $filedata.PHP_EOL.$info);
			/* Ex 3: 
			 * Save the submitted data to the file 'loosers.txt' in the format of : "name;id;cardnumber;cardtype".
			 * For example, "Scott Lee;20110115238;4300523877775238;visa"
			 */
		?>
		
		<!-- Ex 3: Show the complete contents of "loosers.txt".
			 Place the file contents into an HTML <pre> element to preserve whitespace -->
		<pre>
<?php
	print file_get_contents($filename);
?>
		</pre>

		<?php
	}
			/* Ex 2: 
			 * Assume that the argument to this function is array of names for the checkboxes ("cse326", "cse107", "cse603", "cin870")
			 * 
			 * The function checks whether the checkbox is selected or not and 
			 * collects all the selected checkboxes into a single string with comma seperation.
			 * For example, "cse326, cse603, cin870"
			 */

			function processCheckbox($names) { 
				$result = implode(', ', $names);
				return $result;
			}
		

		?>
		
	</body>
</html>
