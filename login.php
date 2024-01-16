<?php
    include 'db.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';

    if(isset($_COOKIE['contador'])){
        $cont = $_COOKIE['contador'];
    } else {
        $cont = 0;
    }

    $mail = new PHPMailer(true);


    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = $_POST["user"];
        $password = $_POST["password"];

        // Consulta para verificar las credenciales en la base de datos
        $sql = "SELECT * FROM admins WHERE user = '$username' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $token = bin2hex(random_bytes(16));
            $_SESSION['token'] = $token;
            setcookie('session_token', $token, time() + 3600, '/');
            setcookie('contador', 0, time() + 3600);
            header("Location: index.php");
            exit();
        } else {
            $cont++;
            setcookie('contador', $cont, time() + 3600);
            echo '<script>alert("Credenciales incorrectas. Inténtalo de nuevo.");</script>';
            if($cont > 2){
                try {
                    // Configurar el servidor SMTP externo
                    $mail->isSMTP();
                    $mail->Host = 'smtp.office365.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'amorpatitas@hotmail.com';
                    $mail->Password = 'PatitasAmor';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    // Configurar otros detalles del correo
                    $mail->setFrom('amorpatitas@hotmail.com', 'Amor Patitas');
                    $mail->addAddress('edson.deltoro5631@alumnos.udg.mx', 'Administrador Edson');
                    $mail->addAddress('alberto.romo5395@alumnos.udg.mx', 'Administrador Alberto');
                    $mail->Subject = 'Seguridad en Amor Patitas';
                    $mail->Body = "Un usuario ha intentado ingresar erroneamente mas de 3 veces, la ultima vez fue con las siguientes credenciales:\n\nUser: $username \nPassword: $password.";

                    // Enviar el correo
                    $mail->send();
                } catch (Exception $e) {
                }

            }
        }
    }

    $conn->close();
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

        #seccionLogin {
            display: 			table-cell;
            vertical-align: 	middle;
            width: 				40%;
            font-family: 		'Roboto', FontAwesome, sans-serif;
            background-color: 	#BFA08EDF;
        }

        #bloqueLogin {
            margin: 			5%;
        }

        #campoLogin {
            width: 				80%;
            margin: 			0 auto;
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

        .boton {
            width: 				80%;
            margin: 			7% 10% auto;
            font-size: 			medium;
            padding: 			5px;
            transition-duration: 0.4s;
        }

        #botonLogin {
            background-color: 	#0E1220;
            color: 				white;
            border: 			2px solid #0E1220;
        }

        #botonLogin:hover {
            background-color: 	#0E2240;
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
            color: 				white;
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

</head>

<body>
<div class="seccion">
    <div id="seccionLogin">
        <div id="bloqueLogin">
            <h1 align="center">Login</h1>
            <form id="FormLogin" name="FormLogin" method="POST">
                <div id="campoLogin">
                    <label for="user">Usuario</label>
                    <input type="text" name="user" id="user" placeholder="User" maxlength="128"/>
                </div>
                <br>
                <div id="campoLogin">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" placeholder="Password" required maxlength="32"/>
                </div>
                <div id="campoLogin">
                    <input id="botonLogin" class="boton" type="submit" value="Login" required>
                </div>
            </form>

        </div>
    </div>
    <div id="seccionMensaje">
        <div id="bloqueMensaje">
					<span id="titulo">
						Sistema de Administración
					</span>
            <span id="mensaje">
						<i class="fa fa-user"></i> Login
					</span>
            <span id="descripcion">
						Sistema exclusivo para personal autorizado
					</span>
        </div>
    </div>
</div>

</body>
</html>
