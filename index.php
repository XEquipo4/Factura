<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- site metas -->
    <title>Stratton Oarmont Inc</title>
    <!-- site icon -->
    <link rel="icon" href="images/fevicon.png" type="image/png" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="/sistemas_factura/departamentos/sistema/css/bootstrap.min.css" />
    <!-- site css -->
    <link rel="stylesheet" href="/sistemas_factura/css/estilo.css" />
    <!-- additional styles -->
    <link rel="stylesheet" href="/sistemas_factura/departamentos/sistema/css/responsive.css" />
    <link rel="stylesheet" href="/sistemas_factura/departamentos/sistema/css/colors.css" />
    <link rel="stylesheet" href="/sistemas_factura/departamentos/sistema/css/bootstrap-select.css" />
    <link rel="stylesheet" href="/sistemas_factura/departamentos/sistema/css/perfect-scrollbar.css" />
    <link rel="stylesheet" href="/sistemas_factura/departamentos/sistema/css/custom.css" />
    <link rel="stylesheet" href="/sistemas_factura/departamentos/sistema/js/semantic.min.css" />
</head>
<body class="inner_page login">
    <script>
        setInterval(() => {
            let fecha = new Date();
            let fechahora = fecha.toLocaleString();
            document.getElementById("fecha").textContent = fechahora;
        }, 1000);
    </script>
    <div class="full_container">
        <div class="container">
            <div class="row justify-content-center align-items-center verticle_center full_height">
                <div class="col-md-6">
                    <div class="login_section">
                        <div class="logo_login">
                            <div class="img">
                                <img width="200px" height="90px" src="/sistemas_factura/img/Logo.png" alt="#" />
                            </div>
                        </div>
                        <div class="login_form">
                            <h3 id="fecha" style="text-align:center;"></h3>
                            <form action="/sistemas_factura/sistemas_php/ingreso.php" method="post">
                                <fieldset>
                                    <div class="field">
                                        <label class="label_field">Correo:</label>
                                        <input type="email" name="email" class="form-control" required />
                                    </div>
                                    <div class="field">
                                        <label class="label_field">Contraseña:</label>
                                        <input type="password" id="password" name="password" placeholder="password" class="form-control" required />
                                    </div>
                                    <div class="field" style="text-align: right;">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" onclick="togglePassword()"> Mostrar
                                        </label>
                                    </div>
                                    <select class="form-select form-select-lg mb-3" aria-label="Large select example" style="display: block; margin: 0 auto;" name="rol" id="rol">
                                        <option selected>Seleccione Rol</option>
                                        <option value="Director">Director</option>
                                        <option value="contador">contador</option>
                                    </select>
                                    <div class="field margin_0">
                                        <label class="label_field hidden"></label>
                                        <button class="btn-entrada" style="display: block; margin: 0 auto;">Ingresar</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>

                        <script>
                            function togglePassword() {
                                const passwordField = document.getElementById("password");
                                passwordField.type = passwordField.type === "password" ? "text" : "password";
                            }
                        </script>

                    </div>
                </div>
                <div class="col-md-6">
                <div class="historial-container">
                <?php
                // Conexión a la base de datos (asegúrate de que este código esté en conexion_bd.php)
                include("sistemas_php/conexion_bd.php");

                // Consulta para obtener el historial
                $query = "SELECT roles, rfc, hora_entrada, hora_salida FROM historial_sistema";
                $result = $conexion->query($query);

                // Comprobar si hay resultados
                if ($result->num_rows > 0) {
                    // Almacenar los resultados en un array
                    $historial = [];
                    while ($row = $result->fetch_assoc()) {
                        $historial[] = $row;
                    }
                } else {
                    $historial = [];
                }
                ?>
                <h4>Historial de Usuarios</h4>
                    <ul>
                        <?php foreach ($historial as $registro): ?>
                            <li>
                                Rol: <?= htmlspecialchars($registro['roles']) ?>, 
                                RFC: <?= htmlspecialchars($registro['rfc']) ?>, 
                                Hora Entrada: <?= htmlspecialchars($registro['hora_entrada']) ?>, 
                                Hora Salida: <?= htmlspecialchars($registro['hora_salida']) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <form method="post" action="sistemas_php/generarpdf.php">
                        <button type="submit" class="btn btn-info">Descargar Historial</button>
                    </form>
                </div>

                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animate.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/perfect-scrollbar.min.js"></script>
    <script>
        var ps = new PerfectScrollbar('#sidebar');
    </script>
    <script src="js/custom.js"></script>
</body>
</html>
