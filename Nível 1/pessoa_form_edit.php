<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro de Pessoa</title>
</head>
<body>
    <?php
        if(!empty($_GET['id'])){
            $conn = pg_connect('host=localhost port=5432 dbname=php_poo user=postgres password=PIERRE');
            $id = (int) $_GET['id'];
            $result = pg_query($conn, "SELECT * FROM pessoa WHERE id=" . $id);
            $row = pg_fetch_assoc($result);

            $id = $row['id'];
            $nome = $row['nome'];
            $endereco = $row['endereco'];
            $bairro = $row['bairro'];
            $telefone = $row['telefone'];
            $email = $row['email'];
            $id_cidade = $row['id_cidade'];

            print_r($row);
        }
    ?>
    <div class="container">
        
        <div class="card border-secondary">
            
            <h1 class="card-header">Formulário de Edição de Pessoa</h1>
            <div class="card-body">

            <!-- INICIO DO FORMULARIO -->
            <form enctype="multipart/form-data" method="post" action="pessoa_form_update.php">
                    <div class="form-group">
                        <label for="id">Código</label><br>
                <input name="id" type="text" readonly="1" class="form-control" id="id" value="<?= $id ?>">
            </div>
            <div class="form-group">
                <label for="nome">Nome</label><br>
                <input name="nome" type="text" class="form-control" id="nome" value="<?= $nome ?>">
            </div>
            <div class="form-group">
                <label for="endereco">Endereço</label><br>
                <input name="endereco" type="text" class="form-control" id="endereco" value="<?= $endereco ?>" />
            </div>
            <div class="form-group">
                <label for="bairro">Bairro</label><br>
                <input name="bairro" type="text" class="form-control" id="bairro" value="<?= $bairro ?>" />
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label><br>
                <input name="telefone" type="text" class="form-control" id="telefone" value="<?= $telefone ?>" />
            </div>
            <div class="form-group">
                <label for="email">Email</label><br>
                <input name="email" type="text" class="form-control" id="email" value="<?= $email ?>" />
            </div>
            <input type="submit" value="Envio" class="btn btn-primary">
            <div class="form-group">
                <label for="cidade">Cidade</label><br>
                <select name="id_cidade" id="cidade" class="form-control" >
                    <?php
                        require_once 'lista_combo_cidade.php';
                        print lista_combo_cidades( $id_cidade );  
                        ?>
                </select>
            </div>
            
        
        </form>
        </div>

    </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>