<?php
/**
 * WordPress Configuration & Setup Script
 */

define('WP_USE_THEMES', false);
require('wp-load.php');

$results = [];

// 1. Set Site Title & Tagline
update_option('blogname', 'Nguyễn Hoàng Anh Khoa');
update_option('blogdescription', 'Developer & Student - Web Development & Technology');
$results[] = "✅ Site title updated: 'Nguyễn Hoàng Anh Khoa'";
$results[] = "✅ Tagline updated";

// 2. Set Front Page
$front_page = get_page_by_title('Trang chủ');
if (!$front_page) {
    // Create front page if doesn't exist
    $front_page_id = wp_insert_post(array(
        'post_title'    => 'Trang chủ',
        'post_type'     => 'page',
        'post_status'   => 'publish',
        'post_content'  => 'Welcome to my portfolio!'
    ));
    $front_page = get_post($front_page_id);
} else {
    $front_page_id = $front_page->ID;
}

update_option('show_on_front', 'page');
update_option('page_on_front', $front_page_id);
$results[] = "✅ Front page set to: 'Trang chủ' (ID: {$front_page_id})";

// 3. Activate Portfolio Theme
switch_theme('portfolio-theme');
$results[] = "✅ Portfolio Theme activated";

// 4. Create Primary Menu if not exists
$menu_exists = wp_get_nav_menu_object('Main Menu');
if (!$menu_exists) {
    $menu_id = wp_create_nav_menu('Main Menu');
    $results[] = "✅ Main Menu created (ID: {$menu_id})";

    // Add menu items
    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title'  => 'Trang chủ',
        'menu-item-url'    => home_url('/'),
        'menu-item-status' => 'publish',
    ));

    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title'  => 'Blog',
        'menu-item-url'    => home_url('/blog/'),
        'menu-item-status' => 'publish',
    ));

    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title'  => 'Dự án',
        'menu-item-url'    => home_url('/projects/'),
        'menu-item-status' => 'publish',
    ));

    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title'  => 'Liên hệ',
        'menu-item-url'    => '#contact',
        'menu-item-status' => 'publish',
    ));

    // Assign menu to location
    $locations = get_theme_mod('nav_menu_locations');
    $locations['primary-menu'] = $menu_id;
    set_theme_mod('nav_menu_locations', $locations);

    $results[] = "✅ Menu items added and assigned";
} else {
    $results[] = "✅ Main Menu already exists";
}

// 5. Enable Permalinks
update_option('permalink_structure', '/%postname%/');
$results[] = "✅ Permalink structure: /%postname%/";

// 6. Update Home URL (important for Docker)
update_option('siteurl', 'http://localhost');
update_option('home', 'http://localhost');
$results[] = "✅ Site URL set to: http://localhost";

// Output results
echo "<pre style='background: #f0f0f0; padding: 20px; border-radius: 8px; font-family: monospace; line-height: 1.8;'>";
echo "<h2 style='color: #667eea; margin-top: 0;'>⚙️ WordPress Setup Complete!</h2>";
echo implode("\n", $results);
echo "\n\n<strong style='color: #10b981;'>🚀 Next: Go to http://localhost and refresh (Ctrl+Shift+R)</strong>";
echo "</pre>";

// Cleanup - remove this file after use
echo "<p style='color: #ef4444; margin-top: 20px;'><strong>Note:</strong> You can delete setup.php after this runs.</p>";
?>
