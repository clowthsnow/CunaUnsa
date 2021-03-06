<?php
SESSION_START();

if (!isset($_SESSION['usuario'])) {
    //si no hay sesion activa 
    header("location:index.php");
} else {
    include 'conexion.php';
    date_default_timezone_set('America/Lima');
    $fecha = new DateTime();
    $usuario = $_GET['usuario'];
    $busca = "SELECT * FROM alumno WHERE AlumnoDni='$usuario'";
    $resultado = $conexion->query($busca);
    if ($resultado->num_rows === 0) {
        header("location:page-datos-alumno_1.php");
    }
    $provBD = $resultado->fetch_assoc();
    $sugerido = $provBD['AlumnoFechaNacimiento'];
    $nacimiento = new DateTime($sugerido);

    $sug = ($fecha->diff($nacimiento)->y);
    $meses=$fecha->format('m');
//    echo $meses;
    if($meses>4){
        $sug--;
    }
    
    $buscarAula = "SELECT * FROM aula WHERE AulaEstReg='A' AND AulaGrado='$sug'";
    $resultAula = $conexion->query($buscarAula);
//    var_dump($resultAula);
    ?>
    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Matricula del Estudiante</title>
            <!--Let browser know website is optimized for mobile-->
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <!-- Favicons-->
            <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">


            <!-- CORE CSS-->    
            <link href="css/materialize.css" type="text/css" rel="stylesheet">
            <link href="css/style.css" type="text/css" rel="stylesheet" >
            <link href="css/estilos.css" type="text/css" rel="stylesheet" >


            <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->    
            <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" >


        </head>

        <body >

            <!-- START MAIN -->
            <div id="main">
                <!-- START WRAPPER -->
                <div class="wrapper">

                    <!-- START LEFT SIDEBAR NAV-->
                    <?php include 'inc/menu.inc'; ?>
                    <!-- END LEFT SIDEBAR NAV-->

                    <!-- //////////////////////////////////////////////////////////////////////////// -->

                    <!-- START CONTENT -->
                    <section id="content">

                        <!--breadcrumbs start-->
                        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
                            <div class="container">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h5 class="breadcrumbs-title">Matricula Estudiante</h5>
                                        <ol class="breadcrumb">
                                            <li class=" grey-text lighten-4">Gestion de Matriculas
                                            </li>
                                            <li class="active blue-text">Matricula Estudiante </li>

                                        </ol>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--breadcrumbs end-->

                        <!--start container-->
                        <div class="container">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="section">
                                        <div id="roboto">
                                            <h4 class="header">Matricula Estudiante</h4>
                                            <p class="caption">
                                                En este panel usted podra Matricular al estudiante.

                                            </p>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <!-- Form with validation -->
                                                <div class="col offset-l2 s12 m12 l8">
                                                    <div class="card-panel">
                                                        <h4 class="header2">Estudiante:<?php echo $provBD['AlumnoNombre'] . " " . $provBD['AlumnoApellidos']; ?></h4>
                                                        <div class="row">
                                                            <form id="create" class="col s12" action="control/matricularAlumno.php" method="POST" enctype="multipart/form-data">
                                                                <div class="input-field col s12">
                                                                    <input id="username" type="text" class="validate" name="id" required="" hidden="true" value="<?php echo $usuario; ?>">

                                                                </div>
                                                                <div class="row">
                                                                    <div class="col s12 m12 l12">
                                                                        <label>Aula:</label>
                                                                        <select id="aula" class="browser-default" name="aula" required="">
                                                                            <option value="" disabled selected>Escoge el Aula.</option>
                                                                            <?php while ($row = $resultAula->fetch_assoc()) { ?>
                                                                                <option value="<?php echo $row['AulaId']; ?>"><?php echo $row['AulaId'] . "-" . $row['AulaGrado'] . " Años"; ?></option>
                                                                            <?php }
                                                                            ?>

                                                                        </select>
                                                                    </div>
                                                                </div> 
                                                                <div class="divider"></div>

                                                                <div class="row">
                                                                    <div class="input-field col s12">
                                                                        <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Matricular
                                                                            <i class="mdi-image-edit left"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!--end container-->

                        <!--modal error-->
                        <div id="modal1" class="modal">
                            <div class="modal-content">
                                <h4 class="red-text">ERROR!!!</h4>
                                <p>Matricula no registrada correctamente.</p>
                            </div>
                            <div class="modal-footer">
                                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
                            </div>
                        </div>
                        <!--modal error-->
                        <div id="modal2" class="modal">
                            <div class="modal-content">
                                <h4 class="green-text">EXITO!!!</h4>
                                <p>Matricula registrada correctamente.</p>
                            </div>
                            <div class="modal-footer">
                                <a href="page-matricula-exitosa.php?usuario=<?php echo $usuario; ?>" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
                            </div>
                        </div>
                    </section>
                    <!-- END CONTENT -->

                    <!-- //////////////////////////////////////////////////////////////////////////// -->
                    <!-- START RIGHT SIDEBAR NAV-->
                    <aside id="right-sidebar-nav">

                    </aside>
                    <!-- LEFT RIGHT SIDEBAR NAV-->

                </div>
                <!-- END WRAPPER -->

            </div>
            <!-- END MAIN -->



            <!-- //////////////////////////////////////////////////////////////////////////// -->

            <!-- START FOOTER -->
            <?php include 'inc/footer.inc'; ?>
            <!-- END FOOTER -->


            <!-- ================================================
            Scripts
            ================================================ -->

            <!-- jQuery Library -->
            <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>    
            <!--materialize js-->
            <script type="text/javascript" src="js/materialize.js"></script>
            <!--scrollbar-->
            <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

            <!--plugins.js - Some Specific JS codes for Plugin Settings-->
            <script type="text/javascript" src="js/plugins.js"></script>

            <script>

                $(document).ready(function () {
                    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered

                    $('#modal2').modal();
                    $('#modal1').modal();
                });
                var frm = $('#create');
                frm.submit(function (ev) {
                    ev.preventDefault();
                    $.ajax({
                        type: frm.attr('method'),
                        url: frm.attr('action'),
                        data: frm.serialize(),
                        success: function (respuesta) {
                            console.log(respuesta);
                            if (respuesta == 1) {
                                //$('#modal2').openModal();
                                //document.location.href = "page-crear-proveedor.php";
                                //                                location.reload();
                                $('#modal2').openModal();

                            } else {

                                $('#modal1').openModal();
                            }

                        }
                    });


                });
            </script>
        </body>

    </html>
    <?php
}
?>





