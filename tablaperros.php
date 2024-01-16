<?php global $conn;
include("db.php"); 

if (!isset($_SESSION['token'])) {
    header("Location: login.php");
    exit();
}

$token = bin2hex(random_bytes(16));
$_SESSION['token'] = $token;
setcookie('session_token', $token, time() + 3600, '/');

include('includes/header.php');
?>

    <main class="container p-4">
        <div class="row">
            <div class="col-md-4">
                <!-- MESSAGES -->

                <?php if (isset($_SESSION['message'])) { ?>
                    <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                        <?= $_SESSION['message']?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php session_unset(); } ?>

                <!-- ADD PET FORM -->
                <div class="card card-body">
                    <form action="save_dog.php" method="POST">
                        <div class="form-group">
                            <label>
                                <input type="text" name="name" class="form-control" placeholder="Nombre del perro" autofocus>
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                <textarea name="image" rows="2" class="form-control" placeholder="Coloca aqui el link de la imagen"></textarea>
                            </label>
                        </div>
                        <input type="submit" name="save_dog" class="btn btn-success btn-block" value="Guardar">
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Fecha de creacion</th>
                        <th>Accion</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $query = "SELECT * FROM perros";
                    $result_perros = mysqli_query($conn, $query);

                    while($row = mysqli_fetch_assoc($result_perros)) { ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['image']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td>
                                <a href="edit_dog.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                                    <i class="fas fa-marker"></i>
                                </a>
                                <a href="delete_dog.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>


<?php include('includes/footer.php'); ?>