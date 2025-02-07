<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fullstack_project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <main>
        <div class="component">
            <div class="container my-4">
                <div class="row">
                    <div class="col-4">
                        <div class="colSub border border-white bg-white shadow ">
                            <h1 class="text-center text-primary">Personal_Data</h1>
                            <form action="config.php" method="POST" class="px-5 " enctype="multipart/form-data">
                                <div class="form-group w-100">
                                    <label for="name" class="mb-2 fw-bold">Name:</label><br>
                                    <input type="text" id="name" class="w-100 mb-3" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="mb-2 fw-bold">Select Image:</label><br>
                                    <input type="file" id="image" name="image" class="w-100 mb-3" accept="image/*"
                                        required>
                                </div>
                                <button type="submit" class="mb-3 bg-info border border-info text-white">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-8">
                        <table class="border border-dark table-striped w-100 ">
                            <thead class="border border-dark bg-dark text-white">
                                <tr class="text-center">
                                    <th class="border border-dark py-3 px-2" style="width:20%">ID</th>
                                    <th class="border border-dark" style="width:20%">Image</th>
                                    <th class="border border-dark" style="width:20%">Name</th>
                                    <th class="border border-dark" style="width:20%">button</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php
                                    $conn = new mysqli("localhost", "root", "", "image name_project");
                                    $sql = "SELECT * FROM userdata";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // Loop through the result and output each row
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td class='border border-dark'>" . $row["id"] . "</td>";
                                            echo "<td class='border border-dark'><img src='" . $row["image_path"] . "' class='rounded-circle border-white border d-inline' style=width:20%; height:8%; object-fit:cover;' alt=''></td>";
                                            echo "<td class='border border-dark'>" . $row["name"] . "</td>";
                                            echo "<td class='border border-dark'>
                                                <a href='edit.php?id=" . $row['id'] . "' class='bg-success border border-success text-white p-2 mx-2 text-decoration-none' 
                                                onclick=\"return confirm('Are you sure you want to edit?')\">EDIT</a>  
                                                <a href='delete.php?id=" . $row['id'] . "' class='bg-danger border border-danger text-white p-2 text-decoration-none' 
                                                 onclick=\"return confirm('Are you sure you want to delete?')\">DELETE</a>
                                                </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No data available</td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row shadow my-4 pb-4">
                    <h1 class="text-center bg-danger-subtle py-2">Card_Details</h1>
                    <?php
                    $conn = new mysqli("localhost", "root", "", "image name_project");
                    $sql = "SELECT * FROM userdata";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="col-3 shadow p-4 my-4 mx-2 d-flex justify-content-center align-items-center flex-column">';
                            echo '<div class="card-img-top d-flex align-items-center justify-content-center">';
                            echo '<img src="' . $row["image_path"] . '" alt="User Image" style="width: 100px; height: 100px; object-fit: cover;">';
                            echo '</div>';
                            echo '<div class="card-body text-center">';
                            echo '<h2>' . $row["name"] . '</h2>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<div>No data available</div>';
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>