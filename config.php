<?php 
$conn = new mysqli("localhost", "root", "", "image name_project");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the name input
    $name = $_POST["name"];

    // Handle Image Upload
    if (!empty($_FILES["image"]["name"])) {
        $image_name = $_FILES["image"]["name"];
        $upload_dir = "uploads/";
        $image_path = $upload_dir . basename($image_name);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
            // Use Prepared Statement for Security
            $stmt = $conn->prepare("INSERT INTO userdata (name, image_path) VALUES (?, ?)");
            $stmt->bind_param("ss", $name, $image_path);

            if ($stmt->execute()) {
                echo "✅ Form submitted successfully!";
            } else {
                echo "❌ SQL Error: " . $conn->error;
            }

            $stmt->close();
        } else {
            echo "❌ File upload failed.";
        }
    } else {
        echo "❌ No file selected.";
    }
}

$conn->close();
?>
