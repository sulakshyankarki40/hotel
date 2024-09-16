<?php
$roomtype = isset($_GET['roomtype']) ? ($_GET['roomtype']) : 'Not specified';
$totalprice = isset($_GET['totalprice']) ? floatval(str_replace('$', '', $_GET['totalprice'])) * 100 : 0; 
$fullname = isset($_GET['fullname']) ? ($_GET['fullname']) : 'Unknown';
$phone = isset($_GET['phone']) ? ($_GET['phone']) : '0000000000';
$noofroom = isset($_GET['numberofrooms']) ? ($_GET['numberofrooms']) : 1;
$referenceNumber = isset($_GET['referenceNumber']) ? ($_GET['referenceNumber']) : uniqid(); 
$purchase_order_id = $referenceNumber;

if ($totalprice < 1000 || $totalprice > 100000) { 
    echo "Sorry, the total amount must be between Rs 10.0 and Rs 1000.0.<br>";
    echo "Your total price: Rs " . number_format($totalprice / 100, 2) . "<br>";
    echo "Please contact support or use an alternative payment method.";
    exit;
}

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode(array(
        "return_url" => "http://localhost/hotel/index.php",
        "website_url" => "https://example.com/",
        "amount" => $totalprice,  
        "purchase_order_id" => $purchase_order_id,
        "purchase_order_name" => "Room Booking",
        "customer_info" => array(
            "name" => "$fullname",
            "email"=> "test@khalti.com",
            "phone" => "$phone"
        )
    )),
    CURLOPT_HTTPHEADER => array(
        'Authorization: Key 557b20a6b35c437f90cec30734693e75', 
        'Content-Type: application/json',
    ),
));

$response = curl_exec($curl);

if (curl_errno($curl)) {
    echo 'Error:' . curl_error($curl);
    exit;
}

curl_close($curl);
print($response);

$response_data = json_decode($response, true);

if (isset($response_data['payment_url'])) {
    header("Location: " . $response_data['payment_url']);
    exit;
} else {
    echo "Failed to initiate payment. Response: ";
    print_r($response_data);
    exit;
}
