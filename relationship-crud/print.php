<?php
session_start();
require('fpdf/fpdf.php');
class PDF extends FPDF
{

    // Page header
    function Header()
    {
        include('inc/connect.php');
        $image = "SELECT image from user where id =  '" . $_SESSION['user'] . "'";
        $imgs = $con->query($image);
        if (is_object($imgs) && ($imgs->num_rows > 0)) {
            while ($row = $imgs->fetch_object()) {
                $img = $row;
            }
        }

        // Add logo to page
        $this->Image($img->image, 12, 8, 33);

        // Set font family to Arial bold
        $this->SetFont('Arial', 'B', 20);

        // Move to the right
        $this->Cell(80);

        // Header
        $this->Cell(50, 12, 'Resume', 1, 0, 'C');

        // Line break
        $this->Ln(20);
    }

    // Page footer
    function Footer()
    {

        // Position at 1.5 cm from bottom
        $this->SetY(-15);

        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);

        // Page number
        $this->Cell(0, 12, 'Page ' .
            $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
include('inc/connect.php');
$image = "SELECT * from user where id =  '" . $_SESSION['user'] . "'";
$imgs = $con->query($image);
if (is_object($imgs) && ($imgs->num_rows > 0)) {
    while ($row = $imgs->fetch_object()) {
        $img = $row;
    }
}

$countries = "SELECT countries.id,countries.name,user.id FROM countries,user WHERE user.id =  '" . $_SESSION['user'] . "' AND countries.id=user.country_id";
$country = $con->query($countries);
if (is_object($country) && ($country->num_rows > 0)) {
    while ($row = $country->fetch_object()) {
        $ctry = $row;
    }
}

$states = "SELECT states.id,states.name,user.id FROM states,user WHERE user.id =  '" . $_SESSION['user'] . "' AND states.id=user.state_id";
$state = $con->query($states);
if (is_object($state) && ($state->num_rows > 0)) {
    while ($row = $state->fetch_object()) {
        $st = $row;
    }
}

$qualification = "SELECT * FROM qualification WHERE user_id='" . $_SESSION['user'] . "'";
$quali = $con->query($qualification);
if (is_object($quali) && ($quali->num_rows > 0)) {
    while ($row = $quali->fetch_object()) {
        $qual = $row;
    }
}

$company = "SELECT * FROM company WHERE user_id='" . $_SESSION['user'] . "'";
$compa = $con->query($company);
if (is_object($compa) && ($compa->num_rows > 0)) {
    while ($row = $compa->fetch_object()) {
        $comp = $row;
    }
}

// Instantiation of FPDF class
$pdf = new PDF();

// Define alias for number of pages
$pdf->AliasNbPages();

$pdf->AddPage();

$pdf->SetFont('Times', '', 20);

$pdf->Cell(30,20," ",0,1);

$pdf->Cell(0, 12, "Name : ".$img->name, 0, 1);
$pdf->Cell(0, 12, "Email : ".$img->email, 0, 1);
$pdf->Cell(0, 12, "Language : ".$img->language, 0, 1);
$pdf->Cell(0, 12, "Gender : ".$img->gender, 0, 1);
$pdf->Cell(0, 12, "Date Of Birth : ".$img->dob, 0, 1);
$pdf->Cell(0, 12, "Country : ".$ctry->name, 0, 1);
$pdf->Cell(0, 12, "State : ".$st->name, 0, 1);
$pdf->Cell(0, 12, "Qualification : ".$qual->qualification, 0, 1);
$pdf->Cell(0, 12, "Year : ".$qual->year, 0, 1);
$pdf->Cell(0, 12, "Percentage : ".$qual->percentage, 0, 1);
$pdf->Cell(0, 12, "Company Name : ".$comp->name, 0, 1);
$pdf->Cell(0, 12, "Designation : ".$comp->role, 0, 1);
$pdf->Cell(0, 12, "Duration : ".$comp->time, 0, 1);

$pdf->Output();
