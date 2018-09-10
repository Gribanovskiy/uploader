<?php

define('UPLOADED_FILE_NAME', 'file');
print("Start upload...\n\r");
$fileName = $_REQUEST['filename'] ?? uniqid(time());
if ($fileName && is_uploaded_file($_FILES[UPLOADED_FILE_NAME]['tmp_name'])) {
    save($fileName);
} else {
    print("Invalid request...\n\r");
}

function save (string $fileName)
{

    $tmp = $_FILES[UPLOADED_FILE_NAME]['tmp_name'];
    $ext = extraxtExt($fileName);
    $dir = sprintf('./uploaded/%s.%s', $fileName, $ext);
    try {
        move_uploaded_file($tmp, $dir);
        print('Ok');
    } catch (\Exception $e) {
        throw new LogicException('Something went wrong', 400);
    }
}

function extraxtExt(string $fileName): string
{
    $ext = $_FILES[UPLOADED_FILE_NAME]['name'];
    $ext = explode('.', $ext);

    return end($ext);
}