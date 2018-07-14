<?php
$dir = 'tests/';
$files = scandir($dir);
$counts=count($files);
$num=$counts-1;
$newFilename="tests/$num.json";
if (!empty ($_FILES) && array_key_exists('ourfile', $_FILES)) {
    move_uploaded_file($_FILES['ourfile']['tmp_name'], $newFilename);
    header("Location: http://university.netology.ru/u/lgolovina/header/list.php");
    exit;
}
?>