<?php

namespace App\Http\Controllers;

use App\Models\{Desa, Pernikahan};
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


class PrintController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $currnetMonth = 1;
        $currnetYear  = 2022;
        $desas        = Desa::where('kua_id', auth()->user()->kua_id)->get();
        $pernikahans  = Pernikahan::with('penghulu', 'peristiwa_nikah', 'desa')
                        ->whereMonth('date_time', $currnetMonth)
                        ->whereYear('date_time', $currnetYear)
                        ->where('kua_id', auth()->user()->kua_id)
                        ->latest()
                        ->get();

        return view('prints.print', compact('desas', 'currnetMonth', 'currnetYear', 'pernikahans'));

        // $pdf = PDF::loadView('prints.print', compact('desas'));
        // return $pdf->download('invoice.pdf');
    }
}
