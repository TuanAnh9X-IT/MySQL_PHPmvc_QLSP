<?php
// edit.php
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

// Xử lý form khi người dùng gửi dữ liệu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $manufacturer = $_POST['manufacturer'];

    // Tạo đối tượng sản phẩm
    $updatedProduct = new Customer($product_id, $product_name, $product_price, $product_description, $manufacturer);

    // Cập nhật sản phẩm trong cơ sở dữ liệu
    if ($customerDB->updateProduct($updatedProduct)) {
        // Chuyển hướng về danh sách sản phẩm với thông báo thành công
        header("Location: list.php?updated=1");
        exit();
    } else {
        $error = "Có lỗi xảy ra khi cập nhật sản phẩm.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sản phẩm</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Chỉnh sửa sản phẩm</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="product_name">Tên sản phẩm</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="product_price">Giá sản phẩm</label>
                <input type="number" step="0.01" class="form-control" id="product_price" name="product_price" value="<?php echo htmlspecialchars($product['product_price']); ?>" required>
            </div>
            <div class="form-group">
                <label for="product_description">Mô tả sản phẩm</label>
                <textarea class="form-control" id="product_description" name="product_description"><?php echo htmlspecialchars($product['product_description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="manufacturer">Nhà sản xuất</label>
                <input type="text" class="form-control" id="manufacturer" name="manufacturer" value="<?php echo htmlspecialchars($product['manufacturer']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
            <a href="list.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>

</html>