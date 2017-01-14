<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="CSS/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a id="navTitle" class="navbar-brand" href="Index.html"></a>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="form-inline">
            <div class="form-group">
                <input type="text" class="form-control" id="desc" placeholder="Descrição">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="amount" placeholder="Quantidade">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="value" placeholder="Valor">
            </div>
            <span id="btnUpdate" style="display: none">
            <span id="inputIdUpdate"></span>
            <button onclick="updateForm()" class="btn btn-success">Save</button>
            <button onclick="resetForm()" class="btn btn-default">Cancel</button>
            </span>
            <span id="btnAdd"></span>
            
            <button onclick="addData()" class="btn btn-primary">Add</button>
            <button onclick="resetForm()" class="btn btn-warning">Reset</button>
            <button onclick="deleteLista()" class="btn btn-danger">Deletar Lista</button>
        </div>

        <div id="errors" style="display: none"></div>

        <table id="listTable" class="table">

        </table>
    </div>

    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
            <h4 class="text-center text-success">Total: <span id="totalValue">$ 0,00</span></h4>
        </div>
    </nav>

    <?php
        require_once('config.php');
        require_once('main.php');
    
    
    ?>
</body>

</html>