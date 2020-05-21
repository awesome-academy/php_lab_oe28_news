<?php

namespace App\Http\Controllers;

use App\Enums\NewsStatus;
use App\Http\Requests\NewsRequest;
use App\Repositories\News\NewsRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    protected $newsRepo;

    public function __construct(NewsRepositoryInterface $newsRepo)
    {
        $this->middleware('admin')->except('show', 'status', 'store', 'update');
        $this->newsRepo = $newsRepo;
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

        $this->newsRepo->create([
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
            $data = [
                'slug' => $slug,
                'status' => NewsStatus::StatusPublished,
            ];

            $news = $this->newsRepo->findByAttributesGetOne($data);

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
            $news = $this->newsRepo->findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return redirect()->back();
        }

        $data = $request->only($news->getFillable());

        $data['hot'] = $request->hot ?? config('news.hot.no');
        $data['content'] = $request->news_content;

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
                $data['image'] = $name;
            } else {
                return redirect()->back()->withErrors(trans('pages.image_format'));
            }
        }

        $this->newsRepo->update($id, $data);

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
        $this->newsRepo->delete($id);

        return json_encode(['success' => trans('pages.news_delete_success')]);
    }

    public function status($id, $statusId)
    {
        if ($this->newsRepo->update($id, ['status' => $statusId])) {
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors(trans('pages.failed'));
        }
    }
}
