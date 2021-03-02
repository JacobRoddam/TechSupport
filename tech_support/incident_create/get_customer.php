<?php include '../view/header.php'; ?>

<main>

    <h2>Get Customer</h2>

    <p>You must enter the customer's email address in order to get the customer.</p>

    <form action="." method="post" id="aligned">
        <input type="hidden" name="action" value="create_incident_form">

        <label>Email: </label>
        <input type="text" name="email">

        <label>&nbsp;</label>
        <input type="submit" value="login">
    </form>






</main>

<?php include '../view/footer.php'; ?>