<?php

$conn = pg_connect('host=localhost port=5432 dbname=php_poo user=postgres password=PIERRE');

// pg_query($conn, "INSERT INTO famosos (codigo, nome) VALUES (1, 'Érico Veríssimo')");
// pg_query($conn, "INSERT INTO famosos (codigo, nome) VALUES (2, 'Paulo Coelho')");
// pg_query($conn, "INSERT INTO famosos (codigo, nome) VALUES (3, 'João das Neves')");
// pg_query($conn, "INSERT INTO famosos (codigo, nome) VALUES (4, 'JJ Rouling')");
// pg_query($conn, "INSERT INTO famosos (codigo, nome) VALUES (5, 'Eduardo Blakk')");
// pg_query($conn, "INSERT INTO famosos (codigo, nome) VALUES (6, 'Stuart Antony')");
// pg_query($conn, "INSERT INTO famosos (codigo, nome) VALUES (7, 'Jeremy Swift')");

pg_close($conn);