<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    public function getStartDateAttribute($value) :string
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
     public function getEndDateAttribute($value): string
     {
            return Carbon::parse($value)->format('d/m/Y');
     }

    static public function search($date)
    {
       return self::select('id', 'title','price')
           ->whereRaw("'$date' BETWEEN start_date AND end_date")
           ->orderBy('ranking', 'desc')
           ->get();
    }

}
