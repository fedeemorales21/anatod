<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ANATOD</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/sandstone/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <!-- formalario -->
            <div class="col-sm-12 col-md-12">
                <form class="card p-4" id="formUser">
                    <input type="hidden" name="id" id="idUser">
                    <span id="err-id"></span>
                    <div class="form-group">
                        <label for="nameUser">Nombre</label>
                        <input type="text" class="form-control" id="nameUser" name="name" placeholder="Juan">
                        <span id="err-name">Complete este campo</span>
                    </div>
                    <div class="form-group">
                        <label for="dniUser">DNI</label>
                        <input type="number" class="form-control" id="dniUser" name="dni" placeholder="34556454">
                        <span id="err-dni">Complete este campo</span>
                    </div>
                    <div class="form-group">
                        <label for="provinceUser">Provincia</label>
                        <select class="form-control" id="provinceUser" name="provinces_id"></select>
                        <span id="err-province_id">Complete este campo</span>
                    </div>
                    <div class="form-group">
                        <label for="localitiesUser">Localidad</label>
                        <select class="form-control" id="localitiesUser" name="localities_id"></select>
                        <span id="err-localities_id">Complete este campo</span>
                    </div>
              
                    <input type="submit" class="btn btn-success" value="Agregar" id="saveClient">

                    <button class="btn btn-success btn-block" id="saveEdit">Guardar</button>
                    <button class="btn btn-danger btn-block" id="cancelEdit">Cancelar</button>

                 
                </form>
            </div>

            <!-- listado -->
            <div class="col-sm-12 col-md-12 mt-4">

                <h2>Listado A</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Cliente</th>
                            <th>Nombre de cliente</th>
                            <th>Dni de cliente</th>
                            <th>Nombre de la localidad</th>
                            <th>Nombre de la Provincia</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody id="tableA"></tbody>
                </table>

                <h2>Listado B</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Provincia</th>
                            <th>Nombre de Provincia</th>
                            <th>Nombre de Localidad</th>
                            <th>Cantidad de clientes asignados a esa localidad</th>
                        </tr>
                    </thead>
                    <tbody id="tableB"></tbody>
                </table>
            </div>

        </div>
    </div>

    <script src="js/main.js"></script>
    <script src="https://kit.fontawesome.com/1afd94d30f.js" crossorigin="anonymous"></script>
</body>
</html>