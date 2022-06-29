<?php

namespace App\Http\Livewire\Pdf;

use App\Models\Generate;
use Livewire\Component;
use PDF;

class FacultyPdf extends Component
{

    public function facultyPDF()
    {

            $title = 'Welcome to ItSolutionStuff.com';
            $date = date('m/d/Y');


        $pdf = PDF::loadView('faculty-pdf',  $title , $date );

        return $pdf->download('faculty-pdf.pdf');

    }
    public function render()
    {
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];
        $title = 'Welcome to ItSolutionStuff.com';
        $date = date('m/d/Y');
        $pdf = PDF::loadView('livewire.pdf.faculty-pdf', $data);
        $pdf->download('faculty-pdf.pdf');
        return view('livewire.pdf.faculty-pdf',[
            'date' => $date,
            'title' =>  $title,
            
        ]);
    }
}
