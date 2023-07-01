<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $objs = [
            [
                'parent' => 'Clothes',
                'attrs' => [
                    'Color' => ['Honey', 'Olive', 'Coral', 'Cream', 'Gold', 'Peacock blue', 'Oranges', 'Magenta','Red', 'Royal Blue', 'Bright Blue', 'Lavender', 'Rose', 'Gray', 'Emerald', 'Amethyst', 'Deep purple', 'Ruby', 'Bright rose', 'Jade', 'Peach', 'Dusty Pink', 'White'],
                    'Size' => ['3XS', 'XXS', 'XS','S', 'M', 'L', 'XL', 'XXL', '3XL', '4XL'],
                    'Sleeve' => ['set in', 'kimono', 'raglan'],
                    'Material' => ['Cotton', 'Leather', 'Linen', 'Polyester', 'Wool', 'Synthetic fiber', 'Denim', 'Velvet', 'Hemp', 'Nylon', 'Chiffon', 'Silk', 'Fleece', 'Lyocell', 'Rayon', 'Flannel', 'Spandex', 'Poplin', 'Muslin', 'Broadcloth', 'Modal', 'Fiber' ,'Organic cotton', 'Acrylic'],
                    'Collar' => ['flat', 'standing', 'rolled'],
                    'Pattern' => ['Single piece', 'Two piece', 'Gated', 'Multi piece', 'Match plate', 'Skeleton', 'Sweep', 'Lose piece'],
                    'Dress Type' => ['Little black dress', 'Cocktail dress', 'Gown', 'Evening gown', 'Slip', 'Shirtdress', 'Maxi dress', 'Ball gown', 'Casual', 'Fit and flare', 'Tunic', 'Wedding dress', 'Sweater dress', 'Sundress', 'Strapless dress'],
                ],
                'child' => [
                    'Jackets',
                    'Monts',
                    'Underwears',
                    'Socks',
                ],
            ],
            [
                'parent' => 'Shoes',
                'attrs' => [
                    'Color' => ['Honey', 'Olive', 'Coral', 'Cream', 'Gold', 'Peacock blue', 'Oranges', 'Magenta','Red', 'Royal Blue', 'Bright Blue', 'Lavender', 'Rose', 'Gray', 'Emerald', 'Amethyst', 'Deep purple', 'Ruby', 'Bright rose', 'Jade', 'Peach', 'Dusty Pink', 'White'],
                    'Size' => ['15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45'],
                    'Material' => ['Leather', 'Suede', 'Textile', 'Artificial leather'],
                ],
                'child' => [
                    'Sneakers',
                    'Boot',
                    'High Heels',
                    'Sandal',
                ],
            ],
            [
                'parent' => 'Consumer Electronics',
                'child' => [
                    'Computer Hardware & Software',
                    'Cables & Commonly Used Accessories',
                    'Projectors & Presentation Equipments',
                    'Chargers, Batteries & Power Supplies',
                    'Used Electronics',
                    'Other Consumer Electronics',
                ],
            ],
            [
                'parent' => 'Home & Garden',
                'child' => [
                    'Garden Supplies',
                    'Household Cleaning Tools & Accessories',
                    'Lighters & Smoking Accessories',
                    'Home Storage & Organization',
                    'Household Scales',
                    'Home Decor',
                ],
            ],
            [
                'parent' => 'Sports & Entertainment',
                'child' => [
                    'Field events',
                    'Scooters',
                    'Boats & Ships',
                    'Collectibles, Costumes & Toys',
                    'RVs & Campers',
                    'Souvenirs',
                ],
            ],
        ];

        foreach ($objs as $obj)
        {
            $parent = Category::create([
                'name' => $obj['parent'],
            ]);

            if (isset($obj['attrs'])) {
                foreach ($obj['attrs'] as $attr => $values)
                {
                    $attribute = Attribute::create([
                        'category_id' => $parent->id,
                        'name' => $attr,
                        'order_by' => 1,
                    ]);
                    foreach ($values as $n => $val) {
                        $value = AttributeValue::create([
                            'attribute_id' => $attribute->id,
                            'name' => $val,
                            'order_by' => $n + 1
                        ]);
                    }
                }
            }

            foreach ($obj['child'] as $c)
            {
                $child = Category::create([
                    'parent_id' => $parent->id,
                    'name' => $c,
                    'description' => rand(0,1) ? fake()->text(rand(300, 600)) : null,
                ]);
            }
        }
    }
}
