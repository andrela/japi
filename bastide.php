<?php
$conn_string = "host=localhost port=5432 dbname=bastide user=andre password=loboG69";
$dbconn = pg_pconnect($conn_string);

if (!$dbconn) {
    echo "An error occured.\n";
    exit;
}
?>
