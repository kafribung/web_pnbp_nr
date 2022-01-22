<?php

namespace App\Http\Livewire\RekapPnbpNr;

use App\Http\Livewire\RekapPnbpNr\RekapPnbpNr;
use Livewire\Component;
use Barryvdh\DomPDF\Facade as PDF;

class CetakLaporan extends RekapPnbpNr
{
    // use PDF;
    public $view = false;

    protected $listeners = [
        'print'
    ];

    public function render()
    {
        return view('livewire.rekap-pnbp-nr.cetak-laporan');
    }

    public function print($month, $year)
    {
        $pdf = PDF::loadView($this->render());
        return response()->streamDownload(
            fn () => print($pdf),
            "filename.pdf"
        );
    }
}
