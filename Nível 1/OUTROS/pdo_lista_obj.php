<?php
try {
    $conn = new PDO('pgsql:dbname=php_poo;user=postgres;password=PIERRE;host=localhost');

    $result = $conn->query("SELECT codigo, nome FROM famosos");

    if ($result) {
        //foreach ($result as $row) {
        while($row = $result->fetchObject()){
            print $row->codigo . ' - ' . $row->nome . '<br>';
        }
    }

    $conn = null;
} catch (PDOException $e) {
    print 'Exceção: ' . $e->getMessage();
}
 