#!/usr/bin/php

<?php

$error = false;
$path = "";

$path_array = ['/ypa/gameprice.js'];
$cli = "";
$load_balance = '';
$project_name = '';

for ($i=0; $i < sizeof($path_array); $i++) {
    $cli = $cli .
            "\n" .
            "gcloud compute url-maps invalidate-cdn-cache " . $load_balance .  " --path=" . $path_array[$i];
    echo $cli;
    echo "\n";
}

exec("gcloud config list | grep 'sitemaji'", $output, $return_var);

if (!empty($output))
{
    foreach ($output as $res) {
        echo $res;
        echo "\n";
        $sitemaji = strpos($res, 'sitemaji');
        echo "\n";
    }
}

if ($sitemaji) {
    echo 1;
    exec($cli, $output_1, $return_var);
    res($output_1);
} else {
    echo 0;
    exec("gcloud config set project sitemaji", $output, $return_var);
    if (!empty($output))
    {
        exec($cli, $output_0, $return_var);
        res($output_0);
    }
}

function res($output='')
{
    if (!empty($output))
    {
        foreach ($output as $res) {
            echo $res;
            echo "\n";
        }
    }
}

?>
