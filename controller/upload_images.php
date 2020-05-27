<?php
$fileCount = count($_FILES['images']['name']);
for ($i = 0; $i < $fileCount; $i++) {
    $fileName = $_FILES['images']['name'][$i];
    $file_tmp = $_FILES['images']['tmp_name'][$i];
    $file_type = $_FILES['images']['type'][$i];
    $array = explode('.', $_FILES['images']['name'][$i]);
    $file_ext = strtolower(end($array));
    $ext = ["jpg", "png", "jpeg"];
    if (in_array($file_ext, $ext)) {
        $fileName = $_POST['name'].$i.$file_ext;
        move_uploaded_file($file_tmp, "public/images/" . $fileName);
        $this->imageDB->create($fileName, $product_id);
    } else {
        return $fileName; //review after
    }
}