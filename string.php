<?php
$file1 = fopen("testing.txt","w");
fputs($file1,"Welcome to the Digital World");
$file=fopen("testing.txt","r");
while(!feof($file)){
$x=fgetc($file);
echo $x;
}
?>