<?php
class Customer {
    public $product_id;
    public $product_name;
    public $product_price;
    public $product_description;
    public $manufacturer;

    public function __construct($product_id, $product_name, $product_price, $product_description, $manufacturer) {
        $this->product_id = $product_id;
        $this->product_name = $product_name;
        $this->product_price = $product_price;
        $this->product_description = $product_description;
        $this->manufacturer = $manufacturer;
    }
}
?>