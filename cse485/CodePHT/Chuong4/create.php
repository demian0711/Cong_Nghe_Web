<?php
// Không include database, chỉ minh họa POST
$thong_bao = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten_de_tai    = $_POST['ten_de_tai'] ?? '';
    $ten_sinh_vien = $_POST['ten_sinh_vien'] ?? '';
    $mssv          = $_POST['mssv'] ?? '';
    $giang_vien_hd = $_POST['giang_vien_hd'] ?? '';
    $nam_hoc       = $_POST['nam_hoc'] ?? '';
    $trang_thai    = $_POST['trang_thai'] ?? 'Đang thực hiện';

    // Ở giai đoạn này, chỉ echo lại dữ liệu hoặc redirect demo
    // Có thể cho sinh viên xem var_dump($_POST) để hiểu dòng chảy
    $thong_bao = "Dữ liệu đã được gửi bằng POST. (Trong bản có DB sẽ INSERT vào bảng.)";

    // Ví dụ: redirect để minh họa vòng đời request
    header("Location: index.php?success=created");
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm đồ án mới (Demo POST)</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="navbar">
    <div>Quản lý Đồ án Tốt nghiệp</div>
    <div>
        <a href="index.php">Dashboard</a>
    </div>
</div>

<div class="container">
    <h2>Thêm đồ án mới</h2>
    <p>Form này chỉ dùng để minh họa cách gửi dữ liệu bằng <b>POST</b> trong PHP, chưa lưu vào CSDL.</p>

    <form action="create.php" method="POST">
        <div style="margin-bottom:10px;">
            <label>Tên đề tài</label><br>
            <input type="text" name="ten_de_tai" style="width:100%; padding:6px;" required>
        </div>
        <div style="margin-bottom:10px;">
            <label>Tên sinh viên</label><br>
            <input type="text" name="ten_sinh_vien" style="width:100%; padding:6px;" required>
        </div>
        <div style="margin-bottom:10px;">
            <label>MSSV</label><br>
            <input type="text" name="mssv" style="width:100%; padding:6px;" required>
        </div>
        <div style="margin-bottom:10px;">
            <label>Giảng viên hướng dẫn</label><br>
            <input type="text" name="giang_vien_hd" style="width:100%; padding:6px;" required>
        </div>
        <div style="margin-bottom:10px;">
            <label>Năm học (vd: 2024-2025)</label><br>
            <input type="text" name="nam_hoc" style="width:100%; padding:6px;" required>
        </div>
        <div style="margin-bottom:10px;">
            <label>Trạng thái</label><br>
            <select name="trang_thai" style="width:100%; padding:6px;">
                <option value="Đang thực hiện">Đang thực hiện</option>
                <option value="Hoàn thành">Hoàn thành</option>
                <option value="Chưa bắt đầu">Chưa bắt đầu</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Gửi dữ liệu (POST)</button>
        <a href="index.php" class="btn btn-secondary">Hủy</a>
    </form>
</div>
</body>
</html>
