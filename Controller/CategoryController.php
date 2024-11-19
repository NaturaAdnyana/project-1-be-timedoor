<?php
require(__DIR__ . '/../Config/init.php');
class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    /**
     * Index: this method allows users to  view all products in the database.
     */
    public function index()
    {
        $where = [
            'isDeleted' => 0,
        ];
        return $this->categoryModel->getCategories(['*'], [], $where);
    }

    /**
     * Create: this method allows user to create a new product
     */
    public function create($data)
    {
        return $this->categoryModel->createCategory($data);
    }
    /**
     * Show: This method is used to show one specific product by its id.
     *   @param int $id - The id of the product that needs to be shown.
     *   @return array $product - An associative array containing information about the selected product.
     *   If no product with the given id exists, an empty array will be returned.
     */
    public function show($id)
    {
        $where = [
            'id' => $id,
        ];
        return $this->categoryModel->getCategories(['*'], [], $where);
    }

    public function  update($id, $data)
    {
        return $this->categoryModel->updateCategory($id, $data);
    }

    public function destroy($id)
    {
        return $this->categoryModel->deleteCategory($id);
    }

    public function restore() {}
}
