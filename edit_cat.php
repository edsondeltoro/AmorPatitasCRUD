<?php
global $conn;
include("db.php");
$name = '';
$image= '';

if  (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM gatos WHERE id=$id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $name = $row['name'];
        $image = $row['image'];
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $name= $_POST['name'];
    $image = $_POST['image'];

    $query = "UPDATE gatos set name = '$name', image = '$image' WHERE id=$id";
    mysqli_query($conn, $query);
    $_SESSION['message'] = 'Los datos se actualizarón';
    $_SESSION['message_type'] = 'warning';
    $token = bin2hex(random_bytes(16));
    $_SESSION['token'] = $token;
    setcookie('session_token', $token, time() + 3600, '/');
    header('Location: tablagatos.php');
}

?>
<?php include('includes/header.php'); ?>

    <div class="container p-4">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card card-body">
                    <form action="edit_cat.php?id=<?php echo $_GET['id']; ?>" method="POST">
                        <div class="form-group">
                            <label>
                                <input name="name" type="text" class="form-control" value="<?php echo $name; ?>" placeholder="Actualizar nombre">
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                <textarea name="image" class="form-control" cols="30" rows="10"><?php echo $image; ?></textarea>
                            </label>
                        </div>
                        <button class="btn-success" name="update">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include('includes/footer.php'); ?>