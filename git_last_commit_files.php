#! /usr/bin/php

<?php
exec('git show --stat --oneline HEAD --pretty="format:"', $output, $return_var);

$path = [];

for ($i=0; $i < sizeof($output); $i++) {
    if (strpos($output[$i], 'webroot.ad/')) {
        $url = explode(" ",$output[$i])[1];
        $url = str_replace('webroot.ad', '', $url);
        echo $url;
        echo "\n";
        array_push($path, $url);
        echo "\n";
    }
}

print_r($path);
echo "\n";
echo $return_var;
echo "\n";
?>
