<?php
/*
Template Name: XML Output file
*/

$my_var = file_get_contents('http://multisite-dev/xml-test/xml-output-text/');

echo $my_var;