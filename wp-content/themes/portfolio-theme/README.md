# Portfolio Theme — WordPress Chủ Đề Cá Nhân

Website giới thiệu cá nhân chuyên nghiệp được xây dựng với WordPress và PHP.

## Tính năng

- **Thiết kế hiện đại** — Giao diện đẹp mắt với gradient màu sắc tím xanh
- **Responsive** — Hoạt động hoàn hảo trên mọi kích thước màn hình (mobile, tablet, desktop)
- **Tùy chỉnh dễ dàng** — Quản lý nội dung thông qua WordPress admin
- **Custom Post Types** — Hỗ trợ dự án (Projects) và kỹ năng (Skills)
- **Menu linh hoạt** — Tạo các menu tùy chỉnh trong WordPress admin
- **Dark Mode Ready** — CSS sẵn sàng hỗ trợ dark mode
- **SEO Friendly** — Cấu trúc HTML semantic và schema markup
- **Bình luận** — Hỗ trợ hệ thống bình luận WordPress

## Cài đặt

1. **Sao chép theme vào thư mục wp-content/themes**
   ```bash
   cp -r portfolio-theme /path/to/wordpress/wp-content/themes/
   ```

2. **Kích hoạt theme trong WordPress Admin**
   - Đăng nhập WordPress Admin Dashboard
   - Vào Giao diện > Chủ đề
   - Tìm "Portfolio Theme" và bấm "Kích hoạt"

3. **Cấu hình cơ bản**
   - Vào Cài đặt > Tùy chọn chung
   - Thiết lập tiêu đề trang web (Site Title)
   - Thiết lập mô tả (Tagline)

## Cấu trúc File

```
portfolio-theme/
├── style.css              # Stylesheet chính
├── functions.php          # WordPress functions và hooks
├── header.php             # Template header (được include tất cả trang)
├── footer.php             # Template footer
├── index.php              # Template mặc định
├── front-page.php         # Template trang chủ (nếu bật Static Page)
├── page.php               # Template cho các trang
├── single.php             # Template cho blog posts
├── single-projects.php    # Template cho dự án đơn
├── archive-projects.php   # Template cho danh sách dự án
├── search.php             # Template trang tìm kiếm
├── 404.php                # Template 404 Not Found
├── comments.php           # Template bình luận
├── searchform.php         # Template form tìm kiếm
├── assets/
│   └── js/
│       └── main.js        # JavaScript chính
└── languages/
    └── portfolio-theme.pot # File dịch

```

## Cài đặt Nội dung

### 1. Tạo Trang Chủ (Front Page)

- Vào Trang > Thêm mới
- Tiêu đề: "Trang chủ"
- Nội dung: Mô tả về bạn
- Xuất bản trang
- Vào Cài đặt > Đọc
- Thiết lập "Trang chủ của blog của bạn" = "Trang chủ" (vừa tạo)
- Lưu thay đổi

### 2. Thêm Dự án

- Vào Dự án > Thêm mới
- Tiêu đề dự án
- Mô tả dự án (Content)
- Thêm hình ảnh đại diện (Featured Image)
- Chọn Danh mục dự án (tùy chọn)
- Xuất bản

### 3. Thêm Kỹ năng

- Vào Kỹ năng > Thêm mới
- Tiêu đề kỹ năng (ví dụ: "PHP & WordPress")
- Mô tả kỹ năng
- Xuất bản

### 4. Tạo Menu

- Vào Giao diện > Menu
- Tạo menu mới (tên: "Main Menu")
- Thêm các mục: Trang chủ, Dự án, Blog, Liên hệ
- Thiết lập vị trí Menu: "Primary Menu"
- Lưu Menu

### 5. Trang Liên hệ

- Vào Trang > Thêm mới
- Tiêu đề: "Liên hệ"
- Nội dung: Mô tả trang liên hệ
- Xuất bản

## Custom Post Types

### Projects (Dự án)
- **Hỗ trợ**: title, editor, thumbnail, excerpt
- **Taxonomy**: project_category
- **URL**: `/projects/`

### Skills (Kỹ năng)
- **Hỗ trợ**: title, editor
- **Taxonomy**: skill_category

## Tùy chỉnh

### Màu sắc

Mở file `style.css` và tìm các biến màu:
- Màu chính: `#667eea` (xanh tím)
- Màu phụ: `#764ba2` (tím)
- Thay đổi các giá trị này để đổi bảng màu

### Font chữ

Mở file `style.css`, tìm phần font-family và chỉnh sửa:
```css
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
```

### Nội dung tĩnh

Chỉnh sửa các chuỗi văn bản trong `front-page.php` hoặc tạo bản dịch tùy chỉnh

## Hỗ trợ Plugin

Theme tương thích với các plugin phổ biến:
- **Yoast SEO** — SEO Optimization
- **Contact Form 7** — Form liên hệ
- **Elementor** — Page builder
- **Jetpack** — Analytics & Performance
- **WP Super Cache** — Caching

## Các Widget có sẵn

- Primary Sidebar
- Footer Widget Area

## Các Hook / Filter

Theme sử dụng các WordPress standard hooks:
- `after_setup_theme` — Setup theme
- `wp_enqueue_scripts` — Enqueue styles/scripts
- `init` — Register custom post types
- `widgets_init` — Register sidebars

## Troubleshooting

**Vấn đề**: Trang trắng xóa
- **Giải pháp**: Bật debug mode trong `wp-config.php`
```php
define('WP_DEBUG', true);
```

**Vấn đề**: Dự án không hiển thị
- **Giải pháp**: Kiểm tra xem post type "projects" đã được đăng ký
- Flush permalinks: Cài đặt > Liên kết tĩnh > Lưu

**Vấn đề**: Menu không hiển thị
- **Giải pháp**: 
  - Tạo menu mới
  - Gán vào vị trí "Primary Menu"
  - Đảm bảo menu không trống

## Các tệp cần biên dịch/tạo

Một số tệp bạn có thể cần tạo bổ sung:
- `template-about.php` — Template trang "Về tôi"
- `template-contact.php` — Template trang liên hệ tùy chỉnh
- `assets/css/custom.css` — CSS tùy chỉnh

## Hỗ trợ & Phát triển

Để cải thiện theme:
1. Sửa đổi các tệp PHP/CSS
2. Kiểm tra trong local environment
3. Flush cache nếu cần
4. Kiểm tra trên mobile

## Giấy phép

GPL v2 or later — Giống như WordPress

## Tác giả

**Nguyễn Hoàng Anh Khoa**
- Website: https://example.com
- Email: contact@example.com

---

## Version

- **1.0.0** — Initial Release
- Tested with WordPress 6.0+
- PHP 7.4+

