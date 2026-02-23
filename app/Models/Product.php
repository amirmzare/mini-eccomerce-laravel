<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Enums\ProductStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
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
 * @property string|null $description
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
        'status' => ProductStatus::class
    ];

    protected $fillable = [
        'name',
        'name_en',
        'price',
        'discount',
        'qty',
        'product_category_id',
        'status',
        'description'
    ];

    #[Scope]
    protected function applySort(Builder $query): void
    {
        $request = request();

//        if ($request->filled('sort')) {
            switch ($request->input('sort')) {

                case 'best_selling' :
                {
                    $query
                        ->withSum('orderItems', 'qty')
                        ->orderByDesc('order_items_sum_qty');
                    break;
                }
                case 'lowest' :
                {
                    $query->orderBy('price');
                    break;
                }
                case 'highest' :
                {
                    $query->orderByDesc('price');
                    break;
                }
                default:
                {
                    $query->orderByDesc('created_at');
                }
//            }
        }
    }

    #[Scope]
    protected function applyFilter(Builder $query): void
    {
        $request = request();

        if ($request->filled('exists')) {
            $query->where('qty', '>', 0);
        }

        if ($request->filled('category_id')) {
            $categoryIds = array_keys($request->input('category_id'));

            $query->whereIn('product_category_id', $categoryIds);
        }

    }

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
