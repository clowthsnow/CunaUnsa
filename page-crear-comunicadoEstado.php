<?php
SESSION_START();

if (!isset($_SESSION['usuario'])) {
    //si no hay sesion activa 
    header("location:index.php");
} else {
    include 'conexion.php';
    $buscar = "SELECT * FROM padre WHERE PadreEstReg='A'";
    $result = $conexion->query($buscar);
    
    $buscar2 = "SELECT * FROM comunicado WHERE ComunicadoEstReg='A'";
    $result2 = $conexion->query($buscar2);
    ?>
    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Crear Comunicado</title>
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

        <body onload="focus();">

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
                                        <h5 class="breadcrumbs-title">Crear Comunicado Estado</h5>
                                        <ol class="breadcrumb">
                                            <li class=" grey-text lighten-4">Gestion de Comunicado Estado
                                            </li>
                                            <li class="active blue-text" >Crear Estado de Comunicado</li>

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
                                            <h4 class="header">Creación de Estado de Comunicado</h4>
                                            <p class="caption">
                                                En este panel usted podra crear nuevos Estados de Comunicados con los que cuenta en la Escuela.
                                            </p>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <!-- Form with validation -->
                                                <div class="col offset-l2 s12 m12 l8">
                                                    <div class="card-panel">
                                                        <h4 class="header2">Nuevo Estado de Comunicado</h4>
                                                        <div class="row">
                                                            <form id="create" class="col s12" action="control/crearComunicadoEstado.php" method="POST">
                                                                <div class="row">
                                                                    <div class="col s12 m12 l12">
                                                                        <label>Comunicado:</label>
                                                                        <select id="disco" class="browser-default" name="ComunicadoEstadoIdComunicado" required="">
                                                                            <option value="" disabled selected>Escoge un Comunicado</option>
                                                                            <?php while ($row = $result2->fetch_assoc()) { ?>
                                                                                <option value="<?php echo $row['ComunicadoId']; ?>"><?php echo $row['ComunicadoAula']; ?></option>
                                                                            <?php }
                                                                            ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col s12 m12 l12">
                                                                        <label>Padre:</label>
                                                                        <select id="disco" class="browser-default" name="ComunicadoEstadoPadre" required="">
                                                                            <option value="" disabled selected>Escoge un padre</option>
                                                                            <?php while ($row = $result->fetch_assoc()) { ?>
                                                                                <option value="<?php echo $row['PadreDni']; ?>"><?php echo $row['PadreDni']; ?></option>
                                                                            <?php }
                                                                            ?>

                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="input-field col s12">
                                                                        <input id="nombre" type="text" class="validate" name="ComunicadoEstadoEstado" required="">
                                                                        <label for="nombre">Estado:</label>
                                                                    </div>
                                                                </div>
                                                                
                                                                <br>
                                                                <div class="divider"></div>
                                                                <div class="row">
                                                                    <div class="input-field col s12">
                                                                        <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Registrar
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
                                <p>Comunicado Estado no creado correctamente.</p>
                            </div>
                            <div class="modal-footer">
                                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
                            </div>
                        </div>
                        <!--modal error-->
                        <div id="modal2" class="modal">
                            <div class="modal-content">
                                <h4 class="green-text">EXITO!!!</h4>
                                <p>Comunicado Estado creado correctamente.</p>
                            </div>
                            <div class="modal-footer">
                                <a href="page-crear-comunicadoEstado.php" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
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
