<?php
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;
$id=$_GET['id'];
$dompdf = new Dompdf();
include 'dbconnect.php';
$query = "SELECT tbl_vehicle_booking.start_date, tbl_vehicle_booking.end_date, tbl_user.first_name,tbl_user.mobile, tbl_payment.amount
FROM tbl_vehicle_booking
JOIN tbl_user ON tbl_vehicle_booking.user_id = tbl_user.login_id
JOIN tbl_payment ON tbl_vehicle_booking.booking_id = tbl_payment.request_id
WHERE tbl_vehicle_booking.vehicle_id = $id";
$result = mysqli_query($con, $query);

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
                    text-align: center; 
                  }
                  thead th {
                    text-align: center; 
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
$bill_html .= '<h1>Rent Details</h1>';
$bill_html .= '<table>';
$bill_html .= '</table>';
$bill_html .= '<table>';
$bill_html .= '<thead><tr><th>Start Date</th><th>End Date</th><th>User Name</th><th>Phone</th><th>Amount</th></tr></thead>';
$bill_html .= '<tbody>';
$total_amount =0;
// Loop through each booking and add it to the report
while ($row = mysqli_fetch_assoc($result)) {
  $bill_html .= '<tr>';
  $bill_html .= '<td>' . $row['start_date'] . '</td>';
  $bill_html .= '<td>' . $row['end_date'] . '</td>';
  $bill_html .= '<td>' . $row['first_name'] . '</td>';
  $bill_html .= '<td>' . $row['mobile'] . '</td>';
  $bill_html .= '<td style="text-align:right">' . $row['amount'] . '</td>';
  $bill_html .= '</tr>';
  
  // Add the booking amount to the total amount
  $total_amount += $row['amount'];
} 

// Close the table and display the total amount
$bill_html .= '</tbody>';
$bill_html .= '<tfoot><tr><td colspan="4" style="text-align:right">Total Amount:</td><td style="text-align:right">' . $total_amount . '</td></tr></tfoot>';
$bill_html .= '</table>';
$bill_html .= '</div></div></body></html>';

// Send bill to browser for download
header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename="bill.pdf"');
$dompdf->loadHtml($bill_html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Output the generated PDF to the browser
$dompdf->stream('bill.pdf', array('Attachment' => false));
