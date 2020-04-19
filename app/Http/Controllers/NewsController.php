<?php

namespace App\Http\Controllers;

use App\Enums\NewsStatus;
use App\Http\Models\News;
use App\Http\Requests\NewsRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('show', 'status', 'store', 'update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsRequest $request)
    {
        $name = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileExtension = $file->getClientOriginalExtension();
            if ($fileExtension == 'jpg' || $fileExtension == 'jpeg' || $fileExtension == 'png') {
                $name = time() . '_' . rand(0, 9999999) . '.' . $fileExtension;
                while (file_exists('images/news/' . $name)) {
                    $name = time() . '_' . rand(0, 9999999) . '.' . $fileExtension;
                }

                $file->move('images/news', $name);
            } else {
                return redirect()->back()->withErrors(trans('pages.image_format'));
            }
        }

        News::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'content' => $request->news_content,
            'hot' => $request->hot ?? config('news.hot.no'),
            'image' => $name,
            'user_id' => Auth::user()->id,
            'status' => NewsStatus::StatusNew,
            'slug' => Str::slug($request->title),
        ]);

        return redirect()->back()->with('success', trans('pages.successful'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        try {
            $news = News::with('category')
                ->where('slug', $slug)
                ->where('status', NewsStatus::StatusPublished)
                ->firstOrFail();
            $category = $news->category;

            $uriCategory = [];

            while ($category->parent != null) {
                array_push($uriCategory, $category->parent);
                $category = $category->parent;
            }

            return view('newsdetail', compact('news', 'uriCategory'));
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NewsRequest $request, $id)
    {
        try {
            $news = News::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return redirect()->back();
        }

        if ($request->category_id != $news->category_id) $news->category_id = $request->category_id;
        if ($request->has('hot')) {
            $news->hot = $request->hot;
        } else {
            $news->hot = config('news.hot.no');
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileExtension = $file->getClientOriginalExtension();
            if ($fileExtension == 'jpg' || $fileExtension == 'jpeg' || $fileExtension == 'png') {
                $name = time() . '_' . rand(0, 9999999) . '.' . $fileExtension;
                while (file_exists('images/news/' . $name)) {
                    $name = time() . '_' . rand(0, 9999999) . '.' . $fileExtension;
                }

                $file->move('images/news', $name);
                if (file_exists('images/news/' . $news->image)) unlink('images/news/' . $news->image);
                $news->image = $name;
            } else {
                return redirect()->back()->withErrors(trans('pages.image_format'));
            }
        }

        if ($request->has('title')) $news->title = $request->title;
        if ($request->has('description')) $news->description = $request->description;
        if ($request->has('news_content')) $news->content = $request->news_content;

        $news->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        News::destroy($id);

        return json_encode(['success' => trans('pages.news_delete_success')]);
    }

    public function status($id, $statusId)
    {
        try {
            $news = News::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->withErrors(trans('pages.failed'));
        }

        $news->status = $statusId;
        $news->save();

        return redirect()->back();
    }
}
