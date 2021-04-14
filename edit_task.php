<?php


include("database/db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM task WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $title = $row['title'];
        $description = $row['description'];
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $query = "UPDATE task SET title='$title', description='$description' WHERE id = '$id'";
    mysqli_query($conn, $query);

    
    $_SESSION['message'] = 'Task updated successfully';
    $_SESSION['message_type'] = 'warning';
    header("Location: ./index.php");
}


?>

<?php include("includes/header.php") ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4 auto">
            <div class="card card-body">
                <form action="./edit_task.php?id=<?php echo $_GET['id'] ?>" method="POST">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" value="<?php echo $title; ?>" placeholder="Update title">
                    </div>
                    <div class="form-group">
                        <textarea name="description" class="form-control" rows="2" placeholder="Update Description"><?php echo $description; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-success" name="update">
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>