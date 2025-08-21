<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DefaultEventImagesSeeder extends Seeder
{
    public function run(): void
    {
        Storage::disk('public')->makeDirectory('event_images');

        $sourceDir = resource_path('seed_event_images');
        $files = collect(glob($sourceDir.'/*.png'))
            ->merge(glob($sourceDir.'/*.jpg'))
            ->merge(glob($sourceDir.'/*.jpeg'));

        if ($files->isEmpty()) {
            $this->command?->warn('No seed event images found in resources/seed_event_images (skipping).');
            return;
        }

        Event::whereNull('image_path')
            ->orWhere('image_path', '')
            ->chunkById(100, function ($events) use ($files) {
                foreach ($events as $event) {
                    $src = $files->random();
                    $ext = pathinfo($src, PATHINFO_EXTENSION);
                    $path = 'event_images/'.Str::uuid().'.'.$ext;

                    Storage::disk('public')->put($path, file_get_contents($src));

                    $event->image_path = $path;
                    $event->save();
                }
            });

        $this->command?->info('Default event images assigned where missing.');
    }
}
