<?php

namespace Database\Seeders;

use App\Models\FaqCategory;
use App\Models\FaqItem;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $tickets = FaqCategory::updateOrCreate(
            ['name' => 'Tickets'],
            ['sort_order' => 10]
        );
        $general = FaqCategory::updateOrCreate(
            ['name' => 'General'],
            ['sort_order' => 20]
        );

        $items = [
            [$tickets->id, 'How do I register for an event?', 'Open the event page and click “Register”. If the event is full, registration is disabled.'],
            [$tickets->id, 'Can I unregister?', 'Yes. Visit the event page and click “Unregister”.'],
            [$general->id, 'Where is the festival located?', 'Locations are listed per event; check the event details page.'],
            [$general->id, 'Do I need an account?', 'Yes, registration requires a free account.'],
        ];

        foreach ($items as [$catId, $q, $a]) {
            FaqItem::updateOrCreate(
                ['faq_category_id' => $catId, 'question' => $q],
                ['answer' => $a]
            );
        }
    }
}
