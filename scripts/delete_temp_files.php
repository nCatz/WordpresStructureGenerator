<?php
$path = 'temp/';
if ($handle = opendir($path)) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            if ((time()-filectime($path.$file)) >= 86400) {
                unlink($path.$file);
            }
        }
    }
    closedir($handle);
}
?>