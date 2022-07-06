<?php

function lista_combo_cidades($id_cidade = null){
    $conn = pg_connect('host=localhost port=5432 dbname=php_poo user=postgres password=PIERRE');
    $output = '';
    $result = pg_query($conn, 'select id, nome from cidade');
    if($result) {
        while($row = pg_fetch_assoc($result)){
            $id = $row['id'];
            $nome = $row['nome'];
            $check = ($id == $id_cidade) ? 'selected=1' : '';
            $output .= "<option {$check} value={$id}>{$nome}</option>";
        }
    }
    pg_close($conn);
    return $output;
}

?>