<?php

    require_once "api.php";
    $api = new Api();

    if (count($argv)<4) {
        die("Insufficient parameters number. ");
    }

    if ($argv[1] != 'redis') {
        die("Invalid parameters. Parameter 1 must be redis.");
    }

    if ($argv[2] == 'add') {
        if (count($argv)<5) {
            die("Insufficient parameters number.");
        }
        die($api->cli_add_key($argv[3], $argv[4]));
    } else if ($argv[2] == 'delete') {
        die($api->cli_delete_key($argv[3]));
    } else {
        die("Invalid parameters. Parameter 2 must be 'add' or 'delete'.");
    }
