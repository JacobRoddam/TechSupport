<?php include '../view/header.php'; ?>
<main>
    <h1>Register Product</h1>
    <div id=aligned>
        <label>Customer: </label>
        <p><?php echo $customerName ?></p> <br>

        <form action="." method="post" id="aligned">

        <input type="hidden" name="action" value="register_product">

        <input type="hidden" name="customerID" value="<?php echo $customer['customerID'] ?>">
        

        <label>Product: </label>
        <select name="productCode">
            <option selected="selected">Choose product</option>
            <?php  foreach ($products as $product) : ?>
                <option value="<?php echo $product['productCode'] ?>">
                    <?php echo $product['name']; ?>
                </option>
            <?php endforeach; ?>
        </select> <br>

        <label>&nbsp;</label>
        <input type="submit" value="Register Product">
        </form>
    
    </div>

</main>
<?php include '../view/footer.php'; ?>