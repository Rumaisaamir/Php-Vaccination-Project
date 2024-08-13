<?php
session_start();
?>

<?php
include "config.php";

if (isset($_POST['vaccinated'])) {
    $update_id = $_POST['id'];
    $update_query = "UPDATE users SET appointment = 'Vaccinated' WHERE UserID = '$update_id'";
    $query_updated = $con->query($update_query);

    if ($query_updated) {
        $_SESSION['vaccinated_message'] = "Patient vaccinated successfully!";
        header("Location: generate_report.php"); 

        // echo "<script>
        //     alert('Patient vaccinated successfully!');
        //     window.location.href = 'generate_report.php';
        // </script>";
        exit; // Make sure to exit after redirection
    } else {
        echo "Error updating record: " . $con->error;
    }
}
?>