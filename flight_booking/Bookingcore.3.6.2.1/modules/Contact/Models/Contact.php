<?php
namespace Modules\Contact\Models;

use App;
use App\BaseModel;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends BaseModel
{
    
    protected $table = 'bravo_contact';
    protected $fillable = [
        'name',
        'email',
        'message',
        'phone',
        'status'
    ];

//    protected $cleanFields = ['message'];
}
