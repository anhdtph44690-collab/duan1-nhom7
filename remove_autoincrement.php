<?php
require_once './commons/env.php';
require_once './commons/function.php';

try {
    $conn = connectDB();
    
    // Xóa AUTO_INCREMENT
    $sql = "ALTER TABLE tours MODIFY COLUMN id INT(11) NOT NULL";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute();
    
    if ($result) {
        echo "✅ Đã xóa AUTO_INCREMENT khỏi bảng tours\n";
        
        // Kiểm tra lại cấu trúc
        $sql = "SHOW CREATE TABLE tours";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        echo "\nCấu trúc mới:\n";
        echo $result['Create Table'];
    }
    
} catch(Exception $e) {
    echo "Lỗi: " . $e->getMessage();
}
?>
