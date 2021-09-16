<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\product;


class ProductsController extends Controller
{

    public function __construct() {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::all();
        // $products = Product::orderBy("created_at", "desc")->get();
        
        // To display Limited number of items in a page pagination can be used
        $products = Product::orderBy("created_at", "desc")->paginate(3);

        return view('welcome')->with("products", $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|max:10000|mimes:jpeg, jpg, png'
        ]);

        $image = $request->file('image');
        $fileName = time(). '.' .$image->getClientOriginalExtension();
        Storage::disk('public')->put($fileName, File::get($image));

        $product = new Product();
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->seller_id = Auth::user()->id;
        $product->image=$fileName;

        $product->save();

        return redirect("/details/".$product->id );




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('details')->with("product", $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('edit')->with("product", $product);    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'title' => 'max:255',
            'price' => 'numeric',
            'image' => 'max:10000|mimes:jpeg,jpg,png'
        ]);

        $product= Product::find($id);

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time(). '.' .$image->getClientOriginalExtension();
            Storage::disk('public')->put($fileName, File::get($image));
            $product->image = $fileName;
        }

        if(!empty($request->input('title'))) {
            $product->title = $request->input("title");
        }

        if(!empty($request->input('description'))) {
            $product->description = $request->input("description");
        }

        if(!empty($request->input('price'))) {
            $product->price = $request->input("price");
        }

        $product->save();

        // return redirect("/details/".$id);

        return redirect("/details/".$product->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
