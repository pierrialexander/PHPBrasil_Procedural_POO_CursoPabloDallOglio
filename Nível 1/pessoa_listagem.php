<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Cod. Município</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = pg_connect('host=localhost port=5432 dbname=php_poo user=postgres password=PIERRE');
                $result = pg_query($conn, 'SELECT * FROM pessoa ORDER BY id');

                while ($row = pg_fetch_assoc($result)) {
                    $id         = $row['id'];
                    $nome       = $row['nome'];
                    $endereco   = $row['endereco'];
                    $bairro     = $row['bairro'];
                    $telefone   = $row['telefone'];
                    $email      = $row['email'];
                    $id_cidade  = $row['id_cidade'];

                    print '<tr>';
                    print '<td> <a href="pessoa_form_edit.php?id=' . $id . '" class="btn btn-primary">Editar</a> </td>';
                    print '<td> <a href="pessoa_delete.php?id=' . $id . '" class="btn btn-danger">Excluir</a> </td>';
                    print "<td> {$id} </td>";
                    print "<td> {$nome} </td>";
                    print "<td> {$endereco} </td>";
                    print "<td> {$bairro} </td>";
                    print "<td> {$telefone} </td>";
                    print "<td> {$email} </td>";
                    print "<td> {$id_cidade} </td>";
                    print '</tr>';
                }
                ?>
            </tbody>
        </table>
        <button onclick="window.location='pessoa_form_insert.php'" class="btn btn-success">
            Inserir
        </button>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>