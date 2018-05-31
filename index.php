<?php
//cometario prueba 3
session_start();
if (!isset($_SESSION["id_usuario"])) {
    session_destroy();
    header("Location: login/login.php");
} 
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
        include './head.php';
        ?>
    </head>
    <body id="page-top">
        <div class="cont">
            <div id="nav">

            </div>
            <div class="wrapper">
                <!-- Sidebar Holder -->
                <nav id="sidebar">

                </nav>
                <!-- Page Content Holder -->
                <div id="content" class="col-lg-12">

                </div>
            </div>
            <div id="modal"></div>
            <footer>
                <div class="container text-center">
                    <p>Sitio creado por <a href="http://metaconsultec.com/"><span>METACONSULTEC SC</span></a> 2018</p>
                </div>
            </footer>
        </div>
        <script>
            
        </script>
        <?php
        //Usuario FIC
        if($_SESSION['tipo'] == 1){?>
            <script>
                mostrarIndex(2);
            </script>;
        <?php
            }else if($_SESSION['tipo'] == 2){ ?>
            <script>
                mostrarIndex(1);
            </script>
            <?php
            }
        ?>
    </body>
</html>
