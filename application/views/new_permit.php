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
    <form action="<?=$workData['work_id'];?>" method="post">
        <label for="permit_date">Date</label>
        <input type="date" name="permit_date" placeholder="Date"><br>
        <label for="permit_category">Category</label>
        <select name="permit_category" name="permit_category">
            <option value="">-Select Permit-</option>
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
        <input readonly name="permit_area" type="text" value="<?= $workData['work_area'];?>" ><br>
        <label for="permit_title">Title</label>
        <input readonly type="text" name="permit_title" value="<?= $workData['work_title'];?>" placeholder="Title"><br>
        <label for="permit_description">Desciption</label>
        <textarea type="text" name="permit_description" placeholder="Description"></textarea><br>
        <label for="permit_user">User</label>
        <input type="text" name="permit_user" value="<?= $userData['user_username'];?>" placeholder="User" readonly><br>
        <label for="permit_company">Company</label>
        <input type="text" name="permit_company" value="<?= $userData['user_company'];?>" placeholder="Company" readonly><br>
        <button type="submit">Submit</button>
    </form>
    <a href="<?= base_url('work/detail_work/').$workData['work_id']; ?>"> Back</a>
</body>
</html>