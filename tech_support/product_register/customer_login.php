<?php include '../view/header.php'; ?>

<main>

    <h2>Customer Login</h2>

    <p>You must login before you can register a product.</p>

    <form action="." method="post" id="aligned">
        <input type="hidden" name="action" value="show_register_form">

        <label>Email: </label>
        <input type="text" name="email">

        <label>&nbsp;</label>
        <input type="submit" value="login">
    </form>






</main>

<?php include '../view/footer.php'; ?>