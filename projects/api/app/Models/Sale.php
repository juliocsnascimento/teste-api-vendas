<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sale
 * 
 * @property int $id
 * @property int $seller
 * @property float $value
 * @property Carbon $date
 * 
 *
 * @package App\Models
 */
class Sale extends Model
{
	protected $table = 'sales';
	public $timestamps = false;

	protected $casts = [
		'seller' => 'int',
		'value' => 'float',
		'date' => 'datetime'
	];

	protected $fillable = [
		'seller',
		'value',
		'date'
	];

	/**
	 * The "booted" method of the model.
	 *
	 * @return void
	 */
	protected static function boot()
	{
		parent::boot();
		static::saving(function ($sale) {

			// Calcula a comissão antes de salvar o registro
			$commission_percent = $sale->seller()->first()->sales_commission;
			$commission_value = $sale->value - ($sale->value - (($sale->value / 100) * $commission_percent));

			$sale->commission_percent = $commission_percent;
			$sale->commission_value = $commission_value;
		});
	}

	public function seller()
	{
		return $this->belongsTo(Seller::class, 'seller');
	}

	public function calculate_commission()
	{
	}
}
