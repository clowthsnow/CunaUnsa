<?php
SESSION_START();

if (!isset($_SESSION['usuario'])) {
    //si no hay sesion activa 
    header("location:index.php");
} else {
    include 'conexion.php';
    //echo $usuario;
    ?>
    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Ver Estados de Comunicados</title>
            <!--Let browser know website is optimized for mobile-->
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <!-- Favicons-->
            <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">


            <!-- CORE CSS-->    
            <link href="css/materialize.css" type="text/css" rel="stylesheet">
            <link href="css/style.css" type="text/css" rel="stylesheet" >
            <link href="css/estilos.css" type="text/css" rel="stylesheet" >

            <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->    
            <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
            <link href="js/plugins/data-tables/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">



        </head>

        <body>

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
                                        <h5 class="breadcrumbs-title">Ver Estado de Comunicados</h5>
                                        <ol class="breadcrumb">
                                            <li class=" grey-text lighten-4">Gestion de Estado de Comunicados
                                            </li>
                                            <li class="active blue-text">Ver Estado de Comunicados</li>
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
                                            <h4 class="header">Ver Estado de Comunicados</h4>
                                            <p class="caption">
                                                En este panel usted podra ver todos los estados de los comunicados almacenados en el sistema y poder gestionarlas.
                                            </p>
                                            <div class="divider"></div>
                                            <div class="container">
                                                <!--DataTables example-->
                                                <div id="table-datatables">
                                                    <h4 class="header">Estado de Comunicados:</h4>
                                                    <div class="row">

                                                        <div class="col s12 m12 l12">
                                                            <table id="data-table-simple" class="responsive-table display " cellspacing="0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Comunicado</th>
                                                                        <th>Padre</th>
                                                                        <th>Estado</th>
                                                                        <th>Configurar</th>
                                                                        <th>Eliminar</th>
                                                                    </tr>
                                                                </thead>

                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Comunicado</th>
                                                                        <th>Padre</th>
                                                                        <th>Estado</th>
                                                                        <th>Configurar</th>
                                                                        <th>Eliminar</th>
                                                                    </tr>
                                                                </tfoot>

                                                                <tbody>
                                                                    <?php
                                                                    $consultaUser = "SELECT * FROM comunicadoestado WHERE ComunicadoEstadoEstReg='A'";
                                                                    $resultado = $conexion->query($consultaUser) or die($conexion->error);
                                                                    while ($row = $resultado->fetch_assoc()) {
                                                                        echo "<tr>
                                                                        <td>" . $row['ComunicadoEstadoIdComunicado'] . "</td>";

                                                                        $consultaCat = "SELECT * FROM padre WHERE PadreDni='" . $row['ComunicadoEstadoPadre'] . "'";
                                                                        $resultado2 = $conexion->query($consultaCat) or die($conexion->error);
                                                                        while ($row2 = $resultado2->fetch_assoc()) {
                                                                            echo "<td>" . $row2['PadreDni'] . "</td>";
                                                                        }
                                                                        
                                                                        echo "<td>" . $row['ComunicadoEstadoEstado'] . "</td>";
  
                                                                        echo "<td><a href=\"page-configurar-comunicadoEstado.php?id=" . $row['ComunicadoEstadoIdComunicado'] . "\"><span class=\"task-cat cyan\">Configurar</span></a></td>
                                                                        <td><a href=\"control/eliminarcomunicadoEstado.php?id=" . $row['ComunicadoEstadoIdComunicado'] . "\" class=\"delete\"><span class=\"task-cat red\">Eliminar</span></a></td>
                                                                        </tr>";
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
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
                        <!--modal correcto-->
                        <div id="modal1" class="modal">
                            <div class="modal-content">
                                <h4 class="red-text">ERROR!!!</h4>
                                <p>Estado de Comunicado no se encontrado en la base de datos</p>
                            </div>
                            <div class="modal-footer">
                                <a href="page-ver-comunicadoEstados.php" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
                            </div>
                        </div>
                        <!--modal eliminar-->
                        <div id="modal2" class="modal">
                            <div class="modal-content">
                                <h4 class="red-text">ELIMINAR!!!</h4>
                                <p>¿Desea eliminar esta Estado de Comunicado?</p>
                            </div>
                            <div class="modal-footer">                                
                                <a href="#!" id="cancelar" class="modal-action modal-close waves-effect waves-red btn-flat">Cancelar</a>
                                <a href="#!" id="eliminar" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
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
            <!-- data-tables -->
            <script type="text/javascript" src="js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="js/plugins/data-tables/data-tables-inventario.js"></script>

            <!--plugins.js - Some Specific JS codes for Plugin Settings-->
            <script type="text/javascript" src="js/plugins.js"></script>

            <script>
                $(document).ready(function () {
                    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
                    $('#modal1').modal();
                    $('#modal2').modal();
                });
                var href;
                $('.delete').click(function (evt) {
                    evt.preventDefault();
                    $('#modal2').openModal();
                    href = $(this).attr('href');
                });

                $('#eliminar').click(function (ev) {
                    ev.preventDefault();

                    $.ajax({
                        type: "GET",
                        url: href,
                        success: function (respuesta) {

                            if (respuesta == 1) {
                                location.reload(true);
                                //$('#modal1').openModal();
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

