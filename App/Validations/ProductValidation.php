<?php

namespace App\Validations;

use App\Helpers\NotificationHelper;

class ProductValidation
{

    public static function create(): bool
    {
        $is_valid = true;
        // tên sản phẩm 
        if (!isset($_POST['name']) || $_POST['name'] === '') {
            NotificationHelper::error('name', 'Vui lòng không để trống tên sản phẩm');
            $is_valid = false;
        }
        // Giá tiền
        if (!isset($_POST['price']) || $_POST['price'] === '') {
            NotificationHelper::error('price', 'Vui lòng không để trống giá tiền');
            $is_valid = false;
        } elseif ((int) $_POST['price'] <= 0) {
            NotificationHelper::error('price', 'Giá tiền phải lớn hơn 0');
            $is_valid = false;
        }
        // Giá giảm
        if (!isset($_POST['discount_price']) || $_POST['discount_price'] === '') {
            NotificationHelper::error('discount_price', 'Vui lòng không để trống giá giảm');
            $is_valid = false;
        } elseif ((int) $_POST['discount_price'] < 0) {
            NotificationHelper::error('discount_price', 'Giá giảm phải lớn hơn hoặc bằng 0');
            $is_valid = false;
        } elseif ((int) $_POST['discount_price'] > $_POST['price']) {
            NotificationHelper::error('discount_price', 'Giá giảm phải nhỏ hơn giá tiền');
            $is_valid = false;
        }
        // Loại sản phẩm
        if (!isset($_POST['category_id']) || $_POST['category_id'] === '') {
            NotificationHelper::error('category_id', 'Vui lòng không để trống loại sản phẩm');
            $is_valid = false;
        }
        // nổi bật
        if (!isset($_POST['is_featured']) || $_POST['is_featured'] === '') {
            NotificationHelper::error('is_featured', 'Vui lòng không để trống nổi bật');
            $is_valid = false;
        } // trạng thái
        if (!isset($_POST['status']) || $_POST['status'] === '') {
            NotificationHelper::error('status', 'Vui lòng không để trống trạng thái');
            $is_valid = false;
        }

        return $is_valid;
    }
    public static function edit(): bool
    {
        return self::create();
    }

    public static function updateImage(){
        if(!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])){
          return false;
        }
        // nowi luu file ảnh
        $target_dir = 'public/uploads/img/';
        // kiểm tra loại file có hợp lệ ko
        $imageFileType = strtolower(pathinfo(basename( $_FILES['image']['name']), PATHINFO_EXTENSION));
        if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' &&  $imageFileType != 'gif'){
            NotificationHelper::error('type_upload', 'Chỉ chấp nhận file ảnh JPG, JPEG, PNG, GIF');
            return false;
        }
            // tháy đổi tên file mà mình mông muốn 
        $nameImage = date('YmdHmi').'.'.$imageFileType;
        // đường dẫn đầy đủ file 
        $target_file = $target_dir. $nameImage;
        if(!move_uploaded_file($_FILES['image']['tmp_name'],$target_file)){
            NotificationHelper::error('move_upload', 'Không thể tải ảnh vào trong thư mục lưu trữ ');
            return false;
        }
        return $nameImage;
    }
}
