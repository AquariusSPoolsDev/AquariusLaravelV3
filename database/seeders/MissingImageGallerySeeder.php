<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MissingImageGallerySeeder extends Seeder
{
    private function convertTags(string $tags): array
    {
        $map = [
            'concrete' => 'Concrete',
            'vinyl' => 'Vinyl',
            'fibreglass' => 'Fibreglass',
            'skimmer' => 'Skimmer',
            'overflow' => 'Overflow',
            'infinity' => 'Infinity',
            'residential' => 'Residential Pool',
            'commercial' => 'Commercial Pool',
            'balinese' => 'Balinese',
            'lampang' => 'Lampang',
            'customised tiling' => 'Customised Tiling',
            'jacuzzi' => 'Jacuzzi',
            'heated pool' => 'Heated Pool',
            'kids pool' => 'Kids Pool',
            'lightweight panel pool' => 'Lightweight Panel Pool',
            'timber deck' => 'Timber Deck',
            'concrete deck' => 'Concrete Deck',
            'water features' => 'Water Features',
            'waterfall' => 'Waterfall',
            'nature' => 'Nature',
            'water-fountain' => 'Water Fountain',
            'water fountain' => 'Water Fountain',
            'oasis' => 'Oasis',
            'luxurious' => 'Luxurious',
            'landscape-design' => 'Landscape Design',
            'landscape design' => 'Landscape Design',
            'wading-pool' => 'Wading Pool',
            'wading pool' => 'Wading Pool',
            'private-pool' => 'Private Pool',
            'private pool' => 'Private Pool',
            'contemporary' => 'Contemporary',
            'swimming-pool' => 'Swimming Pool',
            'swimming pool' => 'Swimming Pool',
            'gazebos' => 'Gazebos',
            'minimalism' => 'Minimalism',
            'led-lights' => 'LED Lights',
            'led lights' => 'LED Lights',
            'fitness' => 'Fitness',
            'backyard' => 'Backyard',
            'mosaic-tiles' => 'Mosaic Tiles',
            'mosaic tiles' => 'Mosaic Tiles',
            'safety-fence' => 'Safety Fence',
            'safety fence' => 'Safety Fence',
        ];

        return array_values(array_filter(array_map(
            fn ($t) => $map[trim($t)] ?? null,
            explode(',', $tags)
        )));
    }

    private function row(string $fileImg, string $nameImg, string $descImg, string $tags, string $published, string $imageDate): array
    {
        return [
            'image_path' => 'image_gallery/' . $fileImg,
            'image_name' => trim($nameImg),
            'image_description' => ($descImg === '-' || $descImg === '') ? null : trim($descImg),
            'image_tags' => json_encode($this->convertTags($tags)),
            'is_published' => $published === 'yes' ? 1 : 0,
            'uploader_id' => 1,
            'created_at' => $imageDate,
            'updated_at' => $imageDate,
        ];
    }

    public function run(): void
    {
        $records = [
            $this->row('IMG-65a6ea2c1d9c8bb8a290a9dbd4475cf1-20230608.jpg', 'Residential Concrete Pool with Water Feature', 'A Residential Concrete Pool with Water Feature', 'concrete,skimmer,residential,concrete deck,water features', 'yes', '2023-06-08 07:15:09'),
            $this->row('IMG-6734626a2f2023.67416629-20241113.jpg', 'Aquarius Swimming Pools Sdn Bhd cave design swimming pool concept', 'The inside look of a cave design swimming pool concept built by Aquarius Swimming Pools Sdn Bhd, water features, cave design', 'commercial,water features,waterfall,nature,luxurious', '', '2024-11-13 08:25:14'),
            $this->row('IMG-6735a0b80a26a6.66861248-20241114.jpg', 'Water feature at the end of a concrete swimming pool', 'A closer look at the waterfall of a concrete swimming pool built by Aquarius Swimming Pools Sdn Bhd, water features, jacuzzi, waterfall', 'concrete,residential,jacuzzi,concrete deck,water features,waterfall,nature,landscape-design,private-pool,swimming-pool', '', '2024-11-14 07:03:20'),
            $this->row('IMG-6735a17cbab8a5.98233967-20241114.jpg', 'Aquarius Swimming Pools Sdn Bhd concrete swimming pool with water features', 'Concrete swimming pool with water features built by Aquarius Swimming Pools Sdn Bhd, customised design, water features, jacuzzi', 'concrete,residential,jacuzzi,concrete deck,water features,waterfall,nature,landscape-design,private-pool,contemporary,swimming-pool', '', '2024-11-14 07:06:36'),
            $this->row('IMG-6735af7b03d439.48556915-20241114.jpg', 'Aquarius Swimming Pools Sdn Bhd concrete swimming pool', 'Concrete swimming pool built by Aquarius Swimming Pools Sdn Bhd, water features, lap pool, jacuzzi', 'concrete,residential,jacuzzi,concrete deck,water features,nature,landscape-design,private-pool,swimming-pool', '', '2024-11-14 08:06:19'),
            $this->row('IMG-6735b67798bde1.55156130-20241114.jpg', 'Aquarius Swimming Pools Sdn Bhd concrete swimming pool with pool jets and water feature', 'Close-up shot of the water features in a pool built by Aquarius Swimming Pools Sdn Bhd, pool jets, water features, jacuzzi, timber deck', 'concrete,residential,jacuzzi,timber deck,water features,oasis,private-pool,swimming-pool', '', '2024-11-14 08:36:07'),
            $this->row('IMG-6735b70d52e601.04232577-20241114.jpg', 'Aquarius Swimming Pools Sdn Bhd concrete swimming pool with water features', 'A closer look at the water features for a pool built by Aquarius Swimming Pools Sdn Bhd, water features, jacuzzi, custom-designed', 'concrete,residential,jacuzzi,water features,waterfall,private-pool,swimming-pool', '', '2024-11-14 08:38:37'),
            $this->row('IMG-6735b78c7f7712.55227389-20241114.jpg', 'Aquarius Swimming Pools Sdn Bhd concrete swimming pool + water features + pool jets', 'A customised concrete swimming pool built by Aquarius Swimming Pools Sdn Bhd, water features, pool jets, waterfall, jacuzzi', 'concrete,residential,jacuzzi,water features,waterfall,oasis,private-pool,swimming-pool', '', '2024-11-14 08:40:44'),
            $this->row('IMG-6735b82b333642.95565486-20241114.jpg', 'Pulai View concrete pool with beautiful landscape design', 'Overall view of Pulai View\'s concrete swimming pool built by Aquarius Swimming Pools Sdn Bhd, wading pool, water features, greeneries, jacuzzi', 'concrete,jacuzzi,heated pool,kids pool,concrete deck,water features,waterfall,oasis,luxurious,landscape-design,wading-pool,swimming-pool,fitness', '', '2024-11-14 08:43:23'),
            $this->row('IMG-6735b8cd1537a2.17480195-20241114.jpg', 'Aquarius Swimming Pools Sdn Bhd concrete swimming pool at Pulai View', 'Concrete swimming pool built by Aquarius Swimming Pools Sdn Bhd, water features, greeneries, jacuzzi', 'concrete,jacuzzi,heated pool,kids pool,concrete deck,water features,nature,oasis,landscape-design,wading-pool,swimming-pool', '', '2024-11-14 08:46:05'),
            $this->row('IMG-6735ba18d362c6.23605072-20241114.jpg', 'Aquarius Swimming Pools Sdn Bhd concrete swimming pool with a bridge at Pulai View', 'Close-up shot of the concrete swimming pool built by Aquarius Swimming Pools Sdn Bhd, water features, bridge, jacuzzi', 'concrete,jacuzzi,kids pool,concrete deck,water features,nature,oasis,landscape-design,swimming-pool,gazebos', '', '2024-11-14 08:51:36'),
            $this->row('IMG-6735c04437ff60.90897590-20241114.jpg', 'Aquarius Swimming Pools Sdn Bhd concrete commercial swimming pool with water features', 'Concrete commercial swimming pool built by Aquarius Swimming Pools Sdn Bhd, water features, jacuzzi, commercial pool', 'concrete,commercial,jacuzzi,concrete deck,water features,oasis,landscape-design,wading-pool,swimming-pool', '', '2024-11-14 09:17:56'),
            $this->row('IMG-67369c60f0f2d6.03410204-20241115.jpg', 'Resort pool with water features', 'Concrete swimming pool of a resort built by Aquarius Swimming Pools Sdn Bhd, lounge chairs, jacuzzi, water features', 'concrete,commercial,jacuzzi,water features,nature,oasis,landscape-design,wading-pool', '', '2024-11-15 00:57:04'),
            $this->row('IMG-67369d11d9b825.40854285-20241115.jpg', 'Aquarius Swimming Pools Sdn Bhd resort concrete pool with in-water lounge chairs', 'Concrete swimming pool of a resort built by Aquarius Swimming Pools Sdn Bhd, in-water lounge chairs, water features, jacuzzi, greeneries', 'concrete,commercial,jacuzzi,heated pool,water features,nature,oasis,landscape-design,wading-pool,swimming-pool', '', '2024-11-15 01:00:01'),
            $this->row('IMG-67369e1650d4a2.93743340-20241115.jpg', 'Concrete pool steps + poolside lounge chairs', 'Close-up shot of concrete pool steps in a resort pool built by Aquarius Swimming Pools Sdn Bhd, lounge chairs, jacuzzi, water features', 'concrete,commercial,jacuzzi,kids pool,water features,oasis,landscape-design,wading-pool,swimming-pool', '', '2024-11-15 01:04:22'),
            $this->row('IMG-6736a711c0b9c0.46584824-20241115.jpg', 'Aquarius Swimming Pools Sdn Bhd water features', 'Water features built by Aquarius Swimming Pools Sdn Bhd, water fountain, greeneries, customised design', 'concrete,commercial,concrete deck,water features,waterfall,water-fountain,landscape-design', '', '2024-11-15 01:42:41'),
            $this->row('IMG-6736a7e62fa594.14142123-20241115.jpg', 'Cascading Steps Water Feature', 'Close-up shot of outdoor water feature with cascading steps built by Aquarius Swimming Pools Sdn Bhd, water features, waterfall, concrete', 'concrete,commercial,customised tiling,concrete deck,water features,waterfall,nature,water-fountain,landscape-design', '', '2024-11-15 01:46:14'),
            $this->row('IMG-6736a8ca0f0566.84759237-20241115.jpg', 'Concrete Swimming Pool Waterfall Feature', 'Close-up shot of the waterfall feature built by Aquarius Swimming Pools Sdn Bhd, water features, waterfall, jacuzzi', 'concrete,residential,jacuzzi,concrete deck,water features,waterfall,oasis,landscape-design,private-pool,swimming-pool', '', '2024-11-15 01:50:02'),
            $this->row('IMG-6736a9c06eff21.53940468-20241115.jpg', 'Aquarius Swimming Pools Sdn Bhd concrete wading pool with water features', 'Concrete wading pool with waterfall feature built by Aquarius Swimming Pools Sdn Bhd, water features, wading pool, waterfall', 'concrete,commercial,kids pool,concrete deck,water features,waterfall,landscape-design,wading-pool,swimming-pool,minimalism', '', '2024-11-15 01:54:08'),
            $this->row('IMG-6736aa6f32ffd8.48391673-20241115.jpg', 'Aquarius Swimming Pools Sdn Bhd concrete swimming pool with poolside lounge chairs and gazebo', 'An overall view of the concrete swimming pool built by Aquarius Swimming Pools Sdn Bhd, lounge chairs, gazebo, jacuzzi, water features', 'concrete,commercial,jacuzzi,concrete deck,water features,nature,oasis,landscape-design,swimming-pool,gazebos,fitness', 'no', '2024-11-15 02:03:40'),
            $this->row('IMG-6736ab4bb51527.56245917-20241115.jpg', 'Beautiful Water Features', 'Close-up shot of the water features in a pool built by Aquarius Swimming Pools Sdn Bhd, water features, jacuzzi', 'concrete,jacuzzi,concrete deck,water features,waterfall,water-fountain,oasis,swimming-pool,mosaic-tiles', '', '2024-11-15 02:00:43'),
            $this->row('IMG-6736abecaa63f6.60001103-20241115.jpg', 'Aquarius Swimming Pools Sdn Bhd jacuzzi with water features', 'An overall view of the concrete jacuzzi built by Aquarius Swimming Pools Sdn Bhd, jacuzzi, water features, pool jets', 'concrete,commercial,jacuzzi,heated pool,concrete deck,water features,oasis,luxurious,swimming-pool,led-lights', '', '2024-11-15 02:03:24'),
            $this->row('IMG-6736b560f24724.76230788-20241115.jpg', 'Aquarius Swimming Pools Sdn Bhd concrete swimming pool with water features', 'Pool steps and water feature of a swimming pool built by Aquarius Swimming Pools Sdn Bhd, jacuzzi, water features', 'concrete,commercial,jacuzzi,kids pool,concrete deck,water features,water-fountain,oasis,landscape-design,wading-pool,swimming-pool', '', '2024-11-15 02:43:44'),
            $this->row('IMG-6736b6fb521c02.81167306-20241115.jpg', 'Aquarius Swimming Pools Sdn Bhd Concrete commercial swimming pool with beautiful water features', 'An overall look at the concrete commercial swimming pool built by Aquarius Swimming Pools Sdn Bhd, jacuzzi, water features, waterfall', 'concrete,commercial,jacuzzi,kids pool,concrete deck,water features,nature,oasis,landscape-design,wading-pool,swimming-pool', '', '2024-11-15 02:50:35'),
            $this->row('IMG-6736b801052144.00509022-20241115.jpg', 'Aquarius Swimming Pools Sdn Bhd water features', 'Outdoor water feature with cascading steps built by Aquarius Swimming Pools Sdn Bhd, water features, pool steps', 'concrete,commercial,water features,waterfall,nature,water-fountain,landscape-design', '', '2024-11-15 02:54:57'),
            $this->row('IMG-6736b9652c8953.97536513-20241115.jpg', 'Aquarius Swimming Pools Sdn Bhd Illuminated Water Curtain', 'An overall view of captivating water feature with a curtain of falling water built by Aquarius Swimming Pools Sdn Bhd, water features, waterfall', 'concrete,commercial,customised tiling,water features,waterfall,water-fountain,landscape-design,led-lights', '', '2024-11-15 03:00:53'),
            $this->row('IMG-6736ba3dc2e379.05479808-20241115.jpg', 'Aquarius Swimming Pools Sdn Bhd Water Fountain', 'Captivating water fountain illuminated at night built by Aquarius Swimming Pools Sdn Bhd, water features, water fountain', 'concrete,commercial,customised tiling,water features,waterfall,water-fountain,landscape-design,led-lights', '', '2024-11-15 03:04:29'),
            $this->row('IMG-6736bba5410da7.56979581-20241115.jpg', 'Aquarius Swimming Pools Sdn Bhd Water Feature', 'Close-up shot of the water feature surrounded with smooth stones built by Aquarius Swimming Pools Sdn Bhd, water features, stones, greeneries', 'concrete,commercial,water features,water-fountain,landscape-design,minimalism,led-lights', '', '2024-11-15 03:10:29'),
            $this->row('IMG-6736bc6a369977.25728268-20241115.jpg', 'Aquarius Swimming Pools Sdn Bhd Tanjung Leman concrete swimming pool', 'Concrete swimming pool for a resort built by Aquarius Swimming Pools Sdn Bhd, jacuzzi, water features, commercial pool', 'concrete,commercial,jacuzzi,kids pool,concrete deck,water features,nature,oasis,luxurious,landscape-design,wading-pool,swimming-pool', '', '2024-11-15 03:13:46'),
            $this->row('IMG-6736bce75a5ca2.95534724-20241115.jpg', 'Aquarius Swimming Pools Sdn Bhd concrete commercial swimming pool with steel railings', 'Concrete swimming pool built by Aquarius Swimming Pools Sdn Bhd, jacuzzi, steel railings, water features', 'concrete,commercial,jacuzzi,kids pool,concrete deck,water features,oasis,luxurious,landscape-design,wading-pool,swimming-pool', '', '2024-11-15 03:15:51'),
            $this->row('IMG-6736c02a04b9c0.16994955-20241115.jpg', 'Aquarius Swimming Pools Sdn Bhd concrete commercial swimming pool', 'An overall view of the concrete commercial swimming pool built by Aquarius Swimming Pools Sdn Bhd, jacuzzi, water features', 'concrete,commercial,jacuzzi,kids pool,concrete deck,water features,oasis,luxurious,landscape-design,wading-pool,swimming-pool', '', '2024-11-15 03:29:46'),
            $this->row('IMG-6736c12856eb29.69738835-20241115.jpg', 'Aquarius Swimming Pools Sdn Bhd concrete swimming pool with tub and steel railings', 'Close-up shot of a concrete tub with bubbling water and colorful LED lighting built by Aquarius Swimming Pools Sdn Bhd, water features, steel railings remote controlled jacuzzi', 'concrete,residential,jacuzzi,heated pool,concrete deck,water features,oasis,luxurious,private-pool,swimming-pool,led-lights', '', '2024-11-15 03:34:00'),
            $this->row('IMG-6736ec38629420.51748461-20241115.jpg', 'Aquarius Swimming Pools Sdn Bhd concrete swimming pool with water features', 'Concrete swimming pool built by Aquarius Swimming Pools Sdn Bhd, water features, remote-controlled jacuzzi, concrete pool', 'concrete,residential,jacuzzi,concrete deck,water features,nature,oasis,private-pool,swimming-pool', '', '2024-11-15 06:37:44'),
            $this->row('IMG-6736ed2de3dde7.81031005-20241115.jpg', 'Aquarius Swimming Pools Sdn Bhd Unique Water Feature', 'A stone wall water feature with a central fountain built by Aquarius Swimming Pools Sdn Bhd, water features, waterfall, water fountain', 'concrete,residential,water features,waterfall,nature,water-fountain,landscape-design,private-pool', '', '2024-11-15 06:41:49'),
            $this->row('IMG-6736edf529bf06.40062750-20241115.jpg', 'Aquarius Swimming Pools Sdn Bhd Curved Concrete Pool with Water Features', 'Concrete swimming pool with a curved design, featuring a built-in spa built by Aquarius Swimming Pools Sdn Bhd, water features, pool jets, jacuzzi', 'concrete,residential,jacuzzi,concrete deck,water features,oasis,private-pool,swimming-pool,mosaic-tiles', '', '2024-11-15 06:45:09'),
            $this->row('IMG-673c00b85b4d47.58095031-20241119.jpg', 'Aquarius Swimming Pools Sdn Bhd concrete swimming pool with water features', 'Concrete swimming pool built by Aquarius Swimming Pools Sdn Bhd in 2019, water features, greeneries, remote-controlled jacuzzi', 'concrete,overflow,residential,jacuzzi,concrete deck,water features,nature,oasis,luxurious,landscape-design,private-pool,swimming-pool,led-lights', '', '2024-11-19 03:06:32'),
            $this->row('IMG-673c0130bf52a2.00603563-20241119.jpg', 'Aquarius Swimming Pools Sdn Bhd concrete swimming pool with cave-like design water feature', 'Night view of a concrete pool built by Aquarius Swimming Pools Sdn Bhd in 2019, water features, jacuzzi', 'concrete,residential,jacuzzi,concrete deck,water features,waterfall,oasis,luxurious,private-pool,swimming-pool', '', '2024-11-19 03:08:32'),
            $this->row('IMG-673c0209ef9d03.37097068-20241119.jpg', 'Aquarius Swimming Pools Sdn Bhd concrete swimming pool with water features', 'Concrete swimming pool surrounded by decorative plants built by Aquarius Swimming Pools Sdn Bhd in 2019, water features, greeneries', 'concrete,commercial,concrete deck,water features,nature,oasis,landscape-design,led-lights', '', '2024-11-19 03:12:09'),
            $this->row('IMG-673c029fc1faf7.36381743-20241119.jpg', 'Aquarius Swimming Pools Sdn Bhd concrete swimming pool with unique water features', 'A customised concrete swimming pool with unique water features built by Aquarius Swimming Pools Sdn Bhd in 2019, water features, customised design', 'concrete,residential,jacuzzi,concrete deck,water features,nature,oasis,luxurious,landscape-design,private-pool,swimming-pool', '', '2024-11-19 03:14:39'),
        ];

        DB::table('image_galleries')->insert($records);
    }
}
