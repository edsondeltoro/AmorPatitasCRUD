<?php
session_start();

if (!isset($_SESSION['token'])) {
    header("Location: login.php");
    exit();
}

include('includes/header.php');
?>

<style>

    body {
        background-image:		url("Imagenes/bg.jpg");
        background-size: 		cover;
        background-position: 	center;
    }

    .seccion {
        display: 			table;
        margin: 			100px auto;
        width:				1065px;
        height: 			400px;
        overflow: 			hidden;
        border-radius: 		15px;
    }



    #FormLogin input[type=text], input[type=password], label {
        width: 				80%;
        margin: 			2% 10% 3%;
        font-size: 			medium;
        padding: 			2px 2px;
    }

    input[type=submit] {
        border: 			none;
        border-radius: 		4px;
        cursor: 			pointer;
    }

    #seccionMensaje {
        display: 			table-cell;
        vertical-align: 	middle;
        font-family: 		'Roboto', sans-serif;
        background-color:	#D9885925;
    }

    #bloqueMensaje {
        margin: 			5%;
        overflow: 			hidden;
        color: 				black;
    }

    #titulo {
        width: 				100%;
        font-size: 			250%;
        text-align: 		center;
        display: 			block;
        margin: 			auto auto 30px;
    }

    #mensaje {
        width: 				100%;
        font-size: 			x-large;
        text-align: 		center;
        display: 			block;
        animation: 			movimientoTexto 0.5s linear infinite;
        position: 			relative;
        top: 				-25px;
    }

    @keyframes movimientoTexto {
        0%{
            transform: scale(1, 1);
        }
        50% {
            transform: scale(1.1, 1);
        }
        100% {
            transform: scale(1, 1);
        }
    }

    @keyframes movimientoAlerta {
        0%{
            transform: translate(0px);
        }
        25%{
            transform: translate(6px);
        }
        50%{
            transform: translate(-6px);
        }
        75%{
            transform: translate(6px);
        }
        100%{
            transform: translate(0px);
        }
    }

    #descripcion {
        width: 				100%;
        font-size: 			large;
        text-align: 		center;
        display: 			block;
        position: 			relative;
    }

</style>

<body>
<div class="seccion">
    <div id="seccionMensaje">
        <div id="bloqueMensaje">
					<span id="titulo">
						Administración Amor Patitas
					</span>
            <span id="mensaje">
						Selecciona la pestaña a la que quieras ir
					</span>
            <span id="descripcion">
						Sistema exclusivo para personal autorizado
					</span>
        </div>
    </div>
</div>
</body>


<?php include('includes/footer.php'); ?>
