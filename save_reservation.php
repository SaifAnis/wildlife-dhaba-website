<?php
// Simple reservation form handler

$host = "localhost";
$database = "advi_restaurant";
$username = "root";
$password = "";

$name = trim($_POST["name"] ?? "");
$phone = trim($_POST["phone"] ?? "");
$date = trim($_POST["date"] ?? "");
$time = trim($_POST["time"] ?? "");
$guests = trim($_POST["guests"] ?? "");

$message = "";

// Check that every form field contains a value.
if ($name == "" || $phone == "" || $date == "" || $time == "" || $guests == "") {
  $message = "Please fill in all reservation fields.";
} elseif ((int) $guests < 1 || (int) $guests > 20) {
  $message = "Please enter between 1 and 20 guests.";
} else {
  try {
    // PDO creates a safe database connection.
    $connection = new PDO(
      "mysql:host=$host;dbname=$database",
      $username,
      $password
    );

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepared statements keep the submitted values safe.
    $sql = "INSERT INTO reservations
            (customer_name, phone, booking_date, booking_time, guests)
            VALUES (?, ?, ?, ?, ?)";

    $statement = $connection->prepare($sql);
    $statement->execute([$name, $phone, $date, $time, $guests]);

    $message = "Thank you, " . htmlspecialchars($name) . ". Your reservation was saved.";
  } catch (PDOException $error) {
    $message = "Your reservation could not be saved. Please set up the database first.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservation | ADVI</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <main class="container" style="padding-top: 80px; padding-bottom: 80px;">
    <h1>Reservation</h1>
    <p><?php echo $message; ?></p>
    <a class="button button-primary" href="index.html">Back to website</a>
  </main>
</body>
</html>