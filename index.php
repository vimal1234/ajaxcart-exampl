<?php
/*
********================================*****************
* Shopping Cart Version 4.0 
* Written by Vasplus Programming Blog
* Website: www.vasplus.info
* All Copy Rights Reserved by Vasplus Programming Blog
*********=================================****************
*/
session_start(); //You must always start session at the very top of your page as the first variable before any other as defined here

//Include the database connection settings file
include("config.php"); 

/*
This line of code identifies a user that wants to add an item to cart therefore, you can pass the username of all your logged in users to the variable $_SESSION["REMOTE_ADDR"] incase you have a login process associated with your system. 

For example: 
$_SESSION["REMOTE_ADDR"] = $logged_in_user_variable;
*/
if(!isset($_SESSION["REMOTE_ADDR"])) { $_SESSION["REMOTE_ADDR"] = $_SERVER['REMOTE_ADDR']; } else { /*Do nothing since the session already exist man*/ } 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>vasPLUS Programming Blog - Shopping Cart Version 4.0</title>




<!--INLUDED FILES -->
<script type="text/javascript" language="javascript" src="jquery_1.5.2.js"></script>
<script type="text/javascript" language="javascript" src="vasplus_programming_blog_shopping_cart_v4.js"></script>
<link type="text/css" rel="stylesheet" media="all" href="vasplus_programming_blog_shopping_cart_v4.css" />




</head>
<body>




<center>
<div style="" id="vasplus_programming_blog_shopping_cart_main_wrapper">
<div id="vasplus_programming_blog_shopping_cart_left_wrapper" align="left">

<?php
//Check for all items available for sale in the product table from the database
$vpb_check_items = mysql_query("select * from `products` order by `id` desc");

//If there are no items to display to customers or buyers, display a no item message to the screen and that's cool man
if(mysql_num_rows($vpb_check_items) < 1)
{
	?>
    <div id="response" align="center"><div id="vpb_shopping_cart_is_currently_empty" align="left">
    Hello There, <br /><br />There are no items to display at the moment. Please check back later in the day.<br /><br />Thanks You...
    </div></div>
    <?php
}
else
{
	//If there are items in the product table in the database available for salem then get all these items and display them as shown below
	while($vpb_get_items = mysql_fetch_array($vpb_check_items))
	{
		?>
        <div id="vasplus_programming_blog_shopping_cart_inner_left_wrapper" align="left">
		<div style="width:130px; float:left;" align="left"><img src="<?php echo strip_tags($vpb_get_items['image']); ?>" width="110" height="100" /></div>
        <div style="width:260px; float:left;" align="left">
        <div align="left" style="margin-bottom:5px;"><b><?php echo strip_tags($vpb_get_items['name']); ?></b></div>
		<?php echo strip_tags($vpb_get_items['description']); ?><br />
        <div style="margin-bottom:18px; padding-top:10px;">Price: $<?php echo strip_tags($vpb_get_items['price']); ?></div>
        <input type="button" id="vasplus_p_blog_add_to_cart_button" value="Add to Cart" title="Add this item to cart" onclick="vpb_add_to_cart('<?php echo strip_tags($vpb_get_items['name']); ?>','<?php echo strip_tags($vpb_get_items['price']); ?>','add');" />
        
        </div>
        </div><br clear="all" /><br clear="all" />
		<?php
		
	}
}
?>
</div>

<div id="vasplus_programming_blog_shopping_cart_right_wrapper" align="left">

<div id="vasplus_programming_blog_cart_titles" class="shopping_cart_status">Shopping Cart Status</div>
<div class="checkout_user_info" style="display:none;"><div id="vasplus_programming_blog_cart_titles" style="float:left; width:340px;">User Information</div><div style="float:left;"><input type="text" class="vpb_final_total_field" id="cartItemsTotals" disabled="disabled" readonly="readonly" value="" /></div></div>
<br clear="all" /><br clear="all" />





<div id="checkout_user_info" style="display:none;">
<div style="float:left; width:110px; padding-top:10px;" align="left">Your Fullname:</div>
<div style="float:left; width:290px;" align="left"><input type="text" id="vpb_fullname" class="vpb_total_fields" /></div><br clear="all" /><br clear="all" />

<div style="float:left; width:110px; padding-top:10px;" align="left">Email Address</div>
<div style="float:left; width:300px;" align="left"><input type="text" id="vpb_email" class="vpb_total_fields" /></div><br clear="all" /><br clear="all" />

<div style="float:left; width:110px; padding-top:10px;" align="left">Home Address</div>
<div style="float:left; width:300px;" align="left"><input type="text" id="vpb_address" class="vpb_total_fields" /></div><br clear="all" /><br clear="all" />

<div style="float:left; width:110px; padding-top:10px;" align="left">Phone Number</div>
<div style="float:left; width:300px;" align="left"><input type="text" id="vpb_phone" class="vpb_total_fields" /></div><br clear="all" /><br clear="all" />

<div style="float:left; width:110px; padding-top:10px;" align="left">&nbsp;</div>
<div style="float:left; width:370px;" align="left"><div id="response_status_brought"></div></div><br clear="all" />

