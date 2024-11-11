<?php


namespace App\Validations;

use App\Helpers\NotificationHelper;

class AuthValidation
{
    public static function register(): bool
    {
        $is_valid = true;
        // Username
        if (!isset($_POST['username']) || $_POST['username'] === '') {
            NotificationHelper::error('username', 'Vui lòng không để trống username');
            $is_valid = false;
        }
        // Password
        if (!isset($_POST['password']) || $_POST['password'] === '') {
            NotificationHelper::error('password', 'Vui lòng không để trống password');
            $is_valid = false;
        } else {
            // Kiểm tra độ dài
            if (strlen($_POST['password']) < 3) {
                NotificationHelper::error('password', 'Password phải nhập từ 3 ký tự');
                $is_valid = false;
            }
        }
        // Re_password
        if (!isset($_POST['re_password']) || $_POST['re_password'] === '') {
            NotificationHelper::error('re_password', 'Vui lòng không để trống re_password');
            $is_valid = false;
        } else {
            if ($_POST['password'] != $_POST['re_password']) {
                NotificationHelper::error('re_password', 'Password và Re_password phải giống nhau');
                $is_valid = false;
            }
        }
        // Email
        if (!isset($_POST['email']) || $_POST['email'] === '') {
            NotificationHelper::error('email', 'Vui lòng không để trống email');
            $is_valid = false;
        } else {
            // Kiểm tra định dạng 
            $emailPattern = "/^[a-zA-Z0-9.%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
            if (!preg_match($emailPattern, $_POST['email'])) {
                NotificationHelper::error('email', 'Email không đúng định dạng');
                $is_valid = false;
            }
        }
        // Name
        if (!isset($_POST['name']) || $_POST['name'] === '') {
            NotificationHelper::error('name', 'Vui lòng không để trống Name');
            $is_valid = false;
        }
        return $is_valid;
    }


    public static function login(): bool
    {
        $is_valid = true;
        // Username
        if (!isset($_POST['username']) || $_POST['username'] === '') {
            NotificationHelper::error('username', 'Vui lòng không để trống username');
            $is_valid = false;
        }
        // Password
        if (!isset($_POST['password']) || $_POST['password'] === '') {
            NotificationHelper::error('password', 'Vui lòng không để trống password');
            $is_valid = false;
        }

        return $is_valid;
    }
    public static function edit(): bool
    {
        $is_valid = true;
        // Email
        if (!isset($_POST['email']) || $_POST['email'] === '') {
            NotificationHelper::error('email', 'Vui lòng không để trống email');
            $is_valid = false;
        } else {
            // Kiểm tra định dạng 
            $emailPattern = "/^[a-zA-Z0-9.%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
            if (!preg_match($emailPattern, $_POST['email'])) {
                NotificationHelper::error('email', 'Email không đúng định dạng');
                $is_valid = false;
            }
        }
        // Name
        if (!isset($_POST['name']) || $_POST['name'] === '') {
            NotificationHelper::error('name', 'Vui lòng không để trống Name');
            $is_valid = false;
        }
        return $is_valid;
    }
    public static function uploadAvatar()
    {
        if (!file_exists($_FILES['avatar']['tmp_name']) || !is_uploaded_file($_FILES['avatar']['tmp_name'])) {
            return false;
        }
        // Nơi lưu trữ hình ảnh trong sourcecode
        $target_dir = 'public/uploads/users/';
        // Kiểm tra loại file upload có hợp lệ không?
        $imageFileType = strtolower(pathinfo(basename($_FILES['avatar']['name']), PATHINFO_EXTENSION));

        if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
            NotificationHelper::error('type_upload', 'Chỉ nhận file ảnh JPG, PNG, JPEG, GIF');
            return false;
        }
        // Thay đổi tên file theo dạng năm/tháng/ngày giờ/phút/giây
        $nameImage = date('YmdHmi') . '.' . $imageFileType;

        // Đường dẫn đủ để chuyển file
        $target_file = $target_dir . $nameImage;
        if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file)) {
            NotificationHelper::error('move_upload', 'Không thể tải ảnh vào thư mục đã lưu trữ');
            return false;
        }
        return $nameImage;
    }

    public static function changePassword(): bool
    {
        $is_valid = true;
        // Password Old
        if (!isset($_POST['old_password']) || $_POST['old_password'] === '') {
            NotificationHelper::error('old_password', 'Vui lòng không để trống password cũ');
            $is_valid = false;
        }
        // Password New
        if (!isset($_POST['new_password']) || $_POST['new_password'] === '') {
            NotificationHelper::error('new_password', 'Vui lòng không để trống password mới');
            $is_valid = false;
        } else {
            // Kiểm tra độ dài
            if (strlen($_POST['new_password']) < 3) {
                NotificationHelper::error('new_password', 'Password phải nhập từ 3 ký tự');
                $is_valid = false;
            }
        }
        // Re_password
        if (!isset($_POST['re_password']) || $_POST['re_password'] === '') {
            NotificationHelper::error('re_password', 'Vui lòng không để trống re_password mới');
            $is_valid = false;
        } else {
            if ($_POST['new_password'] != $_POST['re_password']) {
                NotificationHelper::error('re_password', 'Password mới và Re_password mới phải giống nhau');
                $is_valid = false;
            }
        }
        return $is_valid;
    }



    public static function forgotPassword(): bool
    {
        $is_valid = true;
        // Username
        if (!isset($_POST['username']) || $_POST['username'] === '') {
            NotificationHelper::error('username', 'Vui lòng không để trống username');
            $is_valid = false;
        }
        // Password
        
        
        // Email
        if (!isset($_POST['email']) || $_POST['email'] === '') {
            NotificationHelper::error('email', 'Vui lòng không để trống email');
            $is_valid = false;
        } else {
            // Kiểm tra định dạng 
            $emailPattern = "/^[a-zA-Z0-9.%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
            if (!preg_match($emailPattern, $_POST['email'])) {
                NotificationHelper::error('email', 'Email không đúng định dạng');
                $is_valid = false;
            }
        }
        
        return $is_valid;
    }

    public static function resetPassword(): bool
    {
        $is_valid = true;
       
        // Password
        if (!isset($_POST['password']) || $_POST['password'] === '') {
            NotificationHelper::error('password', 'Vui lòng không để trống password');
            $is_valid = false;
        } else {
            // Kiểm tra độ dài
            if (strlen($_POST['password']) < 3) {
                NotificationHelper::error('password', 'Password phải nhập từ 3 ký tự');
                $is_valid = false;
            }
        }
        // Re_password
        if (!isset($_POST['re_password']) || $_POST['re_password'] === '') {
            NotificationHelper::error('re_password', 'Vui lòng không để trống re_password');
            $is_valid = false;
        } else {
            if ($_POST['password'] != $_POST['re_password']) {
                NotificationHelper::error('re_password', 'Password và Re_password phải giống nhau');
                $is_valid = false;
            }
        }
        
        return $is_valid;
    }

    
}
