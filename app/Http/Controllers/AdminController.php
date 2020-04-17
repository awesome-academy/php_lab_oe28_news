<?php

namespace App\Http\Controllers;

use App\Http\Models\Category;
use App\Http\Models\News;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function indexNews()
    {
        $listNews = News::orderBy('created_at', 'desc')->paginate(config('news.paginate'));

        return view('admin.news', compact('listNews'));
    }

    public function showNews($id)
    {
        $news = News::with('category')->findOrFail($id);
        $categories = Category::all();

        return view('admin.newsdetail', compact('news', 'categories'));
    }
}