<div style="float:left; width:110px; padding-top:10px;" align="left">&nbsp;</div>
<div style="float:left; width:300px;" align="left"><input type="button" id="vasplus_p_blog_add_to_cart_button" style="float:left;width:100px; padding:10px;" value="Submit" onclick="vpb_submitCart();" /><input type="button" value="Go back" title="Clear entire cart items" id="vpb_cart_buttons" onclick="vpb_go_back();" style="float:left; margin-left:20px; width:100px; padding:12px;" /></div><br clear="all" /><br clear="all" />

</div>
<div id="shopping_cart_status">
<?php
//Check if a specified user has already added a specified item to cart by checking the database products_added's table
$vpb_check_all_items = mysql_query("select * from `products_added` where `username` = '".mysql_real_escape_string($_SESSION["REMOTE_ADDR"])."' order by `id` asc");

//If the specified user has not already added the specified item to database products_added's table then, display a no product added to cart message to the specified user
if(mysql_num_rows($vpb_check_all_items) < 1)
{
	?>
    <div id="response" align="center"><div id="vpb_shopping_cart_is_currently_empty" align="left">
    Hello There, <br /><br />Your shopping cart is empty at the moment. <br />Please click on the add to cart buttons at the bottom of each item at the left to add an item of your choice to cart.<br /><br />Thanks You...
    </div></div>
    <?php
}
else
{
	//Check the databse products_added's table and sum up the total of all added items to cart
	$vpb_check_itemsTotal = mysql_query("select sum(amount) as `items_total` from `products_added` where `username` = '".mysql_real_escape_string($_SESSION["REMOTE_ADDR"])."'");
	
	//Get all these items
	$vpb_get_itemsTotal = mysql_fetch_array($vpb_check_itemsTotal);
	$groundtotal = ($vpb_get_itemsTotal["items_total"]); //Get total of all added items
	?>
    <div id="response" align="center" style="float:left;">
    <div id="vpb_item_numbers" class="vpb_all_tops">No</div>
    <div id="vpb_item_namess" class="vpb_all_tops" align="left">Item Name</div>
    <div id="vpb_item_prices" class="vpb_all_tops">Price</div>
    <div id="vpb_item_quantities" class="vpb_all_tops">Qty</div>
    <div id="vpb_item_amounts" class="vpb_all_tops">Amount</div>
    <div id="vpb_item_actions" class="vpb_all_tops">Action</div><br clear="all" />
    <?php
    $number_of_items = 1;//Item numbers assigned to 1 to later increment by 1
	
	//Fetch all added items and display to the screen for the specified user
    while($vpb_get_all_items = mysql_fetch_array($vpb_check_all_items))
    {
		$item_id = strip_tags($vpb_get_all_items["id"]);
        $item_name = strip_tags($vpb_get_all_items["item_added"]);
        $price = strip_tags($vpb_get_all_items["price"]);
        $quantity = strip_tags($vpb_get_all_items["quantity"]);
        $amount = strip_tags($vpb_get_all_items["amount"]);
        $date = strip_tags($vpb_get_all_items["date"]);
        ?>
        <div id="items_cover<?php echo $item_id; ?>" style="">
        <div id="vpb_item_numbers" style="border-top:0px solid #FFF;"><?php echo $number_of_items++; ?></div>
        <div id="vpb_item_namess" style="border-top:0px solid #FFF;" align="left"><?php echo $item_name; ?></div>
        <div id="vpb_item_prices" style="border-top:0px solid #FFF;">$<?php echo $price; ?></div>
        <div id="vpb_item_quantities" style="border-top:0px solid #FFF;"><?php echo $quantity; ?></div>
        <div id="vpb_item_amounts" style="border-top:0px solid #FFF;">$<?php echo $amount; ?></div>
        <div id="vpb_item_actions" style="padding-bottom:9px; padding-top:9px;border-top:0px solid #FFF;"><a href="javascript:void(0);" style="width:10px; height:10px; padding:3px;padding-left:8px;padding-right:8px; text-decoration:none;" id="vpb_cart_buttons" title="Remove this item" onclick="vpb_remove_this_item('<?php echo $item_id; ?>');">X</a></div>
        <br clear="all" /></div>
        <?php
    }
    ?>
    <div style="border:1px solid #E2E2E2;border:0px solid #FFF;width:495px;margin-top:25px;">
    <div style="width:295px;float:left; padding-top:1px; font-weight:bold;" align="left">
    <input type="text" class="vpb_total_field" disabled="disabled" id="new_sum" value="Items Total: $<?php echo $groundtotal; ?>" />
    </div>
    <div style="width:100px;float:left;" align="right"><input type="button" value="Clear Cart" title="Clear entire cart items" id="vpb_cart_buttons" onclick="vpb_clear_cart('<?php echo $_SESSION["REMOTE_ADDR"]; ?>');" /></div>
    <input type="hidden" id="vpb_main_total_cart_items" value="<?php echo $groundtotal; ?>" />
    <div style="width:100px;float:left;" align="right"><input type="button" value="Checkout" title="Check out to make payment" id="vasplus_p_blog_add_to_cart_button" onclick="vpb_checkout();" /></div>
    </div><br clear="all" />
<?php
}
?>
</div>



</div><br clear="all" />
</div><br clear="all" />

</div>
</center>



</body>
</html>