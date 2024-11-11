<?php 

namespace App\Validations;

use App\Helpers\NotificationHelper;

class CategoryValidation {

    public static function create():bool {
        $is_valid = true;
        // ten loai
        if (!isset($_POST['name']) || $_POST['name'] === '') {
            NotificationHelper::error('name', 'Vui lòng không để trống tên loại sản phẩm');
            $is_valid = false;
        }
        // trang thai
        if (!isset($_POST['status']) || $_POST['status'] === '') {
            NotificationHelper::error('status', 'Vui lòng không để trống trạng thái');
            $is_valid = false;
        }

        return $is_valid;
    }
    public static function edit():bool {
        $is_valid = true;
        // ten loai
        if (!isset($_POST['name']) || $_POST['name'] === '') {
            NotificationHelper::error('name', 'Vui lòng không để trống tên loại sản phẩm');
            $is_valid = false;
        }
        // trang thai
        if (!isset($_POST['status']) || $_POST['status'] === '') {
            NotificationHelper::error('status', 'Vui lòng không để trống trạng thái');
            $is_valid = false;
        }

        return $is_valid;
    }
}