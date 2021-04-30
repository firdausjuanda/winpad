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
    <?php $path = 'test/reduce_file';?>
    <?= form_open_multipart($path);?>
    <input type="text" name="id" id="id">
    <input type="file" name="upload_file" id="upload_file">
    <input type="submit" value="Submit">
    </form>
</body>
</html>