<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Relatório de funcionários</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="row">
        <div class="container">
            <div class="jumbotron">
            <a href="index.php" alt="Home"><i class="fas fa-home"></i></a>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <h2>Relatório estático de funcionários.</span></h2>
                    </div>
                </div>
            </div>
            </br>
            <div class="row">
                <div class="col-md-4 float-right">
                    <a href="create.php" class="btn btn-success">Adicionar</a>
                </div>
                <div class="col-md-12 col-sm-12">
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Funcionários masculinos</th>
                            <th scope="col">Funcionários femininos</th>
                            <th scope="col">Funcionário mais Novo</th>
                            <th scope="col">Funcionário mais Velho</th>
                            <th scope="col">Média de idade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'bd.php';
                        $pdo = Banco::conectar();

                        //Filtro funcionarios homens
                        $masculino = $pdo->query('SELECT * FROM funcionarios WHERE sexo = "M"');
                        $rowCountMas = $masculino->rowCount();

                        //Filtro funcionárias mulheres
                        $feminino = $pdo->query('SELECT * FROM funcionarios WHERE sexo = "F"');
                        $rowCountFem = $feminino->rowCount();

                        //Filtro Funcionário mais novo
                        $menorIdade = $pdo->query('SELECT MIN(idade) FROM funcionarios');
                        $rowMenIdad = $menorIdade->fetchAll();
                        
                        //Filtro Funcionário mais velho
                        $maiorIdade = $pdo->query('SELECT MAX(idade) FROM funcionarios');
                        $rowMaiorIdad = $maiorIdade->fetchAll();
                        
                        //Filtro Média das idades
                        $somaIdades = $pdo->query('SELECT SUM(idade) FROM funcionarios');
                        $totalIdades = $somaIdades->fetchAll();
                        $somaCampos = $pdo->query('SELECT sexo FROM funcionarios');
                        $totalCampos = count($somaCampos->fetchAll());
                        $mediaIdades = $totalIdades[0][0] / $totalCampos;

                        echo '<td>'. $rowCountMas . '</td>';
                        echo '<td>'. $rowCountFem . '</td>';
                        echo '<td>'. $rowMenIdad[0][0] . '</td>';
                        echo '<td>'. $rowMaiorIdad[0][0] . '</td>';
                        echo '<td>'. round($mediaIdades) . '</td>';

                        Banco::desconectar();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
