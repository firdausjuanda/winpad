<?php?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Permit</title>
</head>
<body>
<h3>Input new Permit</h3>
    <h5 style="color: red;"><?php echo validation_errors(); ?></h5>
    <form action="new_permit" method="post">
        <label for="permit_date">Date</label>
        <input type="date" name="permit_date" placeholder="Date"><br>
        <label for="permit_category">Category</label>
        <select name="permit_category" name="permit_category">
            <option value="HOWP">Hot Work Permit</option>
            <option value="COWP">Cold Work Permit</option>
            <option value="WAHP">Work at Height Permit</option>
            <option value="LOWP">LOTO Work Permit</option>
            <option value="EXWP">Excapation Work Permit</option>
            <option value="DIWP">Dig Work Permit</option>
            <option value="HWP">Hot Work Permit</option>
        </select><br>
        <label for="permit_no">Permit No.</label>
        <input type="number" name="permit_no" placeholder="Permit No."><br>
        <label for="permit_area">Area</label>
        <select name="permit_area" name="permit_area">
            <option value="Factory">Tank Farm</option>
            <option value="Utility">Utility</option>
            <option value="Production">Production</option>
            <option value="Office">Office</option>
            <option value="WB">Weight Bridge</option>
            <option value="Store">Store</option>
            <option value="Engineering">area</option>
            <option value="Tank Farm">Tank Farm</option>
            <option value="Shipping">Shipping</option>
            <option value="MBA">MBA</option>
            <option value="TBBT">TBBT</option>
        </select><br>
        <label for="permit_title">Title</label>
        <input type="text" name="permit_title" placeholder="Title"><br>
        <label for="permit_description">Desciption</label>
        <textarea type="text" name="permit_description" placeholder="Description"></textarea><br>
        <label for="permit_user">User</label>
        <input type="text" name="permit_user" value="<?= $userData['user_username'];?>" placeholder="User" readonly><br>
        <label for="permit_company">Company</label>
        <input type="text" name="permit_company" value="<?= $userData['user_company'];?>" placeholder="Company" readonly><br>
        <button type="submit">Submit</button>
    </form>
    <a href="<?= base_url('home'); ?>"> Back</a>
</body>
</html>