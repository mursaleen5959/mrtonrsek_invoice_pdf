<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('db.php');

if(isset($_POST['delete'])){
    $image_id = mysqli_real_escape_string($conn, $_POST['image_id']);
    
    // Retrieve the image name from the database using the image ID
    $sql = "SELECT `image` FROM images WHERE id = $image_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $image_name = $row['image'];
    
    // Delete the image file from the server's file system
    unlink("images/$image_name");
    
    // Delete the image record from the database
    $sql = "DELETE FROM images WHERE id = $image_id";
    mysqli_query($conn, $sql);
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload with Bootstrap 5</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link href="assets/css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="container mt-5">
        <div class="form-div pt-4 ps-4 pe-4 pb-4">
            <?php
            // Check if the form has been submitted
            if (isset($_POST['submit'])) {

                // Define a target directory to store uploaded images
                $target_dir = "images/";

                // Get the name of the uploaded file
                $filename = basename($_FILES["image"]["name"]);

                // Define a target file path for the uploaded image
                $target_file = $target_dir . $filename;

                // Check if the file is an actual image or fake image
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if ($check !== false) {

                    // If it's a real image, move it to the target directory
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        // Prepare a SQL statement to insert the image name
                        $sql = "INSERT INTO images (image) VALUES ('$filename')";

                        // Execute the SQL statement
                        if (mysqli_query($conn, $sql)) {
                            echo '<div class="alert alert-success mt-3" role="alert">The image ' . $filename . ' has been uploaded and inserted into the database.</div>';
                        } else {
                            echo '<div class="alert alert-danger mt-3" role="alert">Sorry, there was an error uploading your file and inserting into the database.</div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger mt-3" role="alert">Sorry, there was an error uploading your file.</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger mt-3" role="alert">File is not an image.</div>';
                }
            }
            ?>
            <h1 class="mb-4 ms-4">Image Upload</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" class="mb-4">
                <div class="mb-3">
                    <label for="image" class="form-label">Select image to upload:</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Upload Image</button>
            </form>

            <hr>


            <h1 class="mt-4 mb-4">Images from Database</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // Prepare a SQL statement to select images from the database
                    $sql = "SELECT * FROM images";

                    // Execute the SQL statement and get the result set
                    $result = mysqli_query($conn, $sql);

                    // Loop through the result set and display images in a table row
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['id'] . '</td>';
                            echo '<td>' . $row['image'] . '</td>';
                            echo '<td><img src="images/' . $row['image'] . '" class="img-thumbnail" width="100"></td>';
                            echo '<td>';
                            echo '<form method="post">';
                            echo '<input type="hidden" name="image_id" value="' . $row['id'] . '">';
                            echo '<button type="submit" name="delete" class="btn btn-danger"> <i class="fa-solid fa-trash"></i> &nbsp; Delete</button>';
                            echo '</form>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="3" class="text-center">No images found.</td></tr>';
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap 5 JavaScript -->
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
// Close the database connection
mysqli_close($conn);

?>