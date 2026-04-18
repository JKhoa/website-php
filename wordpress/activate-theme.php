<?php
// Activation script for Portfolio Theme
define('WP_USE_THEMES', false);
require('wp-load.php');

// Activate Portfolio Theme
switch_theme('portfolio-theme');

echo "✅ Portfolio Theme đã được kích hoạt!";
?>
