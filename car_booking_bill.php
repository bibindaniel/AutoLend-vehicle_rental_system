<?php
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$con = mysqli_connect("localhost", "root", "", "mini-prj");
$booking_id = $_GET['booking_id'];
$query = "SELECT tbl_vehicle.*,tbl_vehicle_booking.*FROM tbl_vehicle_booking JOIN tbl_vehicle ON tbl_vehicle_booking.vehicle_id=tbl_vehicle.vehicle_id WHERE tbl_vehicle_booking.booking_id=$booking_id";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$user_id = $row["user_id"];
$query = "SELECT * FROM `tbl_user` WHERE `user_id`=$user_id";
$res = mysqli_query($con, $query);
$user = mysqli_fetch_array($res);
$start_date = $row['start_date'];
$end_date = $row['end_date'];


$start_timestamp = strtotime($start_date);
$end_timestamp = strtotime($end_date);


$time_diff = $end_timestamp - $start_timestamp;


$days = round($time_diff / (60 * 60 * 24));

if ($days == 0) {

    $days = 1;
}

$rent_per_day = $row['rate'];


$total_rent = $days * $rent_per_day;
$status = $row['booking_status'];
if($status==4){
    $b_status="canceled";
}elseif($status==3){
    $b_status="completed";
}else{
    $b_status="On going";
}

// Generate bill
$bill_html = '<html><head>';
$bill_html .= '<style type="text/css">
                  /* Style the header section */
                  .header {
                    text-align: center;
                    margin-bottom: 30px;
                  }
                  .header img {
                    height: 80px;
                    margin-right: 20px;
                    vertical-align: middle;
                  }
                  .header h2 {
                    font-size: 36px;
                    margin: 0;
                    display: inline-block;
                    vertical-align: middle;
                  }
                  .header p {
                    font-size: 18px;
                    margin: 5px 0;
                    color: #333;
                  }
                  
                  /* Style the bill section */
                  .bill {
                    margin-bottom: 30px;
                  }
                  .bill h1 {
                    font-size: 30px;
                    margin-bottom: 20px;
                    color: #333;
                  }
                  .bill p {
                    font-size: 20px;
                    margin-bottom: 10px;
                    color: #333;
                  }
                  
                  /* Style the border */
                  .bill-wrapper {
                    border: 1px solid #000;
                    padding: 10px;
                    border-style: double;
                    border-width: thick;
                  }
                  table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 30px;
                  }
                  table td:first-child {
                    font-weight: bold;
                    padding-right: 10px;
                  }
                  table td:last-child {
                    text-align: right;
                  }
                </style>';
$bill_html .= '</head><body>';
$bill_html .= '<div class="bill-wrapper">';
$bill_html .= '<div class="header">
                  <h2>Autolend</h2>
                  <p>123 Main Street<br>
                     Anytown, USA 12345<br>
                     Phone: 123-456-7890<br>
                     Email: info@autolend.com</p>
                </div><hr>';
$bill_html .= '<h1>User Details</h1>';
$bill_html .= '<table>';

$bill_html .= '<tr><td>Name</td><td>' . $user['first_name'] . '</td></tr>';
$bill_html .= '<tr><td>Phone</td><td>' . $user['mobile'] . '</td></tr>';
$bill_html .= '<tr><td>Email</td><td>' . $user['email'] . '</td></tr>';
$bill_html .= '<tr><td>Address</td><td>' . $user['location'] . '</td></tr>';

$bill_html .= '</table><hr>';
$bill_html .= '<div class="bill">';
$bill_html .= '<h1>Booking Details</h1>';
$bill_html .= '<table>';
$bill_html .= '<tr><td>Booking status</td><td style="text-align:right">' . $b_status . '</td></tr>';
$bill_html .= '<tr><td>Vehicle</td><td style="text-align:right">' . $row['brand_name'] . ' ' . $row['model_name'] . '</td></tr>';
$bill_html .= '<tr><td>Booked date</td><td style="text-align:right">' . $row['booking_date'] . '</td></tr>';
$bill_html .= '<tr><td>start Date</td><td style="text-align:right">' . $row['start_date'] . ' - ' . $row['drop_in_time'] . '</td></tr>';
$bill_html .= '<tr><td>End Date</td><td style="text-align:right">' . $row['end_date'] . ' - ' . $row['drop_of_time'] . '</td></tr>';
$bill_html .= '<tr><td>Pick-up Location</td><td style="text-align:right">' . $row['drop_in_location'] . ' </td></tr>';
$bill_html .= '<tr><td>Drop-off Location</td><td style="text-align:right">' . $row['drop_of_location'] . ' </td></tr>';
$bill_html .= '<tr><td>Rent per day</td><td style="text-align:right">' . $rent_per_day . '</td></tr>';
$bill_html .= '<tr><td>Total days of rent</td><td style="text-align:right">' . $days . '</td></tr>';
if ($status == 4) {
    $bill_html .= '<tr><td>Amount refunded</td><td style="text-align:right">' . $total_rent*0.9 . '</td></tr>';
}
if ($status == 4) {
    $total_rent = $total_rent * 0.1;
}
$bill_html .= '<tr><td>Total Amount</td><td style="text-align:right">' . $total_rent . '</td></tr>';
$bill_html .= '</table></div></div></body></html>';


// Send bill to browser for download
header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename="bill.pdf"');
$dompdf->loadHtml($bill_html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Output the generated PDF to the browser
$dompdf->stream('bill.pdf', array('Attachment' => false));
