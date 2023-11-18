<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    public function week()
    {
        return $this->belongsTo(Week::class);
    }

    public function getRouteKeyName()
    {
        return 'uuid';
        
    }

    public function getTotalIncome()
    {
        return $this->where('payment_status', 'Paid')->sum('bill');
    }

    public function getBill()
    {
        return $this->where('is_paid', false)->where('payment_status', 'Waiting')->count();
    }

    public function getTransactionConfirm()
    {
        return $this->where('is_paid', true)->where('payment_status', 'Waiting')->count();
 
    }

    public function getTransactionPaid()
    {
        return $this->where('is_paid', true)->where('payment_status', 'Paid')->count();
    }

    public function getTransactionCancel()
    {
        return $this->where('is_cancel', true)->where('payment_status', 'Cancel')->count();

    }
}
