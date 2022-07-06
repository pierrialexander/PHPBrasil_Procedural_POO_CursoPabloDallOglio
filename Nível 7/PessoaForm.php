<?php

require_once('classes/pessoa.php');
require_once('classes/cidade.php');

/**
 * Classe controladora de pessoas
 * @author Pierri Alexander Vidmar
 */
class PessoaForm {
    
    // Será carregado o html do form.
    private $html;
    // Armazena os dados da pessoa que está sendo editado no momento.
    private $data;
    
    public function __construct($param) 
    {
        //error_reporting(0);
        $this->html = file_get_contents('html/form.html');
        // se não for passado dados, ele inicia o array vazio
        $this->data = [ 'id'        => null,
                        'nome'      => null,
                        'endereco'  => null,
                        'bairro'    => null,
                        'telefone'  => null,
                        'email'     => null,
                        'id_cidade' => null];
        
        // através do foreach a variável cidades, vai armazenar as options
        // de cidades no HTML.
        $cidades = '';
        foreach (Cidade::all() as $cidade) 
        {
            $cidades .= "<option value='{$cidade['id']}'> {$cidade['nome']} </option>";
        }
        $this->html = str_replace('{cidades}', $cidades, $this->html);
    }
    
    /**
     * Edita os dados
     * @param type $param
     */
    public function edit($param)
    {
        try
        {
            $id = (int) $param['id'];
            $this->data = Pessoa::find($id);
            header('Location: index.php?class=PessoaList');
        } 
        catch (Exception $e) {
            print $e->getMessage();
        }
    }
    
    /**
     * Salva os dados
     */
    public function save($param)
    {
        try
        {
            Pessoa::save($param);
            $this->data = $param;
            header('Location: index.php?class=PessoaList');
        } 
        catch (Exception $e) {
            print $e->getMessage();
        }
    }
    
    /**
     * Exibe o HTML em tela
     * Substituindo as marcações html pelo dado contido no array
     */
    public function show()
    {
        $this->html = str_replace('{id}', $this->data['id'], $this->html);
        $this->html = str_replace('{nome}', $this->data['nome'], $this->html);
        $this->html = str_replace('{endereco}', $this->data['endereco'], $this->html);
        $this->html = str_replace('{bairro}', $this->data['bairro'], $this->html);
        $this->html = str_replace('{telefone}', $this->data['telefone'], $this->html);
        $this->html = str_replace('{email}', $this->data['email'], $this->html);
        $this->html = str_replace('{id_cidade}', $this->data['id_cidade'], $this->html);
        
        $this->html = str_replace("{option value='{$this->data['id_cidade']}'",
                                   "{option value='{$this->data['id_cidade']}'",
                                    $this->html);
        print $this->html;
    }
}
