<?php
// add.php
include_once '../Controller/connect.php'; // Kết nối đến cơ sở dữ liệu
include_once '../Model/customerDB.php'; // Bao gồm lớp CustomerDB
include_once '../Model/customer.php'; // Bao gồm lớp Customer

$customerDB = new CustomerDB($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $manufacturer = $_POST['manufacturer'];

    // Tạo đối tượng sản phẩm
    $product = new Customer(null, $product_name, $product_price, $product_description, $manufacturer);

    // Thêm sản phẩm vào cơ sở dữ liệu
    if ($customerDB->addProduct($product)) {
        // Chuyển hướng về danh sách sản phẩm với thông báo thành công
        header("Location: list.php?success=1"); // Thêm tham số success vào URL
        exit();
    } else {
        $error = "Có lỗi xảy ra khi thêm sản phẩm.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Thêm sản phẩm mới</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="product_name">Tên sản phẩm</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required>
            </div>
            <div class="form-group">
                <label for="product_price">Giá sản phẩm</label>
                <input type="number" step="0.01" class="form-control" id="product_price" name="product_price" required>
            </div>
            <div class="form-group">
                <label for="product_description">Mô tả sản phẩm</label>
                <textarea class="form-control" id="product_description" name="product_description"></textarea>
            </div>
            <div class="form-group">
                <label for="manufacturer">Nhà sản xuất</label>
                <input type="text" class="form-control" id="manufacturer" name="manufacturer" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
            <a href="list.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>

</html>