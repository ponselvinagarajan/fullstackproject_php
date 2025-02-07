<?php
$conn = new mysqli("localhost", "root", "", "image name_project");

// Check if 'id' is set in URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM userdata WHERE id=$id";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "User not found!";
        exit;
    }
}

// Handle Update Request
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    
    // Handle Image Upload
    // if (!empty($_FILES["image"]["name"])) {
        $image_name = $_FILES["image"]["name"];
        $upload_dir = "uploads/";
        $image_path = $upload_dir . basename($image_name);
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
            $updateSQL = "UPDATE userdata SET name='$name', image_path='$image_path' WHERE id=$id";
        } else {
            echo "File upload failed.";
            exit;
        }
    // } else {
        // Update only name if no new image is uploaded
        // $updateSQL = "UPDATE userdata SET name='$name' WHERE id=$id";
    // }
    
    if ($conn->query($updateSQL) === TRUE) {
        echo "<script>alert('Record Updated Successfully!'); window.location='index.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Edit User Details</h2>
        <form method="POST" action="edit.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            
            <div class="mb-3">
                <label>Name:</label>
                <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" required>
            </div>
            
            <div class="mb-3">
                <label>Current Image:</label><br>
                <img src="<?php echo $row['image_path']; ?>" style="width: 100px; height: 100px; object-fit: cover;" alt="User Image">
            </div>
            
            <div class="mb-3">
                <label>Upload New Image (optional):</label>
                <input type="file" class="form-control" name="image">
            </div>
            
            <button type="submit" name="update" class="btn btn-success">Update</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
