<?php 
require('incc/dbconfig.php');
$query = "SELECT * FROM register";
$result = mysqli_query($con, $query);
if (!$result) {
    die("Query Failed: " . mysqli_error($con));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Account</title>
    <?php require('incc/link.php'); ?>
</head>
<body>
<?php require('header.php'); ?>
    <div class="bg-dark">
        <div class="container">
            <div class="row mt-5">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="display-6 text-center">REGISTERED ACCOUNT</h2>

                            <form action="" method="GET" class="mt-4">
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="Search by phone number..." name="phone_search">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered text-center">
                                <tr class="bg-dark text-white">
                                    <td>No</td>
                                    <td>FULLNAME</td>
                                    <td>PHONENUMBER</td>
                                    <td>EMAIL</td>
                                    <td>EDIT</td>
                                    <td>DELETE</td>
                                </tr>
                                <?php
                                if (isset($_GET['phone_search']) && $_GET['phone_search'] != "") {
                                    $phone_search = $_GET['phone_search'];
                                    $search_query = "SELECT * FROM register WHERE PHONENUMBER = '$phone_search'";
                                    $search_result = mysqli_query($con, $search_query);
                                    if (!$search_result) {
                                        die("Search Query Failed: " . mysqli_error($con));
                                    }

                                    if (mysqli_num_rows($search_result) > 0) {
                                        while ($row = mysqli_fetch_assoc($search_result)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['NO']; ?></td>
                                                <td><?php echo $row['FULLNAME']; ?></td>
                                                <td><?php echo $row['PHONENUMBER']; ?></td>
                                                <td><?php echo $row['EMAIL']; ?></td>
                                                <td><a href="#" class="btn btn-primary">Edit</a></td>
                                                <td><a href="#" class="btn btn-primary">Delete</a></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="6">No record found for this phone number. Displaying all records below:</td></tr>';
                                        $default_result = mysqli_query($con, $query);
                                        while ($row = mysqli_fetch_assoc($default_result)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['NO']; ?></td>
                                                <td><?php echo $row['FULLNAME']; ?></td>
                                                <td><?php echo $row['PHONENUMBER']; ?></td>
                                                <td><?php echo $row['EMAIL']; ?></td>
                                                <td><a href="#" class="btn btn-primary">Edit</a></td>
                                                <td><a href="#" class="btn btn-primary">Delete</a></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                } else {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['NO']; ?></td>
                                            <td><?php echo $row['FULLNAME']; ?></td>
                                            <td><?php echo $row['PHONENUMBER']; ?></td>
                                            <td><?php echo $row['EMAIL']; ?></td>
                                            <td><a href="#" class="btn btn-primary">Edit</a></td>
                                            <td><a href="#" class="btn btn-primary">Delete</a></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </table>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</body>
</html>
