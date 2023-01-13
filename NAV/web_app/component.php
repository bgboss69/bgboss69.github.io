<?php

function component($productname, $productprice, $productimg, $productid, $productdetail){
    $element = "
    
    <div class=\"item\">
        <form action=\"index.php\" method=\"post\">
            <div class=\"top\">
                <img src=\"$productimg\">
            </div>
            <div class=\"middle\">
                <h4>$productname</h4>
                <p>$productdetail</p>
            </div>
            <div class=\"bottom\">
                <div class=\"left\">
                    <h5>RM$productprice</h5>
                </div>
                <div class=\"right\">
                    <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                    <input type='hidden' name='product_id' value='$productid'>
                </div>
            </div>  
        </form>
    </div>

    ";
    echo $element;
}


// function cartElement($productimg, $productname, $productprice, $productid){
//     $element = "
    
//     <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
//         <div class=\"border rounded\">
//             <div class=\"row bg-white\">
//                 <div class=\"col-md-3 pl-0\">
//                     <img src=$productimg alt=\"Image1\" class=\"img-fluid\">
//                 </div>
//                 <div class=\"col-md-6\">
//                     <h5 class=\"pt-2\">$productname</h5>
//                     <small class=\"text-secondary\">Seller: dailytuition</small>
//                     <h5 class=\"pt-2\">RM$productprice</h5>
//                     <button type=\"submit\" class=\"btn btn-warning\">Save for Later</button>
//                     <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
//                 </div>
//                 <div class=\"col-md-3 py-5\">
//                     <div>
//                         <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-minus\"></i></button>
//                         <input type=\"text\" value=\"1\" class=\"form-control w-25 d-inline\">
//                         <button type=\"button\"  class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-plus\"></i></button>
//                     </div>
//                 </div>
//             </div>
//         </div>
//     </form>

    
//     ";
//     echo  $element;
// }


function cartElement($productimg, $productname, $productprice, $productid){
    $element = "
    <div class=\"box\">
        <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"ct\">
        <div class=\"lt\">
            <img src=\"$productimg\" >
        </div>
        <div class=\"rt\">
            <p> $productname <br>
            RM<span>$productprice</span></p>
        </div>
            <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
        </form>
    </div>
    
    ";
    echo  $element;
}


?>