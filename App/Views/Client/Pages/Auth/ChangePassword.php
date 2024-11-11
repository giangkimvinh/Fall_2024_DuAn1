<?php

namespace App\Views\Client\Pages\Auth;

use App\Views\BaseView;

class ChangePassword extends BaseView
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
                <div class="card card-body">
                    <h4 class="text-danger text-center">Change Password</h4>
                    <form action="/change-password" method="post">
                        <input type="hidden" name="method" value="PUT" id="">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Nhập tên đăng nhập" disabled value="<?= $data['username'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="old_password">Old Password</label>
                            <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Nhập mật khẩu cũ">
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Nhập mật khẩu mới">
                        </div>
                        <div class="form-group">
                            <label for="re_password">Re-enter Password New</label>
                            <input type="password" name="re_password" id="re_password" class="form-control" placeholder="Nhập lại mật khẩu mới">
                        </div>
                        <button type="reset" class="btn btn-outline-danger">Reset</button>
                        <button type="submit" class="btn btn-outline-info">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
        </div>


<?php
    }
}
