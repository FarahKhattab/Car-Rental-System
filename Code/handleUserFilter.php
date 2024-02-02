<?php
// Start or resume the session
session_start();

// Retrieve the value of $num from the session
$num = isset($_SESSION['num']) ? $_SESSION['num'] : 'Not available';

// Output the value
echo "Number of rows: $num";
?>