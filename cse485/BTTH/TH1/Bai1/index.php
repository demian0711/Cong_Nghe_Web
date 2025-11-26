<?php
// Tải dữ liệu hoa
require_once 'data_flower.php';

// CSS nội tuyến
$css = "
<style>
    body {
        font-family: 'Times New Roman', serif;
        line-height: 1.6;
        margin: 0;
        padding: 0;
        background-color: #fff;
        color: #333;
        position: relative; /* Để làm mốc cho nút Admin */
    }
    /* Container mới để căn giữa nội dung bài viết */
    .main-content {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }
    .header {
        margin-bottom: 30px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 15px;
        margin-top: 20px; /* Đẩy xuống một chút để thoáng */
    }
    .header h1 {
        color: #333;
        font-size: 30px; /* Tăng kích thước chữ để nổi bật hơn */
        font-weight: bold;
        margin-top: 0;
        margin-bottom: 10px;
        line-height: 1.3;
    }
    /* Nút admin nằm hẳn ở góc màn hình */
    .admin-link {
        position: absolute;
        top: 20px;
        right: 20px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
        background: #f8f9fa; /* Thêm nền nhẹ để dễ nhìn hơn */
        padding: 5px 10px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }
    .admin-link:hover {
        background: #e2e6ea;
        text-decoration: none;
    }
    .flower-article {
        margin-bottom: 40px;
        text-align: left;
    }
    .flower-title {
        font-weight: bold;
        font-size: 18px;
        color: #333;
        margin-bottom: 10px;
    }
    .flower-desc {
        text-align: justify;
        margin-bottom: 15px;
        font-size: 17px; /* Tăng nhẹ cỡ chữ nội dung cho dễ đọc */
    }
    .flower-image-container {
        width: 100%;
        text-align: center;
    }
    .flower-image-container img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 0 auto;
    }
</style>
";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>14 Loài Hoa Tuyệt Đẹp Thích Hợp Trồng Dịp Xuân Hè</title>
    <?php echo $css; ?>
</head>
<body>
    <!-- Nút đăng nhập nằm ngoài dòng chảy văn bản, ghim ở góc phải màn hình -->
    <a href="admin.php" class="admin-link">Đăng nhập Quản trị</a>

    <div class="main-content">
        <div class="header">
            <h1>14 loại hoa tuyệt đẹp thích hợp trồng để khoe hương sắc dịp xuân hè</h1>
        </div>

        <div class="articles-container">
            <?php foreach ($flowers as $flower): ?>
            <div class="flower-article">
                <!-- 1. Tiêu đề: Số thứ tự + Tên -->
                <div class="flower-title">
                    <?php echo $flower['id']; ?>. <?php echo htmlspecialchars($flower['name']); ?>
                </div>

                <!-- 2. Mô tả -->
                <div class="flower-desc">
                    <?php echo htmlspecialchars($flower['description']); ?>
                </div>

                <!-- 3. Ảnh (nằm dưới cùng) -->
                <div class="flower-image-container">
                    <img 
                        src="<?php echo htmlspecialchars($flower['image']); ?>" 
                        alt="<?php echo htmlspecialchars($flower['name']); ?>"
                        onerror="this.onerror=null;this.src='https://placehold.co/600x400/cccccc/333333?text=Anh+Minh+Hoa';"
                    >
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>
</html>