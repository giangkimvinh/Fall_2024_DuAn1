<?php

namespace App\Views\Client\Pages\Auth;

use App\Views\BaseView;

class Login extends BaseView{
    public static function render($data = null)
    {
?>

<!-- Code giao diện -->
<div class="container mt-5">
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div class="card card-body">
                <h4 class="text-danger text-center">Sign In</h4>
                <form action="/login" method="post">
                    <input type="hidden" name="method" value="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Nhập tên đăng nhập">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu">
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="" name="remember" checked/>
                        <label class="form-check-label" for=""> Remember!</label>
                    </div>
                
                    
                    <button type="reset" class="btn btn-outline-danger">Reset</button>
                    <button type="submit" class="btn btn-outline-info">Sign In</button>
                    <br>
                    <a href="/forgot-password" class="text-danger">Forgot password?</a>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
    }
}