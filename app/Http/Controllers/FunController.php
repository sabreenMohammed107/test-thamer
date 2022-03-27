<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use PDF;
class FunController extends Controller
{
    public function htmlPdf()
    {
        $data = [
            'foo' => 'bar'
          ];
          $pdf = PDF::loadView('htmlPdf', $data);
          return $pdf->stream('pdfview.pdf');
        }

    public function document()
    {
          // selecting PDF view
          $pdf = pdf::loadView('htmlPdf');

          // download pdf file
          return $pdf->download('pdfview.pdf');


    }
}
