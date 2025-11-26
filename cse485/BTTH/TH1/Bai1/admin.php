<?php
// Tải dữ liệu hoa
require_once 'data_flower.php';

// CSS nội tuyến tối giản cho bảng quản trị
$css = "
<style>
    body {
        font-family: Arial, sans-serif;
        padding: 20px;
        background-color: #f4f4f4;
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        background: #fff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .header h1 {
        margin: 0;
        color: #007bff;
        font-size: 20px;
    }
    /* Style cho các nút bấm */
    .btn {
        text-decoration: none;
        padding: 8px 15px;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
        border: none;
        display: inline-block;
    }
    .btn-primary {
        background-color: #28a745;
        color: white;
    }
    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }
    .btn:hover {
        opacity: 0.9;
    }
    
    .table-container {
        overflow-x: auto;
        background: #fff;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 600px;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
        vertical-align: top;
    }
    th {
        background-color: #007bff;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .action-links a {
        margin-right: 5px;
        text-decoration: none;
        padding: 3px 8px;
        border-radius: 3px;
        font-size: 12px;
        color: white;
    }
    .btn-edit { background-color: #ffc107; color: black !important; }
    .btn-delete { background-color: #dc3545; }
    
    .flower-thumb {
        width: 80px;
        height: auto;
        border-radius: 4px;
        object-fit: cover;
    }
    .description-cell {
        max-width: 300px;
        white-space: normal;
        text-align: justify;
        font-size: 0.9em;
    }
</style>
";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Danh Sách Hoa</title>
    <?php echo $css; ?>
</head>
<body>
    <div class="header">
        <h1>Quản trị Dữ liệu Hoa</h1>
        
        <div class="header-actions">
            <!-- Nút quay lại trang chủ -->
            <a href="index.php" class="btn btn-secondary">⬅️ Trang chủ</a>
            
            <!-- Nút thêm mới -->
            <button onclick="alert('Chức năng thêm mới chưa được triển khai!')" class="btn btn-primary">+ Thêm mới</button>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên Hoa</th>
                    <th>Mô tả</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flowers as $flower): ?>
                <tr>
                    <td><?php echo htmlspecialchars($flower['id']); ?></td>
                    <td>
                        <img 
                            src="<?php echo htmlspecialchars($flower['image']); ?>" 
                            alt="Ảnh" 
                            class="flower-thumb"
                            onerror="this.onerror=null;this.src='https://placehold.co/100x70/cccccc/333333?text=No+Img';"
                        >
                    </td>
                    <td><?php echo htmlspecialchars($flower['name']); ?></td>
                    <td class="description-cell"><?php echo htmlspecialchars($flower['description']); ?></td>
                    <td class="action-links">
                        <a href="#" class="btn-edit" onclick="alert('Chức năng Sửa chưa được triển khai!')">Sửa</a>
                        <a href="#" class="btn-delete" onclick="alert('Chức năng Xóa chưa được triển khai!')">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>