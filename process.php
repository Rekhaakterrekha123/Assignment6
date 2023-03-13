<?php

// Validate form inputs
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $profile_picture = $_FILES['profile_picture']['name'];
  
  // Validate email format
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format.";
    exit();
  }
  
  // Save profile picture to server
  $target_dir = "uploads/";
  $timestamp = time();
  $profile_picture_name = $timestamp . "_" . basename($profile_picture);
  $target_file = $target_dir . $profile_picture_name;
  
  if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
    // Save user data to CSV file
    $data = array($name, $email, $profile_picture_name);
    $fp = fopen('users.csv', 'a');
    fputcsv($fp, $data);
    fclose($fp);
    
    // Set cookie
    session_start();
    setcookie('username', $name, time() + 3600, '/');
    
    // Redirect to success page
    header('Location: success.php');
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
} else {
  echo "All fields are required.";
}

?>
