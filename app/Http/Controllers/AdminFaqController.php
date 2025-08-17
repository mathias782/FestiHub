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
        return view('admin.faq.index', compact('cats'));
    }

    public function storeCategory(Request $request)
    {
        $data = $request->validate(['name'=>'required|string|max:255','sort_order'=>'nullable|integer']);
        FaqCategory::create(['name'=>$data['name'],'sort_order'=>$data['sort_order'] ?? 0]);
        return back()->with('status','Categorie aangemaakt.');
    }

    public function storeItem(Request $request)
    {
        $data = $request->validate([
            'faq_category_id'=>'required|exists:faq_categories,id',
            'question'=>'required|string|max:255',
            'answer'=>'required|string',
        ]);
        FaqItem::create($data);
        return back()->with('status','Vraag toegevoegd.');
    }

    public function destroyCategory(FaqCategory $category)
    {
        $category->delete();
        return back()->with('status','Categorie verwijderd.');
    }

    public function destroyItem(FaqItem $item)
    {
        $item->delete();
        return back()->with('status','Vraag verwijderd.');
    }
}
