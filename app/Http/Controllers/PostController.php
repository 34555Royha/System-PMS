<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use Validator;
use Session;
use File;
use DB;
use Exception;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $categories = Category::all();
         $count = Post::count();
        $tqty = Post::sum('qty');
        $ttotal = Post::sum('price');
        $posts = Post::paginate(10);
    	return view('post.index')
    		->with('categories', $categories)
            ->with('tproduct', $count)
            ->with('tqty', $tqty)
            ->with('ttotal', $ttotal)
            ->with('posts', $posts);
            // dd($posts);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        $categories = Category::all();
    	return view('post.create')->with('categories', $categories);
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer',
            'name' => 'required|max:20|min:3',
            'qty' => 'required|max:20',
            'price' => 'required|max:20',
            'discounts' => 'required|max:20',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
            'short_desc' => 'required|max:1000|min:10',
            'description' => 'required|max:10000|min:10',
        ]);
        if ($validator->fails()) {
            return redirect('post/create')
                ->withInput()
                ->withErrors($validator);
        }
        // Create The Post
        $image = $request->file('image');
        $upload = 'img/posts/';
        $filename = time().$image->getClientOriginalName();
        $path = move_uploaded_file($image->getPathName(), $upload. $filename);
        $post = new Post;
        $post->category_id = $request->category_id;
        $post->name = $request->name;
        $post->qty = $request->qty;
        $post->price = $request->price;
        $post->discounts = $request->discounts;
        $post->image = $filename;
        $post->short_desc = $request->short_desc;
        $post->description = $request->description;
        $post->save();

        Session::flash('post_create','New Post is Created');
        return redirect('post/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::all();
        $posts = Post::findOrFail($id);

        
         return view('post.view')
        ->with('post', $posts)
        ->with('categories', $categories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $categories = array();

    	// foreach (Category::all() as $category) {
    	// 	$categories[$category->id] = $category->name;
    	// }
        $categories = Category::all();
        $posts = Post::findOrFail($id);

        
         return view('post.edit')
        ->with('post', $posts)
        ->with('categories', $categories);
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
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer',
            'name' => 'required|max:20|min:3',
            'qty' => 'required|max:20',
            'price' => 'required|max:20',
            'discounts' => 'required|max:20',
            'image' => 'mimes:jpg,jpeg,png,gif',
            'short_desc' => 'required|max:1000|min:10',
            'description' => 'required|max:10000|min:10',
		]);

		  $post = Post::find($id);

		 if ($validator->fails()) {
			return redirect('post/'.$post->id.'/edit')
				->withInput()
				->withErrors($validator);
		}

		// Create The Post
		if($request->file('image') != ""){
		$image = $request->file('image');
		$upload = 'img/posts/';
		$filename = time().$image->getClientOriginalName();
		$path = move_uploaded_file($image->getPathName(), $upload. $filename);
		}
		
		$post->category_id = $request->category_id;
		$post->name = $request->name;
        $post->discounts = $request->discounts;
        $post->qty = $request->qty;
        $post->price = $request->price;
		if(isset($filename)){
		$post->image = $filename;
		}
		$post->short_desc = $request->Input('short_desc');
		$post->description = $request->Input('description');
		$post->save();

		Session::flash('post_update','Post is Updated');

		return redirect('post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $categories = Category::all();
        $posts = Post::findOrFail($id);

        
         return view('post.delete')
        ->with('post', $posts)
        ->with('categories', $categories);
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        try {
            DB::table('posts')->where('id',$id)->delete();

            $image_path = 'img/posts/'.$post->image;
            File::delete($image_path);
            Session::flash('post_delete','Post is Delete');
        	return redirect('post');
        } catch(Exception $e) {
            Session::flash('product_delete', 'You can not delete, because this record has relationship to other recortd');
            return redirect('posts/delete/' .$post->id);
        }
    }

    public function detail()
    {
        $posts = Post::all();
    	return view('post.detail')
    		->with('posts', $posts);
    }

    public function search(Request $request) {

        $categories = Category::all();
        $category_id = $request->category_id;
        $name = $request->name;
        if( $name == "" && $category_id != ""){
           $posts =  Post::where('category_id',$category_id)->paginate(10);
           $count = Post::where('category_id',$category_id)->count();
            $tqty = Post::where('category_id',$category_id)->sum('qty');
            $ttotal = Post::where('category_id',$category_id)->sum('price');

            return view('post.index')
                ->with('tproduct', $count)
                ->with('tqty', $tqty)
                ->with('ttotal', $ttotal)
                 ->with('categories', $categories)
                ->with('posts', $posts);
        } else if( $category_id == "" && $name !=""){
            $posts =  Post::where('name', 'LIKE', '%'.$name.'%')->paginate(10);
            $count = Post::where('name', 'LIKE', '%'.$name.'%')->count();
            $tqty = Post::where('name', 'LIKE', '%'.$name.'%')->sum('qty');
            $ttotal = Post::where('name', 'LIKE', '%'.$name.'%')->sum('price');
            
             return view('post.index')
                    ->with('tproduct', $count)
                    ->with('tqty', $tqty)
                    ->with('ttotal', $ttotal)
                  ->with('categories', $categories)
                 ->with('posts', $posts);
         }else if( $category_id != "" && $name !=""){
            $posts =  Post::where('name', 'LIKE', '%'.$name.'%')
            -> where('category_id',$category_id)
            ->paginate(10);
            $count = Post::where('name', 'LIKE', '%'.$name.'%')
            -> where('category_id',$category_id)
            ->count();
            $tqty = Post::where('name', 'LIKE', '%'.$name.'%')
            -> where('category_id',$category_id)
            ->sum('qty');
            $ttotal = Post::where('name', 'LIKE', '%'.$name.'%')
            -> where('category_id',$category_id)
            ->sum('price');
             return view('post.index')
                    ->with('tproduct', $count)
                    ->with('tqty', $tqty)
                    ->with('ttotal', $ttotal)
                  ->with('categories', $categories)
                 ->with('posts', $posts);
         }else {
            return redirect('/post');
        } 

    }

    public function searchpostdetail(Request $request) {

        $keyword = $request->input('keyword');
        if( $keyword != ""){
            return view('post.detail')
                ->with('posts', Post::where('name', 'LIKE', '%'.$keyword.'%')->paginate(10))
                ->with('keyword', $keyword);
                // ->with('categories', $categories);
        } else {
            return redirect('/posts/detail');
        } 

    }
}
