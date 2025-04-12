<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shops = [
            [
                'name' => '仙人',
                'area' => '東京都',
                'genre' => '寿司',
                'description' => '料理長厳選の食材から作る寿司を味わえます。食材、味、価格、お客様の満足度を徹底的に追及した寿司屋です。',
                'image' => 'sushi.jpg',
            ],
            [
                'name' => '牛助',
                'area' => '大阪府',
                'genre' => '焼肉',
                'description' => '焼肉業界で20年間経験を積み、肉を熟知したマスターによる実力派焼肉店。長年の実績とお付き合いをもとに、なかなか食べられない希少部位も仕入れております。',
                'image' => 'yakiniku.jpg',
            ],
            [
                'name' => '戦慄',
                'area' => '福岡県',
                'genre' => '居酒屋',
                'description' => '気軽に立ち寄れる昔懐かしの大衆居酒屋。キンキンに冷えたビールを、なんと199円で。鳥かわ煮込み串は販売総数100000本突破の名物料理です。',
                'image' => 'izakaya.jpg',
            ],
            [
                'name' => 'ルーク',
                'area' => '東京都',
                'genre' => 'イタリアン',
                'description' => '都心にひっそりとたたずむ、古民家を改築した落ち着きのある空間。イタリアで修業を重ねたシェフによるモダンなイタリア料理とソムリエセレクトによる厳選ワインとのペアリングが好評です。',
                'image' => 'italian.jpg',
            ],
            [
                'name' => '志摩屋',
                'area' => '福岡県',
                'genre' => 'ラーメン',
                'description' => 'ラーメン屋とは思えない店内にはカウンター席はもちろん、個室も用意してあります。ラーメンはこってり系・あっさり系ともに揃っています。その他豊富な一品料理やアルコールも用意しています。',
                'image' => 'ramen.jpg',
            ],
            [
                'name' => '香',
                'area' => '東京都',
                'genre' => '焼肉',
                'description' => '大小さまざまなお部屋をご用意してます。デートや接待、記念日や誕生日など特別な日にご利用ください。皆様のご来店をお待ちしております。',
                'image' => 'yakiniku.jpg',
            ],
            [
                'name' => 'JJ',
                'area' => '大阪府',
                'genre' => 'イタリアン',
                'description' => 'イタリア製ピザ窯芳ばしく焼き上げた極薄のミラノピッツァや厳選されたワインをお楽しみいただけます。女子会や男子会、記念日やお誕生日会にもオススメです。',
                'image' => 'italian.jpg',
            ],
            [
                'name' => 'らーめん極み',
                'area' => '東京都',
                'genre' => 'ラーメン',
                'description' => '一杯、一杯心を込めて職人が作っております。味付けは少し濃いめです。 食べやすく最後の一滴まで美味しく飲めると好評です。',
                'image' => 'ramen.jpg',
            ],
        ];

        foreach ($shops as $shop) {
            Shop::create($shop);
        }
    }
}
