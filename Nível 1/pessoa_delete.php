<?php
$dados = $_GET;
if($dados['id']){
    $conn = pg_connect('host=localhost port=5432 dbname=php_poo user=postgres password=PIERRE');

    $id = (int) $dados['id'];
    $sql = "DELETE FROM pessoa WHERE id=" . $id;
    
    $result = pg_query($conn, $sql);

    if($result) {
        header("location: pessoa_listagem.php");
    }
    else {
        print pg_last_error($conn);
    }
    pg_close();
}