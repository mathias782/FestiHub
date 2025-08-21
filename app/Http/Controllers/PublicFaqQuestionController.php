<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use App\Models\FaqItem;
use Illuminate\Http\Request;

class PublicFaqQuestionController extends Controller
{
    public function store(Request $request, FaqCategory $category)
    {
        $data = $request->validate([
            'question' => ['required','string','max:500'],
        ]);

        FaqItem::create([
            'faq_category_id' => $category->id,
            'question'        => trim($data['question']),
            'answer'          => '',
        ]);

        return back()->with('status', 'Thanks! Your question was submitted.');
    }
}
