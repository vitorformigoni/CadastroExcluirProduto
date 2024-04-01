<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Cadastro de Produtos</h1>
        <form action="index.php" method="post" class="mt-4">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Produto:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="quantidade" class="form-label">Quantidade em Estoque:</label>
                <input type="number" class="form-control" id="quantidade" name="quantidade" required>
            </div>
            <div class="mb-3">
                <label for="valor" class="form-label">Valor do Produto:</label>
                <input type="number" class="form-control" id="valor" name="valor" step="0.01" required>
            </div>
            <button type="submit" name="incluir" class="btn btn-primary">Incluir Produto</button>
        </form>

        <?php
        
        session_start();
        
        if (!isset($_SESSION["produtos"])) {
            $_SESSION["produtos"] = array();
        }
        
    
        if (isset($_POST["incluir"])) {
            $nome = $_POST["nome"];
            $quantidade = $_POST["quantidade"];
            $valor = $_POST["valor"];

            $novoProduto = array(
                "nome" => $nome,
                "quantidade" => $quantidade,
                "valor" => $valor
            );

            array_push($_SESSION["produtos"], $novoProduto);
        }
        
        if (isset($_POST["excluir"])) {
            array_pop($_SESSION["produtos"]);
        }
        ?>

        <div class="mt-4">
            <h2>Produtos Cadastrados</h2>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Quantidade</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        foreach ($_SESSION["produtos"] as $produto) {
                            echo "<tr>";
                            echo "<td>" . $produto["nome"] . "</td>";
                            echo "<td>" . $produto["quantidade"] . "</td>";
                            echo "<td>R$ " . number_format($produto["valor"], 2, ",", ".") . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <br>
        <form action="index.php" method="post">
            <button type="submit" name="excluir" class="btn btn-danger">Excluir Último Registro</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/NKXW183UZHsoaKX/jkZwY1m/P5W/1K7939t39Q" crossorigin="anonymous"></script>
</body>
</html>
