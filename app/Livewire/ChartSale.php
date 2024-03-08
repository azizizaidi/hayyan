<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\ReportClass;
use Illuminate\Http\Request;
use App\Models\User;

class ChartSale extends Component
{
    public $name = 'Revenue by month with Livewire';

    public $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];

    public $dataPoint = [65, 59, 80, 81, 56, 55, 40];

    public function render()
    {
        //if(!auth()->user()->is_admin){
       //     abort(403);
      //  }else{
        return view('livewire.chart-sale')->with([
            'reportclasses' => ReportClass::get(),
        ]);
    }

 //   }
}
