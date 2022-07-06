<?php

$conn = pg_connect('host=localhost port=5432 dbname=php_poo user=postgres password=PIERRE');

$query = 'SELECT codigo, nome FROM famosos';

$result = pg_query($conn, $query);

if($result){
    while ($row = pg_fetch_assoc($result)) {
        print $row['codigo'] . ' - ' . $row['nome'] . '<br>';
    }
}

pg_close($conn);