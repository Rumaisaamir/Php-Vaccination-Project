<?php
session_start();
if (!isset($_COOKIE['CenterUserName']) || !isset($_COOKIE['HospitalStatus']) || !isset($_COOKIE['CenterSessionID'])) {
  header('location: center_login.php');
  die();
};

$_SESSION['CenterSessionID'] = $_COOKIE['CenterSessionID'];
$_SESSION['CenterUserName'] = $_COOKIE['CenterUserName'];
$_SESSION['HospitalStatus'] = $_COOKIE['HospitalStatus'];
$Hospital_Name = $_SESSION['CenterUserName'];
$Center_ID = $_SESSION['CenterSessionID'];
?>

<?php
require '../Fpdf/fpdf.php';
include "config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

// if (!isset($_GET['appointment_id'])) {
//     die("Appointment ID is not set.");
// }

// Fetch data from the users table
$appointment_id = $_GET['appointment_id'];
$action = isset($_GET['action']) ? $_GET['action'] : 'view'; // Default action is view

$sql = "SELECT name, email, age, appointment_id, date_of_vaccination, gender, contact_number, dosage, vaccination_type, result, preferred_center FROM vaccination_reports WHERE appointment_id = $appointment_id";
$result = $con->query($sql);

$vaccination_data = array();
while ($row = $result->fetch_assoc()) {
    $email = $row['email'];
    $name = $row['name'];
    $vaccination_data[] = $row;
}

if (!empty($vaccination_data)) {
    $data = $vaccination_data[0]; // Assuming only one record is fetched

    class PDF extends FPDF {
        protected $center;

        function __construct($center) {
            parent::__construct();
            $this->center = $center;
        }

        function header() {
            // Header content
            $this->SetFillColor(200, 220, 255); // Light blue background color
            $this->SetFont('Arial', 'B', 15);
            $this->Cell(0, 10, 'VaxEaseOnline', 0, 1, 'C', true); // First heading
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0, 10, $this->center . '                                                             
            Vaccination Report', 0, 1, 'C', true); // Second heading
            $this->Ln(10);
        }

        function footer() {
            // Footer content
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' / {nb}', 0, 0, 'C');
        }
    }

    $pdf = new PDF($data['preferred_center']);
    $pdf->SetTitle("VaxEaseOnline"); // Set the title
    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->SetFont('Arial', '', 12);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetX(10); // Left margin
    $pdf->Cell(78, 10, 'Name', 0, 0);
    $pdf->Cell(78, 10, 'Age', 0, 0);
    $pdf->Cell(78, 10, 'Appointment ID', 0, 1);

    $pdf->SetFont('Arial', '', 12);
    $pdf->SetX(10); // Left margin
    $pdf->Cell(78, 3, $data['name'], 0, 0);
    $pdf->Cell(78, 3, $data['age'], 0, 0);
    $pdf->Cell(78, 3, $data['appointment_id'], 0, 1);

    $pdf->Ln();

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetX(10); // Left margin
    $pdf->Cell(78, 10, 'Date of Vaccination', 0, 0);
    $pdf->Cell(78, 10, 'Gender', 0, 0);
    $pdf->Cell(78, 10, 'Contact No.', 0, 1);

    $pdf->SetFont('Arial', '', 12);
    $pdf->SetX(10); // Left margin
    $pdf->Cell(78, 3, $data['date_of_vaccination'], 0, 0);
    $pdf->Cell(78, 3, $data['gender'], 0, 0);
    $pdf->Cell(78, 3, $data['contact_number'], 0, 1);

    // Vaccination Record
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Vaccination Record', 0, 1);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(25, 10, 'Dosage', 1, 0, 'C');
    $pdf->Cell(68, 10, 'Manufacturer', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Result', 1, 0, 'C');
    $pdf->Cell(67, 10, 'Hospital', 1, 1, 'C');

    $pdf->SetFont('Arial', '', 12);

    foreach ($vaccination_data as $data) {
        $pdf->Cell(25, 10, $data['dosage'], 1, 0, 'C');
        $pdf->Cell(68, 10, $data['vaccination_type'], 1, 0, 'C');
        $pdf->Cell(30, 10, $data['result'], 1, 0, 'C');
        $pdf->Cell(67, 10, $data['preferred_center'], 1, 1, 'C');
    }

    // Additional information
    $pdf->Ln(10);
    $pdf->MultiCell(0, 6, "Please keep this report, it includes the medical information, details and the vaccine you have received. This report will show the next schedule of your vaccine. It is important to show this report to the next vaccination schedule for health officials to verify.");
    $pdf->Ln(); // Add an empty line for spacing
    $pdf->Ln(); // Add an empty line for spacing

    $pdf->SetFillColor(200, 220, 255); // Light blue background color
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Vaccination Report Card', 0, 1, 'C', true); // 'true' parameter sets fill color

    $pdf->Ln(); // Add an empty line for spacing
    $pdf->SetFont('Arial', 'B', 12); // Setting font to bold
    $pdf->Cell(0, 10, 'Reminder:', 0, 1);
    $pdf->SetFont('Arial', '', 12); // Setting font back to normal
    $pdf->MultiCell(0, 6, "Please return to your second vaccination schedule. \nPlease bring this card for your next schedule of vaccines. \nAlways check with the health workers and verify all information is correct so you won't miss the next dose.");
    $pdf->Ln(); // Add an empty line for spacing

    if ($action == 'send_email') {
        // Generate PDF as string
        $pdfdoc = $pdf->Output('', 'S');
        
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'vaxease@gmail.com';
            $mail->Password = 'mcqa kvmh ruiq esvx';
            $mail->Port = 465;
            $mail->SMTPSecure = 'ssl';

            // Recipients
            $mail->setFrom('vaxease@gmail.com' ,$Hospital_Name);
            $mail->addAddress($email); // Add a recipient

            // Attachments
            $mail->addStringAttachment($pdfdoc, 'Vaccination_Report.pdf'); // Add attachment

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Vaccination Report';
            $mail->Body = "
            <html>
            <body>
                <p>Dear $name,</p>
                <p>We hope this email finds you well.</p>
                <p>Please find attached your COVID-19 Vaccination Report.</p>
                <p>Thank you.</p>
                <p>Best regards,<br>$Hospital_Name</p>
            </body>
            </html>";

            $mail->send();

            $sql = "UPDATE users u
            JOIN vaccination_reports vr ON u.appointment_id = vr.appointment_id
            SET u.send_report = 'Send', vr.send_report = 'Send'
            WHERE u.appointment_id = ?";
    
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $appointment_id);
    $stmt->execute();
              
              $_SESSION['send_message'] = "Patient's vaccination report has been successfully emailed.";
              header("Location: vaccinated_appointments.php"); 

            // echo '<script>alert("Patient\'s vaccination report has been successfully emailed."); window.location.href = "vaccinated_appointments.php";</script>';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        // Set headers for download or view
        if ($action == 'download') {
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="Vaccination_Report.pdf"');
            $pdf->Output('D', 'Vaccination_Report.pdf');
        } else {
            header('Content-Type: application/pdf');
            $pdf->Output('I', 'Vaccination_Report.pdf');
        }
    }
}

// Close database connection
$con->close();
?>