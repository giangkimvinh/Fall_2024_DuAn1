<?php

namespace App\Validations;

use App\Helpers\NotificationHelper;

class UserValidation
{

    // public static function create():bool {
    //     $is_valid = true;
    //     // ten loai
    //     if (!isset($_POST['name']) || $_POST['name'] ==== '') {
    //         NotificationHelper::error('name', 'Vui lòng không để trống tên loại sản phẩm');
    //         $is_valid = false;
    //     }
    //     // trang thai
    //     if (!isset($_POST['status']) || $_POST['status'] ==== '') {
    //         NotificationHelper::error('status', 'Vui lòng không để trống trạng thái');
    //         $is_valid = false;
    //     }

    //     return $is_valid;
    // }

    public static function create(): bool
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
        // trang thai
        if (!isset($_POST['status']) || $_POST['status'] === '') {
            NotificationHelper::error('status', 'Vui lòng chọn trạng thái');
            $is_valid = false;
        }
        return $is_valid;
    }




    public static function edit(): bool
    {
        $is_valid = true;
        // Password
        if (isset($_POST['password']) && $_POST['password'] !== '') {
            // Kiểm tra độ dài
            if (strlen($_POST['password']) < 3) {
                NotificationHelper::error('password', 'Mật khẩu phải nhập từ 3 ký tự');
                $is_valid = false;
            }
            if (!isset($_POST['re_password']) || $_POST['re_password'] === '') {
                NotificationHelper::error('re_password', 'Vui lòng không để trống nhập lại mật khẩu');
                $is_valid = false;
            } else {
                if ($_POST['password'] != $_POST['re_password']) {
                    NotificationHelper::error('re_password', 'Mật khẩu và nhập lại mật khẩu phải giống nhau');
                    $is_valid = false;
                }
            }
        }
        // // Re_password
        // if (!isset($_POST['re_password']) || $_POST['re_password'] === '') {
        //     NotificationHelper::error('re_password', 'Vui lòng không để trống re_password');
        //     $is_valid = false;
        // } else {
        //     if ($_POST['password'] != $_POST['re_password']) {
        //         NotificationHelper::error('re_password', 'Password và Re_password phải giống nhau');
        //         $is_valid = false;
        //     }
        // }
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
        // trang thai
        if (!isset($_POST['status']) || $_POST['status'] === '') {
            NotificationHelper::error('status', 'Vui lòng chọn trạng thái');
            $is_valid = false;
        }
        return $is_valid;
    }

    public static function uploadAvatar()
    {
        return AuthValidation::uploadAvatar();
    }
}
