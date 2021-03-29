<?php?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Work</title>
</head>
<body>
<h3>Input new Work</h3>
    <h5 style="color: red;"><?php echo validation_errors(); ?></h5>
        <?php echo form_open_multipart('work/new_work');?>
        <label for="work_date_open">Date</label>
        <input type="date" name="work_date_open" value="<?= form_error('work_date_open');?>" placeholder="Date"><br>
        <label for="work_area">Area</label>
        <select name="work_area" name="work_area">
            <option value="">-Select area-</option>
            <option value="Factory">Factory</option>
            <option value="Utility">Utility</option>
            <option value="Production">Production</option>
            <option value="Office">Office</option>
            <option value="WB">Weight Bridge</option>
            <option value="Store">Store</option>
            <option value="Engineering">Engineering</option>
            <option value="Tank Farm">Tank Farm</option>
            <option value="Shipping">Shipping</option>
            <option value="MBA">MBA</option>
            <option value="TBBT">TBBT</option>
        </select><br>
        <label for="work_exact_place">Exact place</label>
        <input type="text" name="work_exact_place" placeholder="Exact place"><br>
        <label for="work_title">Title</label>
        <input type="text" name="work_title" placeholder="Title"><br>
        <label for="work_description">Desciption</label>
        <textarea type="text" name="work_description" placeholder="Description"></textarea><br>
        <label for="work_img_open">Current Image</label>
        <input type="file" name="work_img_open" placeholder="Work current image"><br>
        <label for="work_user">User</label>
        <input type="text" name="work_user" value="<?= $userData['user_username'];?>" placeholder="User" readonly><br>
        <label for="work_company">Company</label>
        <input type="text" name="work_company" value="<?= $userData['user_company'];?>" placeholder="Company" readonly><br>
        <button type="submit">Submit</button>
    </form>
    <a href="<?= base_url('home'); ?>"> Back</a>
</body>
</html>