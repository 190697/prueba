<?php
//cometario prueba 2
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
        if($_SESSION['tipo'] != 9){?>
            <script>
                mostrarIndex(2);
            </script>;
        <?php
            }else{?>
            <script>
                mostrarIndex(1);
            </script>
            <?php
            }
        ?>
    </body>
</html>
