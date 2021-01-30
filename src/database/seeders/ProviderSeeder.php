<?php

namespace Database\Seeders;

use App\Models\Provider;
use App\Models\UploadMediaRule;
use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UploadMediaRule::create(['provider_id' => '1','media'=>'image','media_type'=>'jpg','aspect_ratio'=>'4:3','max_media_size_mb'=>2]);
        UploadMediaRule::create(['provider_id' => '1','media'=>'video','media_type'=>'mp4','max_duration_seconds'=>60]);
        UploadMediaRule::create(['provider_id' => '1','media'=>'audio','media_type'=>'mp3','max_duration_seconds'=>30]);
        UploadMediaRule::create(['provider_id' => '2','media'=>'image','media_type'=>'jpg','aspect_ratio'=>'16:9','max_media_size_mb'=>5]);
        UploadMediaRule::create(['provider_id' => '2','media'=>'image','media_type'=>'gif','aspect_ratio'=>'16:9','max_media_size_mb'=>5]);
        UploadMediaRule::create(['provider_id' => '2','media'=>'video','media_type'=>'mp4','max_duration_seconds'=>300,'max_media_size_mb'=>50]);
        UploadMediaRule::create(['provider_id' => '2','media'=>'video','media_type'=>'mov','max_duration_seconds'=>300,'max_media_size_mb'=>50]);
    }
}
