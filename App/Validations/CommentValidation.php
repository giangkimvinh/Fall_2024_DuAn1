<?php

namespace App\Validations;

use App\Helpers\NotificationHelper;

class CommentValidation
{

    public static function createClient(): bool
    {
        $is_valid = true;
        if (!isset($_POST['content']) || $_POST['content'] === '') {
            NotificationHelper::error('content', 'Vui lòng không để trống nội dung bình luận');
            $is_valid = false;
        }
        if (!isset($_POST['product_id']) || $_POST['product_id'] === '') {
            NotificationHelper::error('product_id', 'Vui lòng không để trống mã sản phẩm bình luận');
            $is_valid = false;
        }
        if (!isset($_POST['users_id']) || $_POST['users_id'] === '') {
            NotificationHelper::error('users_id', 'Vui lòng không để trống mã người bình luận');
            $is_valid = false;
        }
        return $is_valid;
    }
    public static function editClient(): bool
    {
        $is_valid = true;
        if (!isset($_POST['content']) || $_POST['content'] === '') {
            NotificationHelper::error('content', 'Vui lòng không để trống nội dung bình luận');
            $is_valid = false;
        }
        return $is_valid;
    }
    public static function edit(): bool
    {
        $is_valid = true;
        if (!isset($_POST['status']) || $_POST['status'] === '') {
            NotificationHelper::error('status', 'Không để trống trạng thái');
            $is_valid = false;
        }
        return $is_valid;
    }
}
