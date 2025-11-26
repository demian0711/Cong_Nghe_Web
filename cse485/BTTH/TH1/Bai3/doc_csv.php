<?php
// 1. Khai báo tên tệp CSV
$file = '65HTTT_Danh_sach_diem_danh.csv';

// 2. Thiết lập tiêu đề trang và CSS cơ bản
echo '<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hiển thị Danh sách Tài khoản từ CSV</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h2 { color: #333; }
        table { width: 90%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; color: #333; font-weight: bold; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .error { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Danh sách Tài khoản</h2>';

// 3. Kiểm tra và mở tệp
if (($handle = fopen($file, 'r')) !== FALSE) {
    echo '<table>';
    $row_count = 0;

    // 4. Lặp qua từng dòng của tệp CSV
    while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
        // Dòng đầu tiên là tiêu đề (header)
        if ($row_count == 0) {
            echo '<thead><tr>';
            foreach ($data as $col_header) {
                // Chuyển tiêu đề về chữ hoa đầu mỗi từ cho đẹp hơn
                echo '<th>' . ucwords($col_header) . '</th>';
            }
            echo '</tr></thead><tbody>';
        } else {
            // Các dòng còn lại là dữ liệu
            echo '<tr>';
            foreach ($data as $col_data) {
                echo '<td>' . htmlspecialchars($col_data) . '</td>';
            }
            echo '</tr>';
        }
        $row_count++;
    }

    echo '</tbody></table>';
    // 5. Đóng tệp
    fclose($handle);
} else {
    // Xử lý lỗi nếu không mở được tệp
    echo '<p class="error">Không thể mở tệp tin: ' . htmlspecialchars($file) . '</p>';
}

echo '</body>
</html>';

?>