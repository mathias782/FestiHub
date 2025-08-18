<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $byEmail = fn($email) => User::where('email', $email)->first()?->id;

        $alice = $byEmail('alice@example.com');
        $bob   = $byEmail('bob@example.com');
        $chloe = $byEmail('chloe@example.com');
        $david = $byEmail('david@example.com');
        $admin = $byEmail('admin@ehb.be');

        $e1 = Event::updateOrCreate(
            ['title' => 'Indie Sunset Stage'],
            [
                'location' => 'Main Park',
                'description' => "A mellow indie set to close your day.\nBring your friends!",
                'starts_at' => Carbon::now()->addDays(5)->setTime(18, 30),
                'ends_at' => Carbon::now()->addDays(5)->setTime(20, 0),
                'capacity' => 150,
                'image_path' => null,
            ]
        );

        $e2 = Event::updateOrCreate(
            ['title' => 'Electro Night'],
            [
                'location' => 'Warehouse Hall',
                'description' => "Pulsating beats and live synths.\nLimited spots!",
                'starts_at' => Carbon::now()->addDays(10)->setTime(21, 0),
                'ends_at' => Carbon::now()->addDays(10)->setTime(23, 30),
                'capacity' => 200,
                'image_path' => null,
            ]
        );

        $e3 = Event::updateOrCreate(
            ['title' => 'Jazz Brunch'],
            [
                'location' => 'Riverside Stage',
                'description' => "Smooth jazz for your Sunday brunch.",
                'starts_at' => Carbon::now()->addDays(14)->setTime(11, 0),
                'ends_at' => Carbon::now()->addDays(14)->setTime(12, 30),
                'capacity' => 120,
                'image_path' => null,
            ]
        );

        $e1->performers()->sync(array_filter([$alice]));
        $e2->performers()->sync(array_filter([$bob]));
        $e3->performers()->sync(array_filter([$chloe, $david]));

        $e1->attendees()->syncWithoutDetaching(array_filter([$admin, $bob]));
        $e2->attendees()->syncWithoutDetaching(array_filter([$admin, $alice, $chloe]));
        $e3->attendees()->syncWithoutDetaching(array_filter([$admin]));
    }
}
