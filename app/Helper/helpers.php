<?php
if (!function_exists('create_reponse')) {
    function create_reponse()
    {
        $response = new stdClass;
        $response->status = 'Failed';
        $response->status_code = 400;
        $response->data = [];
        $response->message = '';

        return $response;
    }
}



if (!function_exists('rupiah')) {
    function rupiah($angka)
    {
        $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
        return $hasil_rupiah;
    }
}
