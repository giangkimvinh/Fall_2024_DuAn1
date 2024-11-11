<?php

namespace App\Views\Client\Components;

use App\Views\BaseView;

class Category extends BaseView
{
    public static function render($data = null)
    {
?>
        <div class="category-container p-3">
            <h5 class="text-center mb-4 font-weight-bold">Danh mục</h5>
            <nav class="nav flex-column shadow-sm">
                <a class="nav-link text-dark py-2" href="/products">Tất cả</a>
                <?php
                foreach ($data as $item) :
                ?>
                    <a class="nav-link text-dark py-2" href="/products/categories/<?= $item['id'] ?>"><?= $item['name'] ?></a>
                <?php
                endforeach;
                ?>
            </nav>
        </div>

        <style>
            .category-container {
                background-color: #f8f9fa;
                border-radius: 5px;
            }

           
            .nav-link:hover {
                background-color: blue;
            }

            .nav-link {
                transition: background-color 0.3s, color 0.3s;
            }
        </style>

<?php
    }
}
