<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DefaultUserAvatarsSeeder extends Seeder
{
    public function run(): void
    {
        Storage::disk('public')->makeDirectory('avatars');

        $sourceDir = resource_path('seed_avatars');
        $files = collect(glob($sourceDir.'/*.png'))
            ->merge(glob($sourceDir.'/*.jpg'))
            ->merge(glob($sourceDir.'/*.jpeg'));

        if ($files->isEmpty()) {
            $this->command?->warn('No seed avatars found in resources/seed_avatars (skipping).');
            return;
        }

        User::where('is_admin', false)
            ->where(function ($q) {
                $q->whereNull('avatar_path')->orWhere('avatar_path', '');
            })
            ->chunkById(100, function ($users) use ($files) {
                foreach ($users as $user) {
                    $src = $files->random();
                    $ext = pathinfo($src, PATHINFO_EXTENSION);

                    $path = 'avatars/'.Str::uuid().'.'.$ext;
                    
                    Storage::disk('public')->put($path, file_get_contents($src));

                    $user->avatar_path = $path;
                    $user->save();
                }
            });

        $this->command?->info('Default avatars assigned where missing.');
    }
}
