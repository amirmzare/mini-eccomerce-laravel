<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * 
 * @property int $id
 * @property string $name
 * @property string $name_en
 * @property int $price
 * @property int $discount
 * @property int $qty
 * @property int $product_category_id
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $deleted_at
 * 
 * @property ProductCategory $productCategory
 * @property Collection|OrderItem[] $orderItems
 * @property Collection|ProductImage[] $productImages
 *
 * @package App\Models
 */
class Product extends Model
{
	use SoftDeletes;
	protected $table = 'products';
	public static $snakeAttributes = false;

	protected $casts = [
		'price' => 'int',
		'discount' => 'int',
		'qty' => 'int',
		'product_category_id' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'name',
		'name_en',
		'price',
		'discount',
		'qty',
		'product_category_id',
		'status'
	];

	public function productCategory()
	{
		return $this->belongsTo(ProductCategory::class);
	}

	public function orderItems()
	{
		return $this->hasMany(OrderItem::class);
	}

	public function productImages()
	{
		return $this->hasMany(ProductImage::class);
	}
}
