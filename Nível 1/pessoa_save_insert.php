<?php

$dados = $_POST;

$conn = pg_connect('host=localhost port=5432 dbname=php_poo user=postgres password=PIERRE');

$result = pg_query($conn, 'SELECT max(id) as next FROM pessoa');
$row = pg_fetch_assoc($result);
$next = (int) $row['next'] + 1;

$sql = "INSERT INTO pessoa (id, nome, endereco, bairro, telefone, email, id_cidade) 
                    values ('{$next}',
                            '{$dados['nome']}', 
                            '{$dados['endereco']}',
                            '{$dados['bairro']}',
                            '{$dados['telefone']}',
                            '{$dados['email']}',
                            '{$dados['id_cidade']}')";

$result = pg_query($conn, $sql);
if ($result) {
    header("location: pessoa_listagem.php");
} else {
    print pg_last_error($conn);
}

pg_close($conn);
