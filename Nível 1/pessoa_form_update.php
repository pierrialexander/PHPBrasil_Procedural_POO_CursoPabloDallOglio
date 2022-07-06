<?php
$dados = $_POST;
if($dados['id']){
    $conn = pg_connect('host=localhost port=5432 dbname=php_poo user=postgres password=PIERRE');
    $sql = "UPDATE pessoa SET nome      = '{$dados['nome']}',
                              endereco  = '{$dados['endereco']}',
                              bairro    = '{$dados['bairro']}',
                              telefone  = '{$dados['telefone']}',
                              email     = '{$dados['email']}',
                              id_cidade = '{$dados['id_cidade']}'
                        where id = '{$dados['id']}'";
    
    $result = pg_query($conn, $sql);

    if($result) {
        header("location: pessoa_listagem.php");
    }
    else {
        print pg_last_error($conn);
    }
    pg_close();
}