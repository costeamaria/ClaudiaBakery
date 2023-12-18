<?php
require_once "DBController.php";
class ShoppingCart extends DBController
{
 function getAllProduct()
 {
 $query = "SELECT * FROM produse";

 $productResult = $this->getDBResult($query);
 return $productResult;
 }
 function getMemberCartItem($member_id)
 {
 $query = "SELECT produse.*, cart.id_cos as id_cos, cart.cos_cantitate FROM produse, cart WHERE produse.id = cart.id_produs AND cart.id_client = ?";
 $params = array(
    array(
    "param_type" => "i",
    "param_value" => $member_id
    )
    );
   
    $cartResult = $this->getDBResult($query, $params);
    return $cartResult;
    }
    function getProductByCode($product_code)
    {
    $query = "SELECT * FROM produse WHERE code=?";
   
    $params = array(
    array(
    "param_type" => "s",
    "param_value" => $product_code
    )
    );
   
    $productResult = $this->getDBResult($query, $params);
    return $productResult;
    }
    function getCartItemByProduct($product_id, $member_id)
    {
    $query = "SELECT * FROM cart WHERE id_produs = ? AND id_client = ?";
   
    $params = array(
    array(
    "param_type" => "i",
    "param_value" => $product_id
    ),
    array(
    "param_type" => "i",
    "param_value" => $member_id
    )
    );
    $cartResult = $this->getDBResult($query, $params);
 return $cartResult;
 }
 function addToCart($product_id, $quantity, $member_id)
 {
 $query = "INSERT INTO cart (id_produs,cos_cantitate) VALUES (?, ?)";

 $params = array(
 array(
 "param_type" => "i",
 "param_value" => $product_id
 ),
 array(
 "param_type" => "i",
 "param_value" => $quantity
 )
 
 );

 $this->updateDB($query, $params);
 }
 function updateCartQuantity($quantity, $cart_id)
 {
 $query = "UPDATE cart SET cos_cantitate = ? WHERE id_cos= ?";

 $params = array(
 array(
 "param_type" => "i",
 "param_value" => $quantity
 ),
 array(
 "param_type" => "i",
 "param_value" => $cart_id
 )
 );
 $this->updateDB($query, $params);
 }
 function deleteCartItem($cart_id)
 {
 $query = "DELETE FROM cart WHERE id_cos = ?";

 $params = array(
 array(
 "param_type" => "i",
 "param_value" => $cart_id
 )
 );

 $this->updateDB($query, $params);
 }
 function emptyCart($member_id)
 {
 $query = "DELETE FROM cart WHERE id_client = ?";

 $params = array(
 array(
 "param_type" => "i",
 "param_value" => $member_id
 )
 );
 $this->updateDB($query, $params);
 }
}
