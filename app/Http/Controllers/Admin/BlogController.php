<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Http\Controllers\Repositories\BlogRepo;
use App\Http\Controllers\Repositories\ImageUploader;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class BlogController extends Controller
{

    protected $blogRepo;

    public function __construct(BlogRepo $blogRepo, ImageUploader $imageUploader)
    {
        $this->blogRepo = $blogRepo;
        $this->imageUplaoder = $imageUploader;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Blog::orderBy('created_at', 'asc')->with('categories')->get();
        return view('admin.blog.list')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $validator = Validator::make($data, [
                'title' => 'required|unique:blog_posts'
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $blogPost = Blog::create($data);
            $blogPost->save();

            return redirect('auth/blog/'. $blogPost->id .'/edit')
                ->with('successMessage', 'Blog Post has been created!');

        } catch(Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage())->withInput();
        }
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
        $blogPost = Blog::with('author', 'categories')->where('id', $id)->first();
        $categories = Category::all();
        $users = User::all();
        return view('admin.blog.edit')->with([
            'blogPost' => $blogPost,
            'users' => $users,
            'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required|unique:blog_posts,id,' . $id,
            'content' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['url_slug'] = $this->blogRepo->createSlug($data['title']);
        isset($data['published']) ? $data['published'] = 1 : $data['published'] = 0;
        if(!isset($data['published_date'])) {
          unset($data['published_date']);
        }

        # Image upload
        if(isset($data['image'])) {
            $data['image'] = $this->imageUplaoder->uploadImage($data['image'], 'blog');
        } else {
            unset($data['image']);
        }

        $blogPost = Blog::find($id);
        $blogPost->fill($data);

        $blogPost->categories()->sync($data['selectedCategories'] ?? []);

        if(isset($data['availableCategories'])) {
            foreach($data['availableCategories'] as $category) {
                $check = Category::where('name', $category)->first();
                if(empty($check)) {
                    $this->createCategory($category);
                }
            }
        }

        $blogPost->save();

        return redirect('auth/blog/'. $blogPost->id .'/edit')
            ->with('successMessage', 'Blog Post has been updated!');

    }

    public function createCategory($name) {
        $categorySlug = Str::slug($name, '-');
        $category = Category::create([
           'name' => $name,
           'slug' => $categorySlug
        ]);
        $category->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Blog::destroy($id);
            return redirect('/auth/blog');
        } catch(\Exception $ex) {

        }
    }
}
