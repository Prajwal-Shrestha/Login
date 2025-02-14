<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}
include("connect.php");

$email = $_SESSION['email'];
$sql = "SELECT firstName, lastName FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($firstName, $lastName);
    $stmt->fetch();
    $stmt->close();
} else {
    $firstName = $_SESSION['firstName'] ?? 'User';
    $lastName  = $_SESSION['lastName'] ?? '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Homepage</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #667eea, #764ba2);
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }
    
    .welcome {
      background: rgba(255, 255, 255, 0.97);
      border-radius: 10px;
      padding: 40px;
      text-align: center;
      box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
      animation: popIn 0.5s ease-out;
      max-width: 500px;
      width: 90%;
    }
    
    @keyframes popIn {
      0% {
        transform: scale(0.9);
        opacity: 0;
      }
      100% {
        transform: scale(1);
        opacity: 1;
      }
    }
    
    .welcome p {
      font-size: 2rem;
      font-weight: 600;
      margin-bottom: 20px;
      color: #333;
    }
    
    .welcome a {
      display: inline-block;
      text-decoration: none;
      padding: 12px 30px;
      background: #5a67d8;
      color: #fff;
      border-radius: 5px;
      transition: background 0.3s, transform 0.2s;
      font-size: 1rem;
    }
    
    .welcome a:hover {
      background: #434190;
      transform: translateY(-2px);
    }
  </style>
</head>
<body>
  <div class="welcome">
    <p>
      Welcome <?php echo $firstName . ' ' . $lastName; ?> :)
    </p>
    <a href="logout.php">Logout</a>
  </div>
</body>
</html>
