<?php
class Pessoa {
    /**
     * Método responsável por fazer a busca do 
     * registro na base de dados a partir da Id.
     * @param int $id
     */
    public static function find($id){
        $conn = new PDO("pgsql:dbname=php_poo;user=postgres;password=PIERRE;host=127.0.0.1");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $conn->query("SELECT * FROM pessoa WHERE id=" . $id);
        return $result->fetch();
    }

    /**
     * Método responsável por fazer a exclusão do 
     * registro na base de dados a partir da Id.
     * @param int $id
     */
    public static function delete($id){
        $conn = new PDO("pgsql:dbname=php_poo;user=postgres;password=PIERRE;host=127.0.0.1");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $conn->query("DELETE FROM pessoa WHERE id=" . $id);
        return $result;
    }

    /**
     * Método responsável por retornar uma lista de
     * registros da base de dados.
     * @return array $pessoas
     */
    public static function all(){
        $conn = new PDO("pgsql:dbname=php_poo;user=postgres;password=PIERRE;host=127.0.0.1");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $conn->query("SELECT * FROM pessoa ORDER BY id");
        return $result->fetchAll();
    }

    /**
     * Método responsável por salvar ou editar um
     * registro na base de dados.
     * @param array $pessoa
     */
    public static function save($pessoa){
        $conn = new PDO("pgsql:dbname=php_poo;user=postgres;password=PIERRE;host=127.0.0.1");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(empty($pessoa['id'])){ // Insert
            $result = $conn->query("SELECT max(id) as next FROM pessoa");
            $row = $result->fetch();
            $pessoa['id'] = (int) $row['next'] + 1;
            
            $sql = "INSERT INTO pessoa (id, nome, endereco, bairro, telefone, email, id_cidade) 
                                        values ('{$pessoa['id']}',
                                                '{$pessoa['nome']}', 
                                                '{$pessoa['endereco']}',
                                                '{$pessoa['bairro']}',
                                                '{$pessoa['telefone']}',
                                                '{$pessoa['email']}',
                                                '{$pessoa['id_cidade']}')";
            header('Location: pessoa_list.php');
        }
        else{ // Update
            $sql = "UPDATE pessoa SET nome = '{$pessoa['nome']}',
                                  endereco  = '{$pessoa['endereco']}',
                                  bairro    = '{$pessoa['bairro']}',
                                  telefone  = '{$pessoa['telefone']}',
                                  email     = '{$pessoa['email']}',
                                  id_cidade = '{$pessoa['id_cidade']}'
                                  where id  = '{$pessoa['id']}'";
        }
        return $conn->query($sql);
    }
}


?>