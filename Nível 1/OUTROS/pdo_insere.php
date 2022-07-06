<?php
try {
    $conn = new PDO('pgsql:dbname=php_poo;user=postgres;password=PIERRE;host=localhost');

    $conn->exec("INSERT INTO f6amosos (codigo, nome) VALUES (8, 'Nicolau Nicolei')");
    $conn->exec("INSERT INTO famosos (codigo, nome) VALUES (9, 'Silvio Santos')");
    $conn->exec("INSERT INTO famosos (codigo, nome) VALUES (10, 'Pedro Alvares')");
    $conn->exec("INSERT INTO famosos (codigo, nome) VALUES (11, 'Chico Anísio')");
    $conn->exec("INSERT INTO famosos (codigo, nome) VALUES (12, 'Beto Carrero')");
    $conn->exec("INSERT INTO famosos (codigo, nome) VALUES (13, 'Ayrton Senna')");
    $conn->exec("INSERT INTO famosos (codigo, nome) VALUES (14, 'Pelé')");

    $conn = null;
} catch (PDOException $e) {
    print 'Exceção: ' . $e->getMessage();
}
