<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use App\Models\FaqItem;
use Illuminate\Http\Request;

class AdminFaqController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function index()
    {
        $cats = FaqCategory::with('items')->orderBy('sort_order')->get();

        $allCats = FaqCategory::orderBy('name')->get(['id','name']);

        return view('admin.faq.index', compact('cats','allCats'));
    }

    public function storeCategory(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        FaqCategory::create([
            'name'       => $data['name'],
            'sort_order' => $data['sort_order'] ?? 0,
        ]);

        return back()->with('status','Category created.');
    }

    public function storeItem(Request $request)
    {
        $data = $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'question'        => 'required|string|max:255',
            'answer'          => 'required|string',
        ]);

        FaqItem::create($data);

        return back()->with('status','FAQ item created.');
    }

    public function updateCategory(Request $request, FaqCategory $category)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $category->update($data);

        return back()->with('status','Category updated.');
    }

    public function updateItem(Request $request, FaqItem $item)
    {
        $data = $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'question'        => 'required|string|max:255',
            'answer'          => 'nullable|string',
        ]);

        $item->update([
            'faq_category_id' => $data['faq_category_id'],
            'question'        => trim($data['question']),
            'answer'          => $data['answer'] ?? '',
        ]);

        return back()->with('status','FAQ item updated.');
    }

    public function destroyCategory(FaqCategory $category)
    {
        $category->delete();

        return back()->with('status','Category deleted.');
    }

    public function destroyItem(FaqItem $item)
    {
        $item->delete();

        return back()->with('status','FAQ item deleted.');
    }
}
