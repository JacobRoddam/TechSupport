<?php include '../view/header.php'; ?>
<main>
    <h1>Create Incident</h1>
    
    <form action="." method="post" id="aligned">

        <label>Customer: </label>
        <p><?php echo $customerName ?></p> <br>

        <input type="hidden" name="action" value="create_incident">

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

        <label>Title: </label>
        <input type="text" name="title"> <br>

        <label>Description: </label>
        <textarea name="description" rows="4" cols="50"></textarea>

        <label>&nbsp;</label>
        <input type="submit" value="Create Incident">
    </form>
    
    

</main>
<?php include '../view/footer.php'; ?>