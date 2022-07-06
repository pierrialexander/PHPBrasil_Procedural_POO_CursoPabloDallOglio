<?php
require_once './classes/Pessoa.php';
/**
 * Classe controladora da listagem de pessoas
 * @author Pierri Alexander Vidmar
 */
class PessoaList {
    
    public $html;
    
    public function __construct() 
    {
       $this->html = file_get_contents('html/list.html'); 
    }
    
    public function delete($param)
    {
       try{
           $id = (int) $param['id'];
           Pessoa::delete($id);
           header('Location: index.php?class=PessoaList');
       } catch (Exception $e) {
           print $e->getMessage();
       } 
    }
    
    /**
     * Método responsável por carregar todas as pessoas da base de dados
     */
    public function load()
    {
        try
        {
            $pessoas = Pessoa::all();
            
            $items = '';
            foreach ($pessoas as $pessoa) {
                $item = file_get_contents('html/item.html');
                $item = str_replace('{id}',         $pessoa['id'],        $item);
                $item = str_replace('{nome}',       $pessoa['nome'],      $item);
                $item = str_replace('{endereco}',   $pessoa['endereco'],  $item);
                $item = str_replace('{bairro}',     $pessoa['bairro'],    $item);
                $item = str_replace('{telefone}',   $pessoa['telefone'],  $item);
                $item = str_replace('{email}',      $pessoa['email'],     $item);
                $item = str_replace('{id_cidade}',  $pessoa['id_cidade'], $item);

                $items .= $item;
            }
            $this->html = str_replace('{items}', $items, $this->html);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }
    
    /**
     * Método responsável por mostrar todos os dados na listagem do HTML.
     */
    public function show()
    {
        $this->load();
        print $this->html;
    }
}
