<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class DocumentasiController extends Controller
{
    /**
     * Tampilkan preview dokumentasi langsung di browser.
     */
    public function preview(): Response
    {
        ini_set('memory_limit', '256M');
        set_time_limit(120);

        $pdf = Pdf::loadView('dokumentasi-pdf');
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('dokumentasi-proyek-perpustakaan.pdf');
    }

    /**
     * Download PDF dokumentasi proyek.
     */
    public function download(): Response
    {
        ini_set('memory_limit', '256M');
        set_time_limit(120);

        $pdf = Pdf::loadView('dokumentasi-pdf');
        $pdf->setPaper('a4', 'portrait');

        return $pdf->download('dokumentasi-proyek-perpustakaan.pdf');
    }
}
