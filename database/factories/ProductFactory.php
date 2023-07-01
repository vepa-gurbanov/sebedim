<?php

namespace Database\Factories;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use function Symfony\Component\String\Slugger\slug;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function configure()
    {
        return $this->afterMaking(function (Product $product) {
            //
        })->afterCreating(function (Product $product) {
            if ($product->category()->has('attributes')) {
                $name = [];
                $definition = [];
                $values = [];
                $attrs = Attribute::where('category_id', $product->category_id)->with('values')->take(rand(1, 2))->get();
                foreach ($attrs as $attr) {
                    $value = $attr->values->random();
                    $name[] = $value->name;
                    $definition[] = $attr->name . ': ' . $value->name;
                    $values[$value->id] = ['order_by' => $attr->order_by];
                }
                $fullName = $product->name . implode(', ', $name);
                $product->full_name = $fullName;
                $product->description = implode(', ', $definition);
                $product->upc_code =  strval(date_format($product->created_at, 'ymdhi') . $product->id);
                $product->slug = Str::slug($fullName, '_') . $product->id;
                $product->update();
                $product->attributeValues()->sync($values);
                $attrVal = $product->attributeValues()->with('attribute')->whereRelation('attribute', 'name', 'Color')->first();
                $barcode = 's' . $product->store_id
                    . '-' . 'b' . $product->brand_id
                    . '-' . 'c' . $product->category_id;
//                if (isset($attrVal)) {
//                    $barcode .= '-' . 'av' . $attrVal->attribute_id . '_' . $attrVal->id;
//                }
                $product->barcode = $barcode;
                $product->update();
                $product->locations()->sync([
                    'location_id' => $product->store->warehouse->location->parent_id,
                ]);
            }
        });
    }

    public function definition(): array
    {
        $store = Store::inRandomOrder()->first();
        $brand = Brand::inRandomOrder()->first();
        $category = Category::whereDoesntHave('child')->inRandomOrder()->first();
        $created = now()->subDays($rand = rand(0, 30));
        return [
            'store_id' => $store->id,
            'brand_id' => $brand->id,
            'category_id' => $category->id,
            'name' => $this->faker->name(),
//            'full_name' => $this->faker->name(),
//            'slug' => $this->faker->name() . strval(rand(1,100000000)),
            'barcode' => rand(100000,999999),
            'price' => rand(10,1000),
            'stock' => rand(0,200),
            'viewed' => rand(0,250),
            'sold' => rand(0,250),
            'favorites' => rand(0,100),
            'created_at' => $created,
            'updated_at' => $created,
        ];
    }
}
