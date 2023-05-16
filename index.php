<?php

include_once('db.php');

// Prepare a SQL statement to select images from the database
$sql = "SELECT * FROM images";

// Execute the SQL statement and get the result set
$result = mysqli_query($conn, $sql);


// Loop through the result set and display images in a table row
if (mysqli_num_rows($result) > 0) {
    $image_options = "<select class='form-select' name='image[]'>";

    while ($row = mysqli_fetch_assoc($result)) {
        $image_options .=  "<option value='{$row['image']}'>{$row['image']}</option>";
    }
    $image_options .= "</select>";
} else {
    echo '<tr><td colspan="3" class="text-center">No images found.</td></tr>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!--  meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title Page-->
    <title>PDF Generation FORM</title>

    <!-- Jquery JS-->
    <script src="assets/js/jquery.min.js"></script>

    <!-- Main CSS-->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link href="assets/css/main.css" rel="stylesheet" media="all">
</head>

<body>


    <div class="container mt-5">
        <h1 class="text-white mb-4">PDF Generation FORM</h1>

        <form action="pdf.php" method="post">
            <div class="form-div">
                <div class="row ms-4 me-4">
                    <h2 class="mt-2 fw-bold">Invoice to:</h2>
                    <div class="col-sm-4">
                        <div class="mb-3 mt-3">
                            <label for="companyname" class="form-label fw-bold">Company Name (optional):</label>
                            <input type="text" class="form-control" id="companyname" placeholder="Enter Company name" name="companyname">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3 mt-3">
                            <label for="customername" class="form-label fw-bold">Customer Name:<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" id="customername" placeholder="Enter Customer name" name="customername">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3 mt-3">
                            <label for="streetname" class="form-label fw-bold">Street Name & No#:<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" id="streetname" placeholder="Enter Street name" name="streetname">
                        </div>
                    </div>
                </div>
                <div class="row ms-4 me-4">
                    <div class="col-sm-2">
                        <div class="mb-3">
                            <label for="cityname" class="form-label fw-bold">City Name:<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" id="cityname" placeholder="Enter City name" name="cityname">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="mb-3">
                            <label for="countryname" class="form-label fw-bold">Country Name:<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" id="countryname" placeholder="Enter Country name" name="countryname">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="mb-3">
                            <label for="postalcode" class="form-label fw-bold">Postal Code:<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" id="postalcode" placeholder="Enter Postal code" name="postalcode">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="mb-3">
                            <label for="contact" class="form-label fw-bold">Contact Phone:<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" id="contact" placeholder="Enter Postal code" name="contact">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email (optional):</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter Postal code" name="email">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row ms-4 me-4">
                    <div class="col-sm-3">
                        <div class="mb-3 mt-3">
                            <label for="portloading" class="form-label fw-bold">Port of Loading:</label>
                            <input type="text" class="form-control" id="portloading" placeholder="Enter Port of loading" name="portloading">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="mb-3 mt-3">
                            <label for="portdestination" class="form-label fw-bold">Port of Destination:<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" id="portdestination" placeholder="Enter Street name" name="portdestination">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="mb-3 mt-3">
                            <label for="invoice" class="form-label fw-bold">Invoice Number:<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" id="invoice" placeholder="Enter Street name" name="invoice">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="mb-3 mt-3">
                        <label for="autofillDate" class="form-label fw-bold">Date (autofill current date):<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" id="autofillDate" value="<?php echo date('d/M/Y'); ?>" name="autoDate" readonly>
                        </div>
                    </div>
                </div>
                <div class="row ms-4 me-4">
                    <h2 class="mt-2 fw-bold">Products:</h2>
                    <div class="col-sm-3">
                        <div class="mb-3 mt-3">
                            <label for="payment" class="form-label fw-bold">Payment method:<span class="text-danger"> *</span></label>
                            <select class="form-select" id="payment" name="payment">
                                <option value="bank">Bank Transfer</option>
                                <option value="btc">Crypto BTC</option>
                                <option value="usdt">Crypto USDT</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="mb-3 mt-3">
                            <label for="discount" class="form-label fw-bold">Discount:<span class="text-danger"> *</span></label>
                            <input type="number" class="form-control" id="discount" name="discount">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="mb-3 mt-3">
                            <label for="currency" class="form-label fw-bold">Currency:<span class="text-danger"> *</span></label>
                            <select class="form-select" id="currency" name="currency">
                                <option value="dollar">Dollar - $</option>
                                <option value="euro">Euro - €</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="mb-3 mt-3">
                            <label for="noProducts" class="form-label fw-bold">Select number of Products:<span class="text-danger"> *</span></label>
                            <select class="form-select" id="noProducts" name="noProducts">
                                <option value="" disabled selected>No. of Products</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="productLines">

                </div>

                <div class="row pb-4">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <div class="d-grid">
                            <button type="submit" name="generatePDF" value="generate" class="btn btn-primary">Generate Invoice</button>
                        </div>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </div>
        </form>
    </div>
</body>

<script>
    $(document).ready(function() {
        $("#noProducts").on("change", function() {
            var prod = $("#noProducts").val();
            var html = '';
            if (prod > 0 && prod <= 4) {
                for (var i = 1; i <= prod; i++) {
                    html += `<div class="row ms-4 me-4">
                            <h5 class="fw-bold">Product ` + i + `:</h5>
                            <div class="col-sm-3">
                                <div class="mb-3 mt-3">
                                    <label for="prodname" class="form-label fw-bold">Product name:<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="prodname" name="prodname[]" placeholder="Product Name" >
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3 mt-3">
                                    <label for="model" class="form-label fw-bold">Model:<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="model" name="model[]" placeholder="Model" >
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3 mt-3">
                                    <label for="condition" class="form-label fw-bold">Condition:<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="condition" name="condition[]" placeholder="Condition" >
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3 mt-3">
                                    <label for="hashrate" class="form-label fw-bold">Hashrate:<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="hashrate" name="hashrate[]" placeholder="Hashrate" >
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3 mt-3">
                                    <label for="more" class="form-label fw-bold">more:<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="more" name="more[]" placeholder="more..." >
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3 mt-3">
                                    <label for="price" class="form-label fw-bold">Price:<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="price" name="price[]" placeholder="Price" >
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="mb-3 mt-3">
                                    <label for="quantity" class="form-label fw-bold">Quantity:<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="quantity" name="quantity[]" placeholder="qty" >
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3 mt-3">
                                    <label for="" class="form-label fw-bold">Product images:<span class="text-danger"> *</span></label>
                                    <?= $image_options ?>
                                </div>
                            </div>
                        </div>
                        <hr>
                        `;
                }
                $("#productLines").html(html);
            }
        });
    });
</script>

</html>
<!-- end document-->