<?php
include "../Connent/connent.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $subjectId = isset($_POST['subjectId']) ? mysqli_real_escape_string($connect, $_POST['subjectId']) : '';
    $subjectName = isset($_POST['subjectName']) ? mysqli_real_escape_string($connect, $_POST['subjectName']) : '';

    // Update data in the database using Prepared Statements
    $stmt = $connect->prepare("UPDATE subjects SET subject_Name=? WHERE subject_Id=?");

    // Check if the prepare statement succeeded
    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("si", $subjectName, $subjectId); // Use "si" for string, integer

        if ($stmt->execute()) {
            // Redirect to the page after successful update
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Error executing statement: " . $stmt->error;
        }
    } else {
        echo "Error preparing statement: " . $connect->error;
    }
}

// Close the database connection
$connect->close();
?>
