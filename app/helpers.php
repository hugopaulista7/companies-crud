<?php

if(!function_exists('flashMessage')) {
    function flashMessage($message, $alertClass)
    {
        \Session::flash('message', $message);
        \Session::flash('alert-class', $alertClass);
    }
}
