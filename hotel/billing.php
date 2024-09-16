<?php
session_start();

$room = isset($_GET['room']) ? htmlspecialchars($_GET['room']) : 'Not specified';
$price = isset($_GET['price']) ? floatval($_GET['price']) : 0.00;
$successMessage = "";
$errorMessage = "";
$referenceNumber = rand(100000, 999999); 

if (isset($_POST['bsubmit'])) {
    $referenceNumber = $_POST['brefno'];
    $roomtype    = $_POST['broomtype'];
    $price       = floatval(str_replace('$', '', $_POST['bprice']));
    $fullname    = $_POST['bfullname'];
    $address     = $_POST['baddress'];
    $phonenumber = $_POST['bphone'];
    $noofroom    = intval($_POST['bnumberofrooms']);
    $checkin     = $_POST['bcheckin'];
    $checkout    = $_POST['bcheckout'];
    $totalprice  = floatval(str_replace('$', '', $_POST['btotalprice']));

    $error = array();
    if (empty($fullname) || empty($phonenumber) || empty($address) || empty($noofroom) || empty($checkin) || empty($checkout)) {
        array_push($error, "All text fields are required.");
    }

    if (empty($error)) {
        require_once "database.php";
        if (!$con) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO billinginfo (REFERENCENO,ROOMTYPE, PRICE, FULLNAME, ADDRESS, PHONENUMBER, NOOFROOM, CHECKIN, CHECKOUT, TOTALPRICE) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($con);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "isdsssissd",$referenceNumber, $roomtype, $price, $fullname, $address, $phonenumber, $noofroom, $checkin, $checkout, $totalprice);
            if (mysqli_stmt_execute($stmt)) {
                $successMessage = "<script>
                alert('Booked successfully. Please note your reference number: $referenceNumber');
                window.location.href='index.php';
            </script>";
            } else {
                $errorMessage = "<div class='alert alert-danger'>Execute failed: " . mysqli_stmt_error($stmt) . "</div>";
            }
        } else {
            $errorMessage = "<div class='alert alert-danger'>Prepare failed: " . mysqli_error($con) . "</div>";
        }
        mysqli_close($con);
    } else {
        $errorMessage = "<div class='alert alert-danger'>" . implode("<br>", $error) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function calculateTotal() {
            var pricePerNight = parseFloat(document.getElementById('price').value.replace('$', ''));
            var numberOfRooms = parseInt(document.getElementById('numberofrooms').value);
            var totalPrice = pricePerNight * numberOfRooms;
            document.getElementById('totalprice').value = '$' + totalPrice.toFixed(2);
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <?php echo $successMessage; ?>
        <?php echo $errorMessage; ?>
        <h2>Billing Information</h2>
        <form method="POST">
            <div class="form-row mb-3">
                <div class="form-group col-md-12">
                    <label for="roomtype">Room Type</label>
                    <input type="text" class="form-control" id="roomtype" name="broomtype" value="<?php echo $room; ?>" readonly>
                </div>
                <div class="form-group col-md-12">
                    <label for="price">Price per Night</label>
                    <input type="text" class="form-control" id="price" name="bprice" value="$<?php echo number_format($price, 2); ?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="brefno">Reference Number</label>
                <input type="text" class="form-control" id="brefno" name="brefno" value="<?php echo $referenceNumber; ?>" readonly>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fullname">Full Name</label>
                    <input type="text" class="form-control" id="fullname" name="bfullname" placeholder="Full Name">
                </div>
                <div class="form-group col-md-6">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="baddress" placeholder="Address">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="phone">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="bphone" placeholder="Phone Number">
                </div>
                <div class="form-group col-md-4">
                    <label for="numberofrooms">Number of Rooms</label>
                    <input type="number" class="form-control" id="numberofrooms" name="bnumberofrooms" placeholder="Number of Rooms" oninput="calculateTotal()">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="checkin">Check-in Date</label>
                    <input type="date" class="form-control" id="checkin" name="bcheckin">
                </div>
                <div class="form-group col-md-6">
                    <label for="checkout">Check-out Date</label>
                    <input type="date" class="form-control" id="checkout" name="bcheckout">
                </div>
            </div>

            <div class="form-row mb-3">
                <div class="form-group col-md-12">
                    <label for="totalprice">Total Price</label>
                    <input type="text" class="form-control" id="totalprice" name="btotalprice" readonly>
                </div>
            </div>
            <button type="submit" name="bsubmit" class="btn btn-primary">BOOK NOW</button>
            <button type="button" class="btn btn-success" onclick="validateAndRedirect()">Pay with Khalti</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    function validateAndRedirect() {
    var fullname = document.getElementById('fullname').value;
    var address = document.getElementById('address').value;
    var phone = document.getElementById('phone').value;
    var numberOfRooms = document.getElementById('numberofrooms').value;
    var checkin = document.getElementById('checkin').value;
    var checkout = document.getElementById('checkout').value;
    var totalPrice = document.getElementById('totalprice').value;
    var roomType = document.getElementById('roomtype').value;
    var referenceNumber = document.getElementById('brefno').value; 

    if (!fullname || !address || !phone || !numberOfRooms || !checkin || !checkout) {
        alert("All fields are required before proceeding to payment.");
        return false;
    }
    window.location.href = "khalti.php?roomtype=" + encodeURIComponent(roomType) +
                       "&totalprice=" + encodeURIComponent(totalPrice) +
                       "&noofrooms=" + encodeURIComponent(numberOfRooms) +
                       "&referenceNumber=" + encodeURIComponent(referenceNumber) +
                       "&fullname=" + encodeURIComponent(fullname) +              
                       "&phone=" + encodeURIComponent(phone);         

}
</script>
</body>
</html>
