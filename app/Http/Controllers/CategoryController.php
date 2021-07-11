<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;
use Validator;
use File;
use DB;
use Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categories = Category::all();
        $categories = DB::table('categories')->paginate(10);
        $count = Category::count();
    return view('category.index')
             ->with('count', $count)
            ->with('categories', $categories);
    }

    public function detail()
    {
        $categories = Category::all();
    return view('category.detail')->with('categories', $categories);
    }

  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
                'name' => 'required|max:255',
                'image' => 'required|mimes:jpg,jpeg,png,gif',
            ]);

            if ($validator->fails()) {
                return redirect('category/create')
                    ->withInput()
                    ->withErrors($validator);
            }

            // Create The Category
            $image = $request->file('image');
            $upload = 'img/categorys/';
            $filename = time().$image->getClientOriginalName();    
            $path = move_uploaded_file($image->getPathName(), $upload. $filename);

            $category = new Category;
            $category->name = $request->name;
            $category->image = $filename;
            $category->save();

            Session::flash('category_create','New Category is Created');
            return redirect('category/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::find($id);
        return view('category.veiw')->with('categories', $categories);
    }

    public function delete($id)
    {
        $categories = Category::find($id);
        return view('category.delete')->with('categories', $categories);
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::find($id);
    return view('category.edit')->with('categories', $categories);
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
        $category = Category::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'image' => 'mimes:jpg,jpeg,png,gif',
        ]);

        if ($validator->fails()) {
            return redirect('category/'.$category->id.'/edit')
				->withInput()
				->withErrors($validator);
        }

        // Img
        if($request->file('image') != ""){
            $image = $request->file('image');
            $upload = 'img/categorys/';
            $filename = time().$image->getClientOriginalName();
            $path = move_uploaded_file($image->getPathName(), $upload. $filename);
            }

		// Create The Category

		
		$category->name = $request->Input('name');
        if(isset($filename)){
            $category->image = $filename;
            }
		$category->save();

		Session::flash('category_update','Category is Update');

		return redirect('category');          
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);


        try {
        Category::where('id',$id)->delete();

        $image_path = 'img/categorys/'.$category->image;
    	File::delete($image_path);
    	Session::flash('category_delete','Category is Delete');
    	return redirect('category');
        } catch(Exception $e) {
            Session::flash('category_delete', 'You can not delete, because this record has relationship to other recortd');
            return redirect('category/delete/'.$category->id);
        }
    }

    public function getByCategory($id) {
        $categories = Category::all();
        $posts = DB::table('posts')->where('category_id', $id)->paginate(10);
        // dd($post);
        return view('post.detail')
            ->with('posts', $posts)
            ->with('categories', $categories);
    }

    public function searchcategory(Request $request) {

        $keyword = $request->input('keyword');
        // $categories = Category::all();
        if( $keyword != ""){
            return view('category.detail')
                ->with('categories', Category::where('name', 'LIKE', '%'.$keyword.'%')->paginate(10))
                ->with('keyword', $keyword);
                // ->with('categories', $categories);
        } else {
            return redirect('/categorys/detail');
        } 

    }
}

