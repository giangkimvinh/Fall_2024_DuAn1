<?php

namespace App\Controllers\Client;

use App\Helpers\NotificationHelper;
use App\Models\Comment;
use App\Validations\CommentValidation;


class CommentController
{



    // xử lý chức năng thêm
    public static function store()
    {
        // Validate the form data
        $is_valid = CommentValidation::createClient();
        if (!$is_valid) {
            NotificationHelper::error('store', 'Thêm bình luận thất bại');
            if (isset($_POST['product_id']) && ($_POST['product_id'])) {
                $product_id = $_POST['product_id'];
                header("location: /products/$product_id");
            } else {
                header("location: /products");
            }
        }
        $product_id = $_POST['product_id'];
        $data = [
            'content' => $_POST['content'],
            'product_id' => $_POST['product_id'],
            'users_id' => $_POST['users_id'],
        ];
        $comment = new Comment();

        $result = $comment->createComment($data);
        if ($result) {
            NotificationHelper::success('store', 'Thêm bình luận thành công');
        } else {
            NotificationHelper::error('store', 'Thêm bình luận thất bại');
        }
        header("location: /products/$product_id");
    }


    // // xử lý chức năng sửa (cập nhật)
    public static function update(int $id)
    {
        // echo 'Thực hiện cập nhật vào database';
        //validation cac truong du lieu 
        $is_valid = CommentValidation::editClient();
        if (!$is_valid) {
            NotificationHelper::error('update', 'Cập nhật loại sản phẩm thất bại');
            if (isset($_POST['product_id']) && ($_POST['product_id'])) {
                $product_id = $_POST['product_id'];
                header("location: /products/$product_id");
            } else {
                header("location: /products");
            }
            exit();
        }

        $data = [
            'content' => $_POST['content'],
        ];
        $comment = new Comment();
        $result = $comment->updateComment($id, $data);
        if ($result) {
            NotificationHelper::success('update', 'Cập nhật loại sản phẩm thành công');
        } else {
            NotificationHelper::error('update', 'Cập nhật loại sản phẩm thất bại');
        }
        if (isset($_POST['product_id']) && ($_POST['product_id'])) {
            $product_id = $_POST['product_id'];
            header("location: /products/$product_id");
        } else {
            header("location: /products");
        }
    }


    // // thực hiện xoá
    public static function delete(int $id)
    {
        $comment = new Comment();
        $result = $comment->deleteComment($id);

        if ($result) {
            NotificationHelper::success('delete', 'Xoá bình luận thành công');
        } else {
            NotificationHelper::error('delete', 'Xoá bình luận thất bại');
        }
        if (isset($_POST['product_id']) && ($_POST['product_id'])) {
            $product_id = $_POST['product_id'];
            header("location: /products/$product_id");
        } else {
            header("location: /products");
        }
    }
}
