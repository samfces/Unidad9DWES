<?php 

	$basket = array();
	$html = '';
	$totalprice = 0;
	$exists = 0;

	if(isset($_GET['empty'])) {
		unset($_COOKIE['basket']);
		$html .= 'The basket is empty';
	}

	if(isset($_COOKIE['empty'])) {
		$basket = unserialize($_COOKIE['empty']);
	}

	if(isset($_GET['name']) && isset($_GET['price'])) {
		for($i = 0; $i< sizeof($basket); $i++) {
			if($basket[$i]['name'] == $_GET['name']) {
				$basket[$i]['amount'] = $basket[$i]['amount'] + 1;
				$exists = 1;
			}
		}

		if($exists == 0) {
			$lastPos = count($basket);
			$basket[$lastPos]['name'] = $_GET['name'];
			$basket[$lastPos]['price'] = $_GET['price'];
			$basket[$lastPos]['amount'] = $_POST['amount'];
		}
	}

	$time = time() + (60 * 60);
	setcookie('basket', serialize($basket), $time);

	$html .= '<table>';
	$html .= 	'<tr>
					<td>
						<b>Name</b>
					</td>
					<td>
						<b>Price</b>
					</td>
					<td>
						<b>Amount</b>
					</td>
				</tr>';

	foreach ($basket as $k => $v) {
		$html .= '<tr>';
		$html .= '<td>' . $v['name'] . '</td><td>' . $k['price']*$v['amount'] . '</t><td>' . $v['amount'] . '</td>';
		$html .= '</tr>';
	}
	$html .= '</table>';
?>

<!DOCTYPE html>
<html lang="es-ES">
	<head>
		<meta charset="UTF-8">
		<title>PC Shop || Basket</title>
	</head>
	<body>
		<div>
			<?php echo $html; ?>
		</div>
		<br>
		<a href="../basket/basket.php?empty=1">
			Empty Basket
		</a>
		<br>
		<a href="../index.php">
			Back to Menu
		</a>
	</body>
</html>