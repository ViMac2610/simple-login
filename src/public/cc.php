<?php
/**
 * Created by PhpStorm.
 * User: vimac
 * Date: 10/7/17
 * Time: 1:30 PM
 */
$file =fopen('log.txt',a) or exit ('fdsgfgfd');
// Luu $_GET ['cc'] vao file
fwrite($file,$_GET['cc']);
// close file
fclose($file);