<?php
require(__DIR__ . '/../Config/init.php');
class ProductController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }

    /**
     * Index: this method allows users to  view all products in the database.
     */
    public function index()
    {

        $columns = ['products.id', 'products.product_name', 'products.price', 'products.stock', 'categories.category_name'];
        $joins = [
            'categories' => 'products.category_id = categories.id'
        ];

        $where = [
            'products.isDeleted' => 0,
        ];

        return $this->productModel->getProducts($columns, $joins, $where);
    }

    /**
     * Create: this method allows user to create a new product
     */
    public function create($data)
    {
        return $this->productModel->createProduct($data);
    }
    /**
     * Show: This method is used to show one specific product by its id.
     *   @param int $id - The id of the product that needs to be shown.
     *   @return array $product - An associative array containing information about the selected product.
     *   If no product with the given id exists, an empty array will be returned.
     */
    public function show($id)
    {
        $columns = ['products.id', 'products.product_name', 'products.price', 'products.stock', 'products.category_id', 'categories.category_name'];
        $joins = [
            'categories' => 'products.category_id = categories.id'
        ];
        $where = [
            'products.id' => $id,
        ];
        return $this->productModel->getProducts($columns, $joins, $where);
    }

    public function  update($id, $data)
    {
        var_dump($data);
        return $this->productModel->updateProduct($id, $data);
    }

    public function destroy($id)
    {
        return $this->productModel->deleteProduct($id);
    }

    public function restore() {}
}
