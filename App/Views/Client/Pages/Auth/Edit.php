<?php

namespace App\Views\Client\Pages\Auth;

use App\Views\BaseView;

class Edit extends BaseView
{
    public static function render($data = null)
    {
?>

        <!-- Code giao diện -->
        <div class="container mt-5">
            <div class="row">
                <div class="offset-md-1 col-md-3">
                    <?php
                    if ($data && $data['avatar']) :
                    ?>
                        <img src="<?= APP_URL ?>/public/uploads/users/<?= $data['avatar'] ?>" alt="" width="100%">
                    <?php
                    else :
                    ?>
                        <img src="<?= APP_URL ?>/public/uploads/users/default_user2.png" alt="" width="100%">

                    <?php
                    endif;
                    ?>
                </div>
                <div class=" col-md-7">
                    <div class="card card-body">
                        <h4 class="text-danger text-center">Thông tin tài khoản</h4>
                        <form action="/users/<?= $data['id'] ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="method" value="PUT" id="">
                            <div class="form-group">
                                <label for="username">Tên tài khoản</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Nhập tên đăng nhập" value="<?= $data['username'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email" value="<?= $data['email'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="name">Họ và tên</label>
                                <input type="name" name="name" id="name" class="form-control" placeholder="Nhập name" value="<?= $data['name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="avatar">Ảnh đại diện</label>
                                <input type="file" name="avatar" id="avatar" class="form-control" placeholder="chọn ảnh đại diện">
                            </div>
                            <button type="reset" class="btn btn-outline-danger mb-3">Nhập lại</button>
                            <button type="submit" class="btn btn-outline-info mb-3">Cập nhật</button>
                            <br>
                            <a href="/change-password" class="text-danger">Đổi mật khẩu</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>


<?php
    }
}
