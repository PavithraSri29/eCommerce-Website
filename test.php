<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A4 Invoice Generator</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
        @media print {
            @page {
                size: A4;
                margin: 0;
            }
            body {
                margin: 1.5cm;
            }
        }
        .invoice-container {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
        .invoice-header {
            background-color: #eeeeeea8;
            /* color: #fff; */
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .invoice-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .invoice-body {
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
        .invoice-footer {
            margin-top: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="invoice-container">
            <div class="invoice-header text-center">
                <h1>Invoice</h1>
                <p style="color: #7e8d9f; font-size: 16px;">ID: #123-123</p>
            </div>
            <div class="invoice-body">
            <div class="row ">
                    <div class="col-xl-12 ">
                <div class="text-left logo p-2 px-5 " style="text-align:center;" > <img src="https://i.imgur.com/2zDU056.png" class='mb-2' style="background-color:rgb(78, 241, 52 ); text-align:center; padding:5px; border-radius:30px;" width="50"> <h5>Your order Confirmed!</h5> </div></div></div>
                <div class="row mt-3">
                    <div class="col-xl-8">
                        <p>Customer Name: <span style="color: #5d9fc5;">John Lorem</span></p>
                        <p>Shipping Address: <span style="color: #5d9fc5;">krishnapuram,ambur</span></p>
                        <p>Billing Address: <span style="color: #5d9fc5;">krishnapuram,ambur</span></p>
                        <p><i class="bi bi-telephone-fill"></i> 123-456-789</p>
                    </div>
                    <div class="col-xl-4">
                        <p>Invoice</p>
                        <ul class="list-unstyled">
                            <li class="mb-1"><i class="bi bi-circle" style="color: #84B0CA;"></i> <span class="fw-bold">ID:</span> #123-456</li>
                            <li class="mb-1"><i class="bi bi-circle" style="color: #84B0CA;"></i> <span class="fw-bold">Ordered Date:</span> Jun 23, 2021</li>
                            <li class="mb-1"><i class="bi bi-circle" style="color: #84B0CA;"></i> <span class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold">Cash On Delivery Only</span></li>
                        </ul>
                    </div>
                </div>
                <div class="row mb-2">
                <div class="col-xl-12">Order ID: <a href="" class="text-decoration-none">#3595</a></div></div>
                <!-- <div class="row mx-3">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead style="background-color: #84B0CA; color: #fff;">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Pro Package</td>
                                    <td>4</td>
                                    <td>$200</td>
                                    <td>$800</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Web hosting</td>
                                    <td>1</td>
                                    <td>$10</td>
                                    <td>$10</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Consulting</td>
                                    <td>1 year</td>
                                    <td>$300</td>
                                    <td>$300</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-xl-8">
                        <p class="ms-3">Add additional notes and payment information</p>
                    </div>
                    <div class="col-xl-4">
                        <ul class="list-unstyled">
                            <li><span class="text-black me-4">SubTotal</span>$1110</li>
                            <li class="mt-2"><span class="text-black me-4">Tax (15%)</span>$111</li>
                            <li class="mt-2"><span class="text-black me-3">Total Amount</span><span style="font-size: 20px;">$1221</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="invoice-footer text-center">
                <h5>Thank you for your purchase</h5>
            </div>
        </div>
    </div>

    <script>
        // Print the invoice when the page is loaded
