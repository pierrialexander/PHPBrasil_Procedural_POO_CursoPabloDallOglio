<?php

function getPessoa($id)
{
    $conn = pg_connect('host=localhost port=5432 dbname=php_poo user=postgres password=PIERRE');
    $result = pg_query($conn, 'SELECT * FROM pessoa WHERE id =' . $id);
    $pessoa = pg_fetch_assoc($result);
    pg_close($conn);
    return $pessoa;
}

function excluiPessoa($id)
{
    $conn = pg_connect('host=localhost port=5432 dbname=php_poo user=postgres password=PIERRE');
    $result = pg_query($conn, 'DELETE FROM pessoa WHERE id =' . $id);
    pg_close($conn);
    return $result;
}

function insertPessoa($pessoa)
{
    $conn = pg_connect('host=localhost port=5432 dbname=php_poo user=postgres password=PIERRE');
    $sql = "INSERT INTO pessoa (id, nome, endereco, bairro, telefone, email, id_cidade) 
                                        values ('{$pessoa['id']}',
                                                '{$pessoa['nome']}', 
                                                '{$pessoa['endereco']}',
                                                '{$pessoa['bairro']}',
                                                '{$pessoa['telefone']}',
                                                '{$pessoa['email']}',
                                                '{$pessoa['id_cidade']}')";
    $result = pg_query($conn, $sql);
    pg_close($conn);
    return $result;
}

function updatePessoa($pessoa)
{
    $conn = pg_connect('host=localhost port=5432 dbname=php_poo user=postgres password=PIERRE');
    $sql = "UPDATE pessoa SET  nome = '{$pessoa['nome']}',
                                  endereco  = '{$pessoa['endereco']}',
                                  bairro    = '{$pessoa['bairro']}',
                                  telefone  = '{$pessoa['telefone']}',
                                  email     = '{$pessoa['email']}',
                                  id_cidade = '{$pessoa['id_cidade']}'
                                  where id  = '{$pessoa['id']}'";

    $result = pg_query($conn, $sql);
    pg_close($conn);
    return $result;
}

function listaPessoa()
{
    $conn = pg_connect('host=localhost port=5432 dbname=php_poo user=postgres password=PIERRE');
    $result = pg_query($conn, 'SELECT * FROM pessoa ORDER BY id');
    $list = pg_fetch_all($result);
    pg_close($conn);
    return $list;
}

function getNextPessoa()
{
    $conn = pg_connect('host=localhost port=5432 dbname=php_poo user=postgres password=PIERRE');
    $result = pg_query($conn, 'SELECT max(id) as next FROM pessoa');
    $pessoa = pg_fetch_assoc($result);
    $next = (int) $pessoa['next'] + 1;
    pg_close($conn);
    return $next;
}
