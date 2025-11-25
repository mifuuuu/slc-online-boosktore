<?php
// Passwords you want to assign
$admin_password = 'admin'; 
$staff_password = 'staff';

// Hash the passwords
$admin_hash = password_hash($admin_password, PASSWORD_DEFAULT);
$staff_hash = password_hash($staff_password, PASSWORD_DEFAULT);

echo "Admin hash: " . $admin_hash . "\n";
echo "Staff hash: " . $staff_hash . "\n";
?>