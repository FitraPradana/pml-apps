<?php

if (!function_exists('rupiah')) {
    function rupiah($angka)
    {

        return "" . number_format($angka, 3, '.', ',');
    }
}
