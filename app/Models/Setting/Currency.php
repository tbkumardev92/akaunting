<?php

namespace App\Models\Setting;

use App\Models\Model;

class Currency extends Model
{

    protected $table = 'currencies';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'name', 'code', 'rate', 'enabled'];

    /**
     * Sortable columns.
     *
     * @var array
     */
    public $sortable = ['name', 'code', 'rate', 'enabled'];

    public function accounts()
    {
        return $this->hasMany('App\Models\Banking\Account', 'currency_code', 'code');
    }

    public function customers()
    {
        return $this->hasMany('App\Models\Income\Customer', 'currency_code', 'code');
    }

    public function invoices()
    {
        return $this->hasMany('App\Models\Income\Invoice', 'currency_code', 'code');
    }

    public function revenues()
    {
        return $this->hasMany('App\Models\Income\Revenue', 'currency_code', 'code');
    }

    public function bills()
    {
        return $this->hasMany('App\Models\Expense\Bill', 'currency_code', 'code');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Expense\Payment', 'currency_code', 'code');
    }

    /**
     * Convert rate to float.
     *
     * @param  string  $value
     * @return void
     */
    public function setRateAttribute($value)
    {
        $this->attributes['rate'] = (float) $value;
    }
}
