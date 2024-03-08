<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Auth;

class ReportClass extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;
    //use \Znck\Eloquent\Traits\BelongsToThrough;

    public $table = 'report_classes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [

       'registrar_id',
        'class_names_id',
        'date',
        'total_hour',
        'class_names_id_2',
        'date_2',
        'total_hour_2',
        'month',
        'allowance',
        'record_student',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
        'fee_student',
        'status',
        'note',
        'receipt',
       'allowance_note',
    ];

    public function class_name()
   {

   return $this->belongsTo(ClassName::class, 'class_names_id');
    }

    public function class_name_2()
    {

    return $this->belongsTo(ClassName::class, 'class_names_id_2');
     }

   public function registrar()
    {

      return $this->belongsTo(User::class, 'registrar_id');
    }



    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    



    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }



}
