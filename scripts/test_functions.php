<?php

//function to call <pre> tag on preformatted data like php array objects
function print_array($arr_in)
{
    echo "<pre>";
        print_r($arr_in); // or var_dump($data);
    echo "</pre>";
}
