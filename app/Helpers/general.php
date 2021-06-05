<?php

define('PAGINATION_COUNT', 10);

function getFolder()
{
    return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
}


function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    return $filename;
}

function deletePhotos($image_link)
{
    $image = \Illuminate\Support\Str::after($image_link, 'assets/');
    $image = public_path('assets/' . $image);
    unlink($image);
}

function uploadPdf($folder, $pdf)
{
    $pdf->store('/', $folder);
    $PDF_fileName = $pdf->hashName();
    return $PDF_fileName;
}

function deletePdf($pdf_link)
{
    $pdf = \Illuminate\Support\Str::after($pdf_link, 'assets/');
    $pdf = public_path('assets/' . $pdf);
    unlink($pdf);
}

function changeSts($status, $q)
{
    $status = $status == 1 ? 0 : 1;
    $q->update(['is_active' => $status]);
}
