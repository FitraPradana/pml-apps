<?php

namespace App\Http\Controllers;

use App\Models\StockTakeTransaction;
use Illuminate\Http\Request;

use PDF;
use Mail;

class SendMailController extends Controller
{
        //



        public function test_index()
        {
            $today = today()->format('d-M-y');
            // dd($id);
            // instantiate and use the dompdf class
            $pdf_doc = new PDF();
            $pdf_doc = PDF::loadView('emails.test_email', compact('today'));
            // (Optional) Setup the paper size and orientation
            $pdf_doc->setPaper('A4', 'landscape');
            // Render the HTML as PDF
            $pdf_doc->render();
            // Output the generated PDF to Browser
            return $pdf_doc->stream();
            // return view('emails.test_email');
        }

        public function test_send_email()
        {
            $data["email"] = "pradanafitrah45@gmail.com";
            $data["title"] = "Admin Asset Management PML";
            $data["body"] = "Status Asset berhasil di Update";
            $data["today"] = today()->format('d-M-y');

            $pdf = PDF::loadView('emails.ba_status.pdf', $data);

            Mail::send('emails.ba_status.body', $data, function($message)use($data, $pdf) {
                $message->to($data["email"], $data["email"])
                        ->subject($data["title"])
                        ->attachData($pdf->output(), "BA Status Asset.pdf");
            });

            dd('Mail sent successfully');
        }




        public function ba_status($id)
        {
            $data["email"] = "pradanafitrah45@gmail.com";
            $data["title"] = "Admin Asset Management PML";
            $data["body"] = "Status Asset berhasil di Update";
            $data["today"] = today()->format('d-M-y');
            $data["stock_take"] = StockTakeTransaction::with('site')->where('id', $id)->first();

            $pdf = PDF::loadView('emails.ba_status.pdf', $data);

            Mail::send('emails.ba_status.body', $data, function($message)use($data, $pdf) {
                $message->to($data["email"], $data["email"])
                        ->subject($data["title"])
                        ->attachData($pdf->output(), "BA Status Asset.pdf");
            });

        }


}
