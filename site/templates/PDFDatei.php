<?php
// pdf.php

if($page->pdf){
    wireSendFile($page->pdf->filename);
}
?>