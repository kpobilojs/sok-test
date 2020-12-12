<?php

function dump($var)
{
    var_dump($var);
}

function dd($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die;
}

function ff($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
    die;
}