<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $objs = [
            'Ariston',
            'Alveus',
            'Amd',
            'AKSU',
            'Aryıldız',
            'ARİETE',
            'Automix',
            'Avessa',
            'Arko',
            'Adawall',
            'Artepera',
            'ARTLOOP',
            'ASENA DESİGN',
            'Guess',
            'Gucci',
            'Guerlain',
            'Givenchy',
            'Golden Rose',
            'Gabrini',
            'Günay Giyim',
            'Garnier',
            'Gizce',
            'Gillette',
            'Görsin Hamile',
            'GAP',
            'Gezer',
            'GoldMaster',
            'Grundig',
            'Gift Moda',
            'Newvit',
            'Nilera',
            'Nutraxin',
            'NapkinStore',
            'Newleaf',
            'Nasiol',
            'NoStik',
            'NETBOX',
            'Ninkasi',
            'Nautica Home',
            'Niloya',
            'Nutrigen',
            'Nimomed',
            'Nars',
            'NAGARAKU',
            'Twelve',
            'Tesbihane',
            'Tchibo',
            'Tereson',
            'Tefal',
            'Tommybaby',
            'Walker Tape',
            'Wayer',
            'Weimar',
            'Welder Moody Watch',
            'Wonder Kids',
            'Zigavus',
            'Ziaja',
            'Zenker',
            'Zero Shot',
            'Züber',
            'Zechka',
            'Zeplin Kitap',
            'Zore',
            'Zeyland',
            'ZUZU MADE',
            'Zeynbow',
            'ZENNESHOES',
            'ZARA',
        ];

        foreach ($objs as $obj) {
            $brand = new Brand();
            $brand->name = $obj;
            $brand->description = rand(0,1) ? fake()->text(rand(300, 600)) : null;
            $brand->save();
        }
    }
}
