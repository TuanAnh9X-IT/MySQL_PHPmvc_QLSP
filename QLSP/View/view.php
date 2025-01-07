<?php
// detail.php
include_once '../Controller/connect.php'; // Kết nối đến cơ sở dữ liệu
include_once '../Model/customerDB.php'; // Bao gồm lớp CustomerDB
include_once '../Model/customer.php'; // Bao gồm lớp Customer

$customerDB = new CustomerDB($conn);

// Kiểm tra xem có ID sản phẩm được truyền vào không
if (isset($_GET['id'])) {
    $product_id = (int)$_GET['id'];
    $product = $customerDB->getProductById($product_id);

    // Kiểm tra xem sản phẩm có tồn tại không
    if (!$product) {
        die("Sản phẩm không tồn tại.");
    }
} else {
    die("ID sản phẩm không hợp lệ.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Chi tiết sản phẩm</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                <p class="card-text"><strong>Giá:</strong> <?php echo number_format($product['product_price'], 2); ?> VNĐ</p>
                <p class="card-text"><strong>Mô tả:</strong> <?php echo htmlspecialchars($product['product_description']); ?></p>
                <p class="card-text"><strong>Nhà sản xuất:</strong> <?php echo htmlspecialchars($product['manufacturer']); ?></p>
                <a href="edit.php?id=<?php echo $product['product_id']; ?>" class="btn btn-warning">Sửa</a>
                <a href="delete.php?id=<?php echo $product['product_id']; ?>" class="btn btn-danger">Xóa</a>
                <a href="list.php" class="btn btn-secondary">Quay lại</a>
            </div>
        </div>
    </div>
</body>

</html>