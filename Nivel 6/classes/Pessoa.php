<?php

/**
 * Classe responsável por manipular os dados referente a Pessoas
 */
class Pessoa
{
    /**
     * Variável estática para checar se a conexão com o banco já está estabelecida.
     */
    private static $conn;
    
    /**
     * Método responsável por checar se a conexão com o banco de dados
     * está estabelecida, se não etiver, ao ser chamada a estabelece.
     * @return bool $conn
     */
    public static function getConnection() 
    {
        if(empty(self::$conn))
        {
            $ini = parse_ini_file('config/config.ini');
            $host = $ini['host'];
            $name = $ini['name'];
            $user = $ini['user'];
            $pass = $ini['pass'];
            
            self::$conn = new PDO("pgsql:dbname={$name};user={$user};password={$pass};host={$host}");
            // Define que os erros devem ser tratados como uma exceção pelo PDO.
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }
    
    /**
     * Método que retorna um dado do bando de dados
     * @param $id
     * @return object $result;
     */
    public static function find($id)
    {
        $conn = self::getConnection();
        $result = $conn->prepare("SELECT * FROM pessoa WHERE id=:id");
        $result->execute([':id' => $id]);
        return $result->fetch();
    }

    /**
     * Método para exclusão de dados
     * @param $id
     * @return void
     */
    public static function delete($id)
    {
        $conn = self::getConnection();
        $result = $conn->prepare("DELETE FROM pessoa WHERE id=:id");
        $result->execute([':id' => $id]);
        return $result;
    }

    /**
     * Método que retornará uma lista com todos os dados
     * @return array $result
     */
    public static function all()
    {
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM pessoa ORDER BY id");
        return $result->fetchAll();
    }

    /**
     * Método que fará ou o save ou update
     * @param $pessoa
     * @return void
     */
    public static function save($pessoa)
    {
        $conn = self::getConnection();

        // Se não tiver um ID já setado no GET ele insere, se não atualiza.
        if (empty($pessoa['id']))
        { // Insert
            // Lê o maior ID e gera o próximo para inserção
            $result = $conn->query("SELECT max(id) as next FROM pessoa");
            $row = $result->fetch();
            $pessoa['id'] = (int)$row['next'] + 1;

            // Faz a inserção no banco
            $sql = "INSERT INTO pessoa (id, nome, endereco, bairro, telefone, email, id_cidade) 
                                        values (:id,
                                                :nome, 
                                                :endereco,
                                                :bairro,
                                                :telefone,
                                                :email,
                                                :id_cidade)";
            header('Location: pessoa_list.php');
        }
        else
        { // Senão faz o Update
            $sql = "UPDATE pessoa SET nome  = :nome,
                                  endereco  = :endereco,
                                  bairro    = :bairro,
                                  telefone  = :telefone,
                                  email     = :email,
                                  id_cidade = :id_cidade
                                  where id  = :id";
        }
        $result = $conn->prepare($sql);
        $result->execute([
            ':id'        => $pessoa['id'],
            ':nome'      => $pessoa['nome'], 
            ':endereco'  => $pessoa['endereco'],
            ':bairro'    => $pessoa['bairro'],
            ':telefone'  => $pessoa['telefone'],
            ':email'     => $pessoa['email'],
            ':id_cidade' => $pessoa['id_cidade']
        ]);
    }
}