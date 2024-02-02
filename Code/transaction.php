
<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Transaction</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
    }

    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }

    .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
    }

    .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
    }

    body {
        display: flex;
        flex-direction: row;
        margin: 0;
    }

    .transaction-details {
        margin: 50px; /* Adjust the margin-top value to move it higher */
        margin-top: 1px;
        padding: 20px; /* Add padding for space inside the box */
        border: 1px solid #ccc; /* Border around the container */
        border-radius: 5px; /* Optional: Rounded corners */
        background-color: rgba(255, 255, 255, 0.8);
    }

    /* New CSS for form-transaction */
    .form-transaction {
        margin: -50px 50px 0; /* Updated margin-top to 20px */
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        max-width: 600px;
        margin-left: 100px;
        background-color: rgba(255, 255, 255, 0.8);
    }

    </style>


    <!-- Custom styles for this template -->
    <link href="css/sign-in.css" rel="stylesheet">
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
<?php
    // Your PHP code for transaction details
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $plate_no = $_POST['plate_no'] ?? '';
        $startDate = $_POST['startDate'] ?? '';
        $endDate = $_POST['endDate'] ?? '';

        // Present transaction details
        echo "<div class='transaction-details'>";
        echo "<h1>Transaction Details</h1>";
        echo "<p>Found below are your rental details, please enter your transaction details to complete the process.</p>";
        echo "<p>Plate Number: $plate_no</p>";
        echo "<p>Start Date: $startDate</p>";
        echo "<p>End Date: $endDate</p>";
        echo "</div>";
    }
    ?>

<main class="form-transaction">
    <h1 class="h3 mb-3 fw-normal">Transaction Information</h1>
    <form action="handleTransaction.php" method="post">
        <input type="hidden" name="plate_no" value="<?php echo htmlspecialchars($_POST['plate_no'] ?? ''); ?>">
        <input type="hidden" name="startDate" value="<?php echo htmlspecialchars($_POST['startDate'] ?? ''); ?>">
        <input type="hidden" name="endDate" value="<?php echo htmlspecialchars($_POST['endDate'] ?? ''); ?>">
        
        <!-- Rest of the form for user details -->
        <div class="form-floating">
            <input type="text" class="form-control" id="user_ssn" name="user_ssn" placeholder="User Social Security Number" required pattern="[0-9]+" title="Please enter a valid Social Security Number (numbers only)">
            <label for="user_ssn">User Social Security Number</label>
        </div>

        <div class="form-floating">
            <input type="text" class="form-control" id="card_no" name="card_no" placeholder="Card Number" required pattern="[0-9]+" title="Please enter a valid Card Number (numbers only)">
            <label for="card_no">Card Number</label>
        </div>

        <!-- Submit button -->
        <button class="btn btn-primary w-100 py-2" type="submit">Continue</button>
    </form>
</main>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="css/bootstrap.bundle.min.js"></script>

</body>

</html>