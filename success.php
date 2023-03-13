<?php

// Display table of user data
echo "<table>";
echo "<tr><th>Name</th><th>Email</th><th>Profile Picture</th></tr>";

if (($handle = fopen("users.csv", "r")) !== false) {
  while (($data = fgetcsv($handle, 1000, ",")) !== false) {
    echo "<tr>";
    echo "<td>" . $data[0] . "</td>";
    echo "<td>" . $data[1] . "</td>";
    echo "<td><img src='uploads/" . $data[2] . "' height='100'></td>";
    echo "</tr>";
  }
  fclose($handle);
}

echo "</table>";

?>
