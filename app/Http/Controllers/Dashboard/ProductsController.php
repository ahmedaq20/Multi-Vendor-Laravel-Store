<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tags;
use Facade\FlareClient\View;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate();
        $products = Product::with(['category','Store'])->paginate();
        return view('Dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         $product = Product::all();
        return view('dashboard.products.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($request->all());

        $request->merge(
            ['slug' => Str::slug($request->name)]
        );

        $date = $request->except('image');
        $data['image']= $this->upload_image($request);

        $products= Product::create($data);

        return redirect()->route('dashboard.Products.index')
        ->with('success', 'Products created successfully');

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

        $product = Product::findOrFail($id);

        $tags = implode(',', $product->tag()->pluck('name')->toArray());

        return view('dashboard.products.edit', compact('product', 'tags'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
            $product = Product::findOrFail($id);
            $product->update($request->except('tags'));
            // $tags =explode(',',$request->post('tags'));
            $tags =json_decode($request->post('tags'));

            $tag_ids = [];

            $saved_tags = Tags::all();



                    foreach ($tags as $item) {
                        $slug = Str::slug($item->value);
                        $tag = $saved_tags->where('slug', $slug)->first();
                        if (!$tag) {
                            $tag = Tags::create([
                                'name' => $item->value,
                                'slug' => $slug,
                            ]);
                        }
                        $tag_ids[] = $tag->id;
                    }


            $product->tag()->sync($tag_ids);

            return redirect()->route('dashboard.Products.index')
                ->with('success', 'Product updated');


    }


    // public function update(Request $request,$id)
    // {

    //     $product = Product::findOrFail($id);
    //     $product->update($request->except('tags'));
    //     // $product= new Product();
    //     // $product=$request->id;
    //     $tags =  explode(',' , $request->post('tags')); //turn string to array
    //     $tag_ids=[];
    //     foreach ($tags as $t_name){
    //         $slug = Str::slug($t_name);
    //       $tag =Tags::firstOrCreate([ 'slug' => $slug],['name' => $t_name ]); //search if there are model matching create new one with given parameters
    //         $tag_ids[] = $tag->id; //get ids of tags inserted
    //     }

    //     $product->tag()->sync($tag_ids); //sync searches if there are matches records if found dousnt delete the matched record if it has record not found in table will insertt it and if it doesnt have a record which exists in table delete it from table
    //     return redirect()->back()->with(['success' => 'Product updated']);
    // }


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

    protected function upload_image(Request $request)
    {


        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image'); //uploadfile object
        $path = $file->store('uplodeds', [
            'disk' => 'public'
        ]);
        return $path;
    }


}
