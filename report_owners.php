<?php
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
include 'dbconnect.php';
$query = "SELECT * FROM `tbl_user` where user_type =2";
$result = mysqli_query($con, $query);
$users = mysqli_fetch_array($result);
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
$bill_html .= '<div class="bill">';
$bill_html .= '<h1>User Details</h1>';
$bill_html .= '<table border="1">';
$bill_html .= '<tr><th>Join Date</th><th>Name</th><th>location</th><th>DOB</th><th>Email</th><th>Phone</th></tr>';
while($users=mysqli_fetch_array($result)){
$bill_html .= '<tr><td>12/09/9980</td><td>'. $users['first_name'].'</td><td>'. $users['location'].'</td><td>'. $users['dob'].'</td><td>'. $users['email'].'</td><td>'. $users['mobile'].'</td></tr>';
}
$bill_html .= '</table></div></div></body></html>';


// Send bill to browser for download
header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename="bill.pdf"');
$dompdf->loadHtml($bill_html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Output the generated PDF to the browser
$dompdf->stream('bill.pdf', array('Attachment' => false));
