<?php ;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?= $this->session->flashdata('message'); ?>
    <h5><?php echo validation_errors(); ?></h5>
    <?php $path = 'work/complete_work/'.$work['work_id'];?>
    <?= form_open_multipart($path);?>
    <input type="hidden" name="work_id" value="<?= $work['work_id'];?>">
    <input type="hidden" name="work_date_open" value="<?= $work['work_date_open'];?>">
    <input type="hidden" name="work_area" value="<?= $work['work_area'];?>">
    <input type="hidden" name="work_title" value="<?= $work['work_title'];?>">
    <input type="hidden" name="work_user" value="<?= $work['work_user'];?>">
    <input type="hidden" name="work_company" value="<?= $work['work_company'];?>">
    <input type="file" name="work_img_close" id="work_img_close" required>
    <input type="submit" value="Submit">
    </form>
</body>
</html>