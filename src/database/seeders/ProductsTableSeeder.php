<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'キウイ',
            'price' => '800',
            'image' => 'kiwi.png',
            'description' => 'キウイは甘味と酸味のバランスが絶妙なフルツーです。ビタミンCなどの栄養素も豊富のため、美肌効果や疲労回復効果もできます。もぎたてフルーツのスムージーをお召し上がりください！'
        ];
        DB::table('products')->insert($param);
        
        $param = [
            'name' => 'ストロベリー',
            'price' => '1200',
            'image' => 'strawberry.png',
            'description' => '大人から子供まで大人気のストロベリー、当店では鮮度抜群の完熟いちごを使用しています。ビタミンCはもちろん食物繊維も豊富なため、腸内環境の改善も期待できます。もぎたてフルーツのスムージーをお召し上がりください！'
        ];
        DB::table('products')->insert($param);

        $param = [
            'name' => 'オレンジ',
            'price' => '850',
            'image' => 'orange.png',
            'description' => '当店では酸味と甘味のバランスが抜群のネーブルオレンジを使用しています。酸味は控えめで、甘さと濃厚な果汁が魅力の商品です。もぎたてフルーツのスムージーをお召し上がりください！'
        ];
        DB::table('products')->insert($param);

        $param = [
            'name' => 'スイカ',
            'price' => '700',
            'image' => 'watermelon.png',
            'description' => '甘くてシャリシャリ食感が魅力のスイカ。全体の９０％が水分のため、暑い日の水分補給や熱中症予防、カロリーが気になる方にもおすすめの商品です。もぎたてフルーツのスムージーをお召し上がりください！'
        ];
        DB::table('products')->insert($param);

        $param = [
            'name' => 'ピーチ',
            'price' => '1000',
            'image' => 'peach.png',
            'description' => '豊潤な香りととろけるような甘さが魅力のピーチ。美味しさはもちろん見た目の可愛さも抜群の商品です。ビタミンEが豊富なため、生活習慣病の予防にもおすすめです。もぎたてフルーツのスムージーをお召し上がりください！'
        ];
        DB::table('products')->insert($param);

        $param = [
            'name' => 'シャインマスカット',
            'price' => '1400',
            'image' => 'muscat.png',
            'description' => '鮮やかな香りと上品な甘みが特徴的なシャインマスカットは大人から子どもまで大人気のフルーツです。疲れた脳や体のエネルギー補給にも最適の商品です。もぎたてフルーツのスムージーをお召し上がりください！'
        ];
        DB::table('products')->insert($param);

        $param = [
            'name' => 'パイナップル',
            'price' => '800',
            'image' => 'pineapple.png',
            'description' => '甘酸っぱさとトロピカルな香りが特徴のパイナップル。当店では甘さと酸味のバランスが絶妙な国産のパイナップルを使用しています。もぎたてフルーツのスムージーをお召し上がりください！'
        ];
        DB::table('products')->insert($param);

        $param = [
            'name' => 'ブドウ',
            'price' => '1100',
            'image' => 'grapes.png',
            'description' => '葡萄の中でも人気の高い『巨峰』を使用しています。高い糖度と適度な酸味が魅力で、鮮やかなパープルで見た目も可愛い商品です。もぎたてフルーツのスムージーをお召し上がりください！'
        ];
        DB::table('products')->insert($param);

        $param = [
            'name' => 'バナナ',
            'price' => '600',
            'image' => 'banana.png',
            'description' => '低カロリーでありながら栄養満点のため、ダイエット中の方にもおすすめの商品です。１杯でバナナの濃厚な甘みを存分に堪能できます。もぎたてフルーツのスムージーをお召し上がりください！'
        ];
        DB::table('products')->insert($param);

        $param = [
            'name' => 'メロン',
            'price' => '900',
            'image' => 'melon.png',
            'description' => '香りがよくジューシーで品のある甘さが人気のメロンスムージー。カリウムが多く含まれているためむくみ解消効果も抜群です。もぎたてフルーツのスムージーをお召し上がりください！'
        ];
        DB::table('products')->insert($param);
    }

}
