<?php
// delete.php
include_once '../Controller/connect.php'; // Kết nối đến cơ sở dữ liệu
include_once '../Model/customerDB.php'; // Bao gồm lớp CustomerDB
include_once '../Model/customer.php'; // Bao gồm lớp Customer

$customerDB = new CustomerDB($conn);

// Kiểm tra xem có ID sản phẩm được truyền vào không
if (isset($_GET['id'])) {
    $product_id = (int)$_GET['id'];

    // Xóa sản phẩm
    if ($customerDB->deleteProduct($product_id)) {
        // Chuyển hướng về danh sách sản phẩm với thông báo thành công
        header("Location: list.php?deleted=1");
        exit();
    } else {
        $error = "Có lỗi xảy ra khi xóa sản phẩm.";
    }
} else {
    $error = "ID sản phẩm không hợp lệ.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa sản phẩm</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Xóa sản phẩm</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <p>Bạn có chắc chắn muốn xóa sản phẩm này không?</p>
        <a href="list.php" class="btn btn-secondary">Quay lại</a>
    </div>
</body>

</html>