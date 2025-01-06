<?php
// list.php
include_once '../Controller/connect.php'; //Kết nối đến cơ sở dữ liệu
include_once '../Model/customerDB.php'; //Bao gồm lớp CustomerDB

$customerDB = new CustomerDB($conn);
$limit = 6; // Số sản phẩm trên mỗi trang
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

//Lấy danh sách sản phẩm
$products = $customerDB->getAllProducts($offset, $limit);

//Lấy tổng số sản phẩm để phân trang
$totalProducts = $conn->query("SELECT COUNT(*) FROM products")->fetch_row()[0];
$totalPages = ceil($totalProducts / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Danh sách sản phẩm</h1>
    <a href="add.php" class="btn btn-primary mb-3">Thêm sản phẩm mới</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Giá sản phẩm</th>
                <th>Mô tả</th>
                <th>Nhà sản xuất</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['product_id']; ?></td>
                    <td><?php echo $product['product_name']; ?></td>
                    <td><?php echo number_format($product['product_price'], 2); ?> VNĐ</td>
                    <td><?php echo $product['product_description']; ?></td>
                    <td><?php echo $product['manufacturer']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $product['product_id']; ?>" class="btn btn-warning">Sửa</a>
                        <a href="delete.php?id=<?php echo $product['product_id']; ?>" class="btn btn-danger">Xóa</a>
                        <a href="view.php?id=<?php echo $product['product_id']; ?>" class="btn btn-info">Xem</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Phân trang -->
    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>
</body>
</html>