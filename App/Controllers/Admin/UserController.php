<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\User;
use App\Validations\UserValidation;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\User\Create;
use App\Views\Admin\Pages\User\Edit;
use App\Views\Admin\Pages\User\Index;

class UserController
{


    // hiển thị danh sách
    public static function index()
    {
        
        $User = new User();
        $data = $User->getAllUser();
        // var_dump($data);


        Header::render();
        Notification::render();
        NotificationHelper::unset();
        // hiển thị giao diện danh sách
        Index::render($data);
        Footer::render();
    }


    // hiển thị giao diện form thêm
    public static function create()
    {
        // var_dump($_SESSION);
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        // hiển thị form thêm
        Create::render();
        Footer::render();
    }


//     // xử lý chức năng thêm
    public static function store()
    {
        //validation cac truong du lieu 
        $is_valid = UserValidation::create();
        if (!$is_valid) {
            NotificationHelper::error('store', 'Thêm người dùng thất bại');
            header('location: /admin/users/create');
            exit;
        }
        $username = $_POST['username'];
        // $status = $_POST['status'];
        // kiem tra ten dang nhap co ton tai chua => khong duoc trung ten
        $user = new User();
        $is_exist = $user->getOneUserByUsername($username);
        if ($is_exist) {
            NotificationHelper::error('store', 'Tên người dùng đã tồn tại');
            header('location: /admin/users/create');
            exit;
        }
        //    echo 'oki';
        // thuc hien them 


        $data = [
            'username' => $username,
            'email' => $_POST['email'],
            'name' => $_POST['name'],
            'password' =>password_hash($_POST['password'], PASSWORD_DEFAULT),
            'status' => $_POST['status'],

            
        ];
        $is_upload=UserValidation::uploadAvatar();
        if($is_upload){
            $data['avatar']=$is_upload;
        }

        $result = $user->createuser($data);
        if ($result) {
            NotificationHelper::success('store', 'Thêm người dùng thành công');
            header('location: /admin/users');
        } else {
            NotificationHelper::error('store', 'Thêm người dùng thất bại');
            header('location: /admin/users/create');
        }
    }


//     // hiển thị chi tiết
//     public static function show()
//     {
//     }


//     // hiển thị giao diện form sửa
    public static function edit(int $id)
    {
        // giả sử data là mảng dữ liệu lấy được từ database
        // $data = [
        //     'id' => $id,
        //     'name' => 'User 1',
        //     'status' => 1
        // ];
        $User = new User();
        $data = $User->getOneUser($id);
        if (!$data) {
            NotificationHelper::error('edit', 'Không thể xem người dùng');
            header('Location: /admin/users');
            exit;
        }
        Header::render();
        Notification::render();
        NotificationHelper::unset();
        // hiển thị form sửa
        Edit::render($data);
        Footer::render();
        // if ($data) {
        // Header::render();
        // hiển thị form sửa
        // Edit::render($data);
        // Footer::render();
        // } else {
        //     header('location: /admin/Users');
        // }
    }


//     // xử lý chức năng sửa (cập nhật)
    public static function update(int $id)
    {
        // echo 'Thực hiện cập nhật vào database';
        //validation cac truong du lieu 
        $is_valid = UserValidation::edit();
        if (!$is_valid) {
            NotificationHelper::error('update', 'Cập nhật người dùng thất bại');
            header("location: /admin/users/$id");
            exit;
        }
        $User = new User();
        
        
//         // thuc hien cap nhat


        $data = [
            'email' => $_POST['email'],
            'name' => $_POST['name'],
            'status' => $_POST['status']

        ];
        if($_POST['password'] !== ''){
            $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }

        $is_upload = UserValidation::uploadAvatar();
        if($is_upload){
            $data['avatar'] = $is_upload;
        }
        $result = $User->updateUser($id,$data);
        if ($result) {
            NotificationHelper::success('update', 'Cập nhật người dùng thành công');
            header('location: /admin/users');
        } else {
            NotificationHelper::error('update', 'Cập nhật người dùng thất bại');
            header("location: /admin/users/$id");
        }
    }


//     // thực hiện xoá
    public static function delete(int $id)
    {
        $User = new User();
        $result = $User->deleteUser($id);
        
        if($result){
            NotificationHelper::success('delete','Xoá người dùng thành công');

        }else{
            NotificationHelper::error('delete', 'Xoá người dùng thất bại');
        }
        header('location: /admin/users');

    }
}
