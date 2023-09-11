<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Seller
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property float $sales_commission
 * 
 * @property Collection|Sale[] $sales
 *
 * @package App\Models
 */
class Seller extends Model
{
	protected $table = 'seller';
	public $timestamps = false;

	protected $casts = [
		'sales_commission' => 'float'
	];

	protected $fillable = [
		'name',
		'email',
		'sales_commission'
	];

	public function sales()
	{
		return $this->hasMany(Sale::class, 'seller');
	}

	public static function salesDailyReport(): array
	{
		$sellers = Seller::all();
		$result = [];
		if ($sellers->count() > 0) {
			foreach ($sellers as $seller) {
				$sales = $seller->sales()->where('date', (new \DateTime())->format('Y-m-d'));

				$result[] = [
					'name' => $seller->name,
					'mail' => $seller->email,
					'commission_value' => $sales->sum('commission_value'),
					'value' => $sales->sum('value')
				];
			}
		}

		return $result;
	}
}
