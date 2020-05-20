<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\News\NewsRepositoryInterface;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    protected $categoryRepo;
    protected $newsRepo;

    public function __construct(
        CategoryRepositoryInterface $categoryRepo,
        NewsRepositoryInterface $newsRepo
    ) {
        $this->middleware('admin');
        $this->categoryRepo = $categoryRepo;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        $data = [
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name) . $request->parent_id,
        ];

        $this->categoryRepo->create($data);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(CategoryRequest $request, $id)
    {
        $data = $request->only(['name']);
        $data['slug'] = Str::slug($request->name) . $request->parent_id;

        if ($request->parent_id != -1) {
            $data['parent_id'] = $request->parent_id;
        }

        $this->categoryRepo->update($id, $data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->newsRepo->deleteByAttributes(['category_id' => $id]);
        $this->categoryRepo->delete($id);

        return json_encode(['message' => trans('pages.deleted_category')]);
    }
}
