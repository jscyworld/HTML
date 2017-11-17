<!DOCTYPE html>
<html lang="en">
	<head>
		<title>SQL</title>
	</head>
	<body>
		<form action="sql.php" method="POST">
			<div id="sql">
				DB name: <input type="text" name="name" />
				DB query: <input type="text" name="query" />
				<input type="submit" value="submit" />
			</div>
		</form>


		<?php
			$dbname = $_POST["name"];
			try {
				$db = new PDO("mysql:host=localhost;dbname=$dbname;charset=utf8", "root", "root");
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $ex) {
		?>	<p>	<?=$ex->getMessage()?> </p>
		<ul>
		<?php
			}
			$results = $db->query($_POST["query"]);
           	foreach ($results as $col => $row) {
                $count = 1;
        ?>
                <li>
        <?php
                foreach($row as $cname => $value){
                    if ($count % 2 == 1) {
                        if ($count == 1) {
	    ?>                      
                            <?= $value ?>
        <?php
                        } else {
        ?>                      
                             <?= $value ?> 
        <?php
                        }
                    }
                    $colcount++;

                }
        ?>
                </li>
        <?php
            }
    	?> 
		</ul>
		<?php
			$db = null;
		?>
	</body>
</html>

