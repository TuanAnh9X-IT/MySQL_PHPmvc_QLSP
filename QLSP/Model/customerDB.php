<?php
class CustomerDB {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllProducts($offset, $limit) {
        $stmt = $this->conn->prepare("SELECT * FROM products LIMIT ?, ?");
        $stmt->bind_param("ii", $offset, $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addProduct($product) {
        $stmt = $this->conn->prepare("INSERT INTO products (product_name, product_price, product_description, manufacturer) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdss", $product->product_name, $product->product_price, $product->product_description, $product->manufacturer);
        return $stmt->execute();
    }

    public function updateProduct($product) {
        $stmt = $this->conn->prepare("UPDATE products SET product_name=?, product_price=?, product_description=?, manufacturer=? WHERE product_id=?");
        $stmt->bind_param("sdssi", $product->product_name, $product->product_price, $product->product_description, $product->manufacturer, $product->product_id);
        return $stmt->execute();
    }

    public function deleteProduct($product_id) {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE product_id=?");
        $stmt->bind_param("i", $product_id);
        return $stmt->execute();
    }

    public function getProductById($product_id) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE product_id=?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function searchProducts($name) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE product_name LIKE ?");
        $searchTerm = "%" . $name . "%";
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>