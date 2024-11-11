<?php

namespace App\Views\Client\Pages\About;

use App\Views\BaseView;


class Index extends BaseView
{
    public static function render($data = null)
    {

?>
<div class="about" id="About">
        
        <h1>Web<span>About</span></h1>

        <div class="about_main">
            <div class="about_image">
                <div class="about_small_image">
                    <img src="../../../public/assets/client/image/red_shoes1.png" onclick="functio(this)">
                    <img src="../../../public/assets/client/image/red_shoes2.png" onclick="functio(this)">
                    <img src="../../../public/assets/client/image/red_shoes3.png" onclick="functio(this)">
                    <img src="../../../public/assets/client/image/red_shoes4.png" onclick="functio(this)">
                </div>

                <div class="image_contaner">
                    <img src="../../../public/assets/client/image/red_shoes1.png" id="imagebox">
                </div>

            </div>

            <div class="about_text">
                <p>
                    Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical 
                    Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at 
                    Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a 
                    Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the 
                    undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" 
                    (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, 
                    very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes 
                    from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below 
                    for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also 
                    reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
                </p>
            </div>

        </div>

        <a href="#" class="about_btn">Shop Now</a>

        <script>
            function functio(small){
                var full = document.getElementById("imagebox")
                full.src = small.src
            }
        </script>
        
    </div>
    <?php

}
}
