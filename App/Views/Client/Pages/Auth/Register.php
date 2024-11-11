<?php

namespace App\Views\Client\Pages\Auth;

use App\Views\BaseView;

class Register extends BaseView{
    public static function render($data = null)
    {
?>

<!-- Code giao diện -->
<div class="container mt-5">
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div class="card card-body">
                <h4 class="text-danger text-center">Sign Up</h4>
                <form action="/register" method="post">
                    <input type="hidden" name="method" value="POST" id="">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Nhập tên đăng nhập">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu">
                    </div>
                    <div class="form-group">
                        <label for="re_password">Re-enter Password</label>
                        <input type="password" name="re_password" id="re_password" class="form-control" placeholder="Nhập lại mật khẩu">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="name" name="name" id="name" class="form-control" placeholder="Nhập name">
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