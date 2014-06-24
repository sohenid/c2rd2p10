<?php include('dbopen.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MIXD - Mobile</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <table class="table">
            <tr>
                <th>ID</th>
                <th>Categoria</th>
                <th>Descrição</th>
                <th class="text-center">Preço</th>
                <th class="text-center" style="width: 200px;">Imagem</th>
            </tr>
            <?php
            #$query = sprintf("SELECT * FROM produto WHERE descricao = '%s'", mysql_real_escape_string($descricao));
            $query = 'SELECT a.*, (select descricao from categoria where id = a.categoria_id) categoria FROM produto a ORDER BY id DESC';

            $result = mysql_query($query);

            if (!$result)
            {
                $message = 'Query inválida: ' . mysql_error() . "\n";
                $message .= 'Query: ' . $query;
                die($message);
            }

            while ($row = mysql_fetch_assoc($result))
            {
                ?>
                <tr>
                    <td style="vertical-align: middle">
                        <?php echo $row['id']; ?>
                    </td>
                    <td style="vertical-align: middle">
                        <?php echo $row['categoria_id'], ' ', $row['categoria']; ?>
                    </td>
                    <td style="vertical-align: middle">
                        <?php echo $row['descricao']; ?>
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <?php echo number_format($row['preco'], 2, ',', '.'); ?>
                    </td>
                    <td class="text-center">
                        <img src="<?php echo $row['imagem']; ?>" alt="<?php echo $row['descricao']; ?>">
                    </td>
                </tr>
                <?php
            }

            mysql_free_result($result);
            ?>
        </table>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
<?php include('dbclose.php'); ?>