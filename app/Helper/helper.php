<?php

// Mendapatkan nama aplikasi dari .env
function get_app_name()
{
    return env('APP_NAME');
}

// Mendapatkan tahun saat ini menggunakan fungsi PHP
function get_copyright_year()
{
    $currentYear = date("Y");
    return $currentYear;
}

