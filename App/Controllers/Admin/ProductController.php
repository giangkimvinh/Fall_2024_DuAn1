<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Category;
use App\Models\Product;
use App\Validations\ProductValidation;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Pages\Product\Create;
use App\Views\Admin\Pages\Product\Edit;
use App\Views\Admin\Pages\Product\Index;


class ProductController
{
    public static function index()
    {
        $product = new Product();
        $data = $product->getAllProductJoinCategorty();

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Index::render($data);
        Footer::render();
    }

    public static function create()
    {
        $category = new Category();
        $data = $category->getAllCategory();

        Header::render();
        Notification::render();
        NotificationHelper::unset();
        Create::render($data);
        Footer::render();
    }

    public static function store()
    {
        if (ProductValidation::create()) {
            $product = new Product();
            $is_exist = $product->getOneProductByName($_POST['name']);

            if ($is_exist) {
                NotificationHelper::error('name', 'Tên sản phẩm đã tồn tại');
                header('location: /admin/products/create');
            } else {
                $nameImage = self::handleImageUpload();

                $data = [
                    'name' => $_POST['name'],
                    'image' => $nameImage,
                    'description' => $_POST['description'],
                    'price' => $_POST['price'],
                    'discount_price' => $_POST['discount_price'],
                    'is_featured' => $_POST['is_featured'],
                    'status' => $_POST['status'],
                    'category_id' => $_POST['category_id']
                ];

                $result = $product->createProduct($data);

                if ($result) {
                    NotificationHelper::success('product', 'Thêm thành công');
                } else {
                    NotificationHelper::error('product', 'Thêm thất bại');
                }

                header('location: /admin/products');
            }
        } else {
            header('location: /admin/products/create');
        }
    }

    public static function edit($id)
    {
        $category = new Category();
        $data_category = $category->getAllCategory();

        $product = new Product();
        $data_product = $product->getOneProduct($id);
        $data = [
            'product' => $data_product,
            'category' => $data_category
        ];  
     
            Header::render();
            Notification::render();
            NotificationHelper::unset();
            Edit::render($data);
            Footer::render();
      
    }

    public static function update(int $id)
    {
      $is_valid = ProductValidation::edit();
      if (!$is_valid) {
        NotificationHelper::error('update_product', 'Cập nhật sản phẩm thất bại  !');
        header("Location: /admin/products/$id");
        exit();
        
    }
    $name = $_POST['name'];
    $status = $_POST['status'];
    // kiểm tra product name đã tồn tại chgx nếu có thì thông báo ra 
    $product = new product();
    $is_exist = $product->getOneproductByName($name);

    if ($is_exist && $is_exist['id'] != $id) {
        NotificationHelper::error('update_product', 'Tên loại sản phẩm đã tồn tại!');
        header("Location: /admin/products/$id");
        exit();
    }



    $data = [
        'name' => $name,
        'price' => $_POST['price'],
        'discount_price' => $_POST['discount_price'],
        'description' => $_POST['description'],
        'category_id' => $_POST['category_id'],
        'is_featured' => $_POST['is_featured'],
        'status' => $_POST['status'],
    ];
    $is_upload = ProductValidation::updateImage();
    if ($is_upload) {
        $data['image'] = $is_upload;
    }
    $result = $product->updateProduct($id, $data);
    if ($result) {
        NotificationHelper::success('update', 'Cập nhật sản phẩm thành công!');
        header('Location: /admin/products');
    } else {
        NotificationHelper::error('update', 'Cập nhật sản phẩm thất bại!');
        header("Location: /admin/products/$id");
    }

    }

    public static function delete($id)
    {
        $product = new Product();
        $result = $product->deleteProduct($id);

        if ($result) {
            NotificationHelper::success('product', 'Xoá thành công');
        } else {
            NotificationHelper::error('product', 'Xoá thất bại');
        }

        header('location: /admin/products');
    }

    private static function handleImageUpload()
    {
        if (file_exists($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
            $target_dir = "public/uploads/products/";
            $imageFileType = strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));
            $nameImage = date('YmdHmi') . '.' . $imageFileType;
            $target_file = $target_dir . $nameImage;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                return $nameImage;
            } else {
                NotificationHelper::error('upload_file', 'Upload file thất bại');
                return '';
            }
        }
        return '';
    }

    private static function prepareDataForUpdate($id)
    {
        if (file_exists($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
            $nameImage = self::handleImageUpload();
            return [
                'name' => $_POST['name'],
                'image' => $nameImage,
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'discount_price' => $_POST['discount_price'],
                'is_featured' => $_POST['is_featured'],
                'status' => $_POST['status'],
                'category_id' => $_POST['category_id']
            ];
        } else {
            return [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'discount_price' => $_POST['discount_price'],
                'is_featured' => $_POST['is_featured'],
                'status' => $_POST['status'],
                'category_id' => $_POST['category_id']
            ];
        }
    }
}
