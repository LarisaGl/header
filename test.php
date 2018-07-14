<?php
$filename=$_GET['test'];

if (!file_exists("tests/$filename")) {
	header('HTTP/1.0 404 Not Found');
}

$json = file_get_contents("tests/$filename");
$decode = json_decode($json, true);

if (isset($_POST['result'])) {
	$i=0;
	foreach ($decode as $key => $value) {
		if ($value['right_answer']==$_POST[$key]) {
		$i++;
		}
	}

	$res=$_POST['username'].", правильных ответов: $i";
	$image=imagecreatetruecolor(794, 598);
	$back=imagecolorallocate($image, 245, 118, 221);
	$textcolor=imagecolorallocate($image, 255, 255, 255);

	$mainimg=__DIR__.'/deadpool.png';
	if (!file_exists($mainimg)) {
		echo $res;
		exit;
	}

	$sert=imagecreatefrompng($mainimg);
	imagefill($image, 0, 0, $back);
	imagecopy($image, $sert, 0, 0, 0, 0, 794, 598);

	$font=__DIR__.'/festus.ttf';
    if (!file_exists($font)) {
		echo $res;
		exit;
	}

	imagettftext($image, 50, 10, 50, 550, $textcolor, $font, $res);
	header('Content-Type: image/png');
	imagepng($image);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>TEST</title>
  <meta charset="UTF-8">
</head>

<body>
<form action="" method="POST">
    <input type="text" value="Введите Ваше имя" name="username"> 	
    <?php
        foreach ($decode as $num => $quest) { ?>
	<fieldset>
        <legend><?php echo $quest['ask']; ?></legend>
        <?php
            foreach ($quest['answer'] as $var_ans => $ans) {?>
        <label><input type="radio" name="<?php echo $num?>" value="<?php echo $var_ans;?>"><?php echo $ans; ?></label>
    <?php } ?>
    </fieldset>
    <?php } ?>
	<input type="submit" value="Узнать результат" name="result">  
</form>

</body>
</html>