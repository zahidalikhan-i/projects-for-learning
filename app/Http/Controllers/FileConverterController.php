<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;
use Dompdf\Options;
use Spatie\PdfToText\Pdf;
use PhpOffice\PhpWord\PhpWord;

class FileConverterController extends Controller
{
    public function convertWordToPdf(Request $request)
    {
        $request->validate([
            'word_file' => 'required|mimes:doc,docx'
        ]);

        $file = $request->file('word_file');
        $phpWord = IOFactory::load($file->getPathname());

        $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
        ob_start();
        $htmlWriter->save('php://output');
        $html = ob_get_clean();

        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->render();

        $pdfContent = $dompdf->output();
        $pdfPath = storage_path('app/public/converted.pdf');
        file_put_contents($pdfPath, $pdfContent);

        return response()->download($pdfPath);
    }

    public function convertPdfToWord(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf'
        ]);

        $file = $request->file('pdf_file');
        $text = Pdf::getText($file->getPathname());

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addText($text);

        $wordFile = storage_path('app/public/converted.docx');
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($wordFile);

        return response()->download($wordFile);
    }

    public function showPdf()
    {
        $pdfPath = storage_path('app/public/converted.pdf');

        if (!file_exists($pdfPath)) {
            return redirect()->route('converter')->with('error', 'No PDF available. Please convert a Word file first.');
        }

        return response()->download($pdfPath, 'converted.pdf', [
            'Content-Type' => 'application/pdf',
        ]);
    }
}