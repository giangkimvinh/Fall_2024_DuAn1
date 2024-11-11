<?php

namespace App\Helpers;

use App\Models\User;

class AuthHelper
{
    public static function register($data)
    {
        $user = new User();
        // bắt lỗi tồn tại username

        $is_exist = $user->getOneUserByUsername($data['username']);

        if ($is_exist) {
            NotificationHelper::error('rexist_register', 'Tên Đăng nhập đã tồn tại');
            return false;
        }
        $result  = $user->createUser($data);

        if ($result) {
            NotificationHelper::success('register', 'Đăng Ký thàng công');
            return true;
        }

        NotificationHelper::error('register', 'Đăng Ký thất bại');
        return false;
    }

    public static function login($data)
    {
        //kiem tra co ton tai username trong database hay khong => neu khong: thong bao, tra ve false
        $user = new User();
        // bắt lỗi tồn tại username

        $is_exist = $user->getOneUserByUsername($data['username']);

        if (!$is_exist) {
            NotificationHelper::error('rexist_username', 'Tên Đăng nhập không tồn tại');
            return false;
        }
        // ne co kt password co trung khong => neu khong: thong bao, tra ve false
        // password nguoi dung nhap:$data['password']
        // password trong database: $is_exit['password']

        if (!password_verify($data['password'], $is_exist['password'])) {
            NotificationHelper::error('password', 'Mật khẩu không chính xác');
            return false;
        }

        //ne co kt status == 0 =>: thong bao, tra ve false
        if ($is_exist['status'] == 0) {
            NotificationHelper::error('status', 'Tài khoãn đã bị khoá');
            return false;
        }

        // ne co kiem tra remember => luu session/cookie => thong bao thanh cong tra ve true

        if ($data['remember']) {
            // lưu cookie
            self::updateCookie($is_exist['id']);
        } else {
            self::updateSession($is_exist['id']);
            //luu session
        }

        NotificationHelper::success('login', 'Đăng nhập thành công');

        return true;
    }

    public static function updateCookie(int $id)
    {
        $user = new User();
        $result = $user->getOneUser($id);
        if ($result) {
            // chuyển array thanh string json lưu vào trong cookie  user 
            $user_data = json_encode($result);

            // lưu cookie 
            setcookie('user', $user_data, time()+3600*24*30*12, '/');

            $_SESSION['user'] = $result;
        }
    }
    public static function updateSession(int $id)
    {
        $user = new User();
        $result = $user->getOneUser($id);
        if ($result) {

            //lưu session
            $_SESSION['user'] = $result;
        }
    }

    public static function checkLogin()
    {
        if (isset($_COOKIE['user'])) {
            $user = $_COOKIE['user'];
            $user_data = (array) json_decode($user);

            self::updateCookie($user_data['id']);
            // $_SESSION['user'] = (array) $user_data;
            return true;
        }
        if (isset($_SESSION['user'])) {
            self::updateSession($_SESSION['user']['id']);
            return true;
        }
        return false;
    }

    public static function logout()
    {

        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        if (isset($_COOKIE['user'])) {
            setcookie('user', '', time() - 3600 * 24 * 30 * 12, '/');
        }
    }

    public static function edit($id): bool
    {
        if (!self::checkLogin()) {
            NotificationHelper::error('login', 'Vui lòng đăng nhập để xem thông tin');
            return false;
        }
        $data = $_SESSION['user'];
        $user_id = $data['id'];

        if (isset($_COOKIE['user'])) {
            self::updateCookie($user_id);
        }
        self::updateSession($user_id);

        if ($user_id !== $id) {
            NotificationHelper::error('user_id', 'Không có quyền xem thông tin tài khoản này');
            return false;
        }
        return true;
    }

    public static function update($id, $data)
    {
        $user = new User();
        $result = $user->updateUser($id, $data);

        if (!$result) {
            NotificationHelper::error('update_user', 'Cập nhật thông tin tài khoản thất bại');
            return false;
        }
        if ($_SESSION['user']) {
            self::updateSession($id);
        }
        if ($_COOKIE['user']) {
            self::updateCookie($id);
        }
        NotificationHelper::success('update_user', 'Cập nhật thông tin tài khoản thành công');
        return true;
    }
    public static function changePassword($id, $data)
    {
        $user = new User();
        $result = $user->getOneUser($id);

        if (!$result) {
            NotificationHelper::error('account', 'Tài khoản không tồn tại');
            return false;
        }
        // Kiểm tra mật khẩu cũ có trùng khớp  với cơ sở dữ liệu?
        if (!password_verify($data['old_password'], $result['password'])) {
            NotificationHelper::error('password_verify', 'Mật khẩu cũ không chính xác');
            return false;
        }
        // Mã hóa mật khẩu trước khi lưu
        $hash_password = password_hash($data['new_password'], PASSWORD_DEFAULT);
        $data_update = [
            'password' => $hash_password,
        ];

        $result_update = $user->updateUser($id, $data_update);
        if ($result_update) {
            if (isset($_COOKIE['user'])) {
                self::updateCookie($id);
            };
            self::updateSession($id);
            NotificationHelper::success('change_password', 'Đổi mật khẩu thành công');
            return true;
        } else {
            NotificationHelper::error('change_password', 'Đổi mật khẩu thất bại');
            return false;
        }
    }

    public static function forgotPassword($data)
    {
        $user = new User();

        $result = $user->getOneUserByUsername($data['username']);
        return $result;
    }

    public static function resetPassword($data)
    {
        $user = new User();
        $result = $user->updateUserByUsernameAndEmail($data);
        return $result;
    }

    public static function middleware()
    {
        // var_dump($_SERVER['REQUEST_URI']);
        $admin = explode('/', $_SERVER['REQUEST_URI']);
        // var_dump($admin);
        $admin = $admin[1];
        if ($admin == 'admin') {
            // if(!isset($_SESSION['user']) || $_SESSION['user']==['role'] !=1){
            //     NotificationHelper::error('admin', 'tài khoản này không có quyền truy cập');
            //     header('location: /login');
            //     exit;
            // }
            if (!isset($_SESSION['user'])) {
                NotificationHelper::error('admin', 'Vui lòng đăng nhập');
                header('location: /login');
                exit;
            }

            if ($_SESSION['user']['role'] != 1) {
                NotificationHelper::error('admin', 'tài khoản này không có quyền truy cập');
                header('location: /login');
                exit;
            }

        }
    }
}
