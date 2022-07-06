<?php
class Cidade {
    /**
     * Método responsável por retornar A lista de
     * registros de cidades da base de dados.
     * @return array $cidades
     */
    public static function all(){
        $conn = new PDO("pgsql:dbname=php_poo;user=postgres;password=PIERRE;host=127.0.0.1");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $conn->query("SELECT * FROM cidade ORDER BY id");
        return $result->fetchAll();
    }
}
