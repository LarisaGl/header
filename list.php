<!DOCTYPE html>
<html>
<head>
  <title>LIST</title>
  <meta charset="UTF-8">
</head>

<body>
<h1>Выберите тест:</h1>

<?php

$dir = 'tests/';
$files = scandir($dir);
unset($files[0]);
unset($files[1]);
foreach ($files as $key => $value) {
	echo "<a href=\"test.php?test=$value\">$value</a><br>";
}
?>

</body>
</html>