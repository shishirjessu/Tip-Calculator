<!DOCTYPE html>
<html>
	<head>
		<title>Tip Calculator</title>
		<link href = "tip_calc.css" type="text/css" rel="stylesheet" />
	</head>
	<body>

		<h1>Tip Calculator</h1>

		<?php

		$total = $amount = "";
		$canDisplay = false;

		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$canDisplay = true;
			if (empty($_POST["subtotal"]) || !is_numeric($_POST["subtotal"]) || $_POST["subtotal"] < 0)
			{
				echo "Subtotal must be a number greater than 0 <br>";
				$canDisplay = false;
			}

			$total = $_POST["subtotal"];
			
			if (empty($_POST["tip_percentage"]))
			{
				$canDisplay = false;
				echo "No tip amount selected<br>";
			}
			else
				$amount = $_POST["tip_percentage"];
		}

		?>

		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			Bill Subtotal: $ <input type="text" name="subtotal" = value="<?php echo $total; ?>">
			<p>Tip percentage:</p>
			

			<?php
			for ($i = 10; $i <= 20; $i += 5) {
			?>
				<input type="radio" name="tip_percentage" value="<?php echo $i; ?>"
				<?php if(isset($_POST['tip_percentage']) && $_POST["tip_percentage"] == $i)  echo ' checked="checked"';?>>
				<?php echo ($i . "%"); ?>
			<?php	
			}
			?>
			<br><br>
			Submit <input type="submit" name="submit">
			<br><br>
		</form>

		<?php



		if ($canDisplay)
		{
			$amount = $amount / 100;
			$tip = number_format($total * $amount, 2, '.', '');
			echo "Tip: $" . $tip . "<br>";
			echo "Total bill: $" . number_format($total + $tip, 2, '.', '');
		}
			
		?>


	</body>
</html>