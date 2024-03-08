<?php

namespace App\Http\Controllers;

use App\Models\ReportClass;
use Barryvdh\DomPDF\Facade\Pdf;
use Gate;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{


    public function createBill(ReportClass $pay)
    {


        $report = request('pay','id');

        $some_data = array(
            'userSecretKey'=> config('toyyibpay.key'),
            'categoryCode'=> config('toyyibpay.category'),
            'billName'=>$report->registrar->code,
            'billDescription'=>$report->month,
            'billPriceSetting'=>1,
            'billPayorInfo'=>1,
            'billAmount'=>$report->fee_student * 100,
            'billReturnUrl'=> route('toyyibpay.paymentstatus', $report->id),
            'billCallbackUrl'=> route('toyyibpay.callback'),
            'billExternalReferenceNo' => 'bill-4324',
            'billTo'=>$report->registrar->name,
            'billEmail'=>'resityuranalqori@gmail.com',
            'billPhone'=>'0183879635',
            'billSplitPayment'=>0,
            'billSplitPaymentArgs'=>'',
            'billPaymentChannel'=>0,
            'billContentEmail'=>'Terima kasih kerana telah bayar yuran mengaji!:)',
            'billChargeToCustomer'=>1,





          );



          $url = 'https://toyyibpay.com/index.php/api/createBill';
          $response = Http::asForm()->post($url, $some_data);
          //dd($response);
          $billCode = $response[0]['BillCode'];

          session([
            'billAmount' => $report->fee_student,
            'billCode' => $billCode
        ]);

          return redirect('https://toyyibpay.com/'. $billCode);


    }



    public function paymentStatus(ReportClass $reportClass)
    {

        $response= request()->status_id;


        if($response == 1)
        {

            $reportClass->update(['status' => 1]);
          $billAmount = session('billAmount');
          $billCode = session('billCode');


      // dd($reportClass);

         return redirect()->route('filament.admin.pages.fee-student')->with('success', 'Pembayaran yuran anda telah berjaya!');
        }

      else
      {

          return redirect()->route('filament.admin.pages.fee-student')->with('fail', 'Pembayaran yuran telah dibatalkan!');;
      }
    }


    public function callback()
    {
        $response= request()->all(['refno','status','reason','billcode','order_id','amount']);
        Log::info($response);
    }

    public function billTransaction()
    {

    }
}
