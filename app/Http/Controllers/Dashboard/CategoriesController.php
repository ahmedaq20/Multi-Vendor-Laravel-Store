<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Store;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categories = Category::all();
        $request = request();
       $query = Category::query();
          //  local scope خليناها في
        // if ($name = $request->query('name')) {
        //     $query->where('name', 'LIKE', "%{$name}%");
        // }
        // if ($status = $request->query('status')) {
        //     $query->where('status', $status);
        // }


        // using local scopes
        // $categories =  category::active()->paginate();
        // $categories =  category::status('active')->paginate();
        // $categories =  $query->paginate(1);
       // $categories = category::filter($request->query())->paginate(1);
        $categories = category::with('parent')
        /*leftJoin('categories as parents' ,'parents.id' ,'=','categories.parent_id')
        ->select([
            'categories.*',
            'parents.name as parent_name',
        ])*/
        ->withCount('products')
        ->filter($request->query())->paginate(10);
        return view('dashboard.Categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $category = Category::all();
        $Categories = new Category();
        $parents = Category::all();
        return view('dashboard.Categories.create', compact('Categories', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(Category::rules(), [

            'required' => 'The field :attribute is required',
            'unique' => 'The :attribute is already  exists!'

        ]);


        $request->merge([
            'slug' => Str::slug($request->name),
        ]);
        $data = $request->except('image');
        $data['image'] = $this->upload_image($request);


        $category = Category::create($data);
        return redirect()->route('dashboard.Categories.index')
            ->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $Category)
    {
        return view('dashboard.Categories.show',compact('Category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        //         $Categories=Category::find($id);
        // if(!$Categories){
        //     abort(404);
        // } بحوله لصفحة 404IPسيناريو لو ما لقا ال


        // طريقة 2
        //         try {
        //         $Categories=Category::find($id);
        //     }catch(Exception $e){
        //     abort(404);
        // }بحوله لصفحة 404IPسيناريو لو ما لقا ال


        $Categories = Category::findOrFail($id);
        //"select * from `categories` where `id` <> $id and (`parent_id` is null or `parent_id` <> $id)"
        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $id);
            })->get();
        return view('dashboard.Categories.edit', compact('Categories', 'parents'));
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

        $request->validate(Category::rules($id));

        //     $category->fill($request->all)->save(); // طريقة 2

        // $category->name = $request->name;
        // $category->parent_id = $request->parent_id;
        // $category->save(); // طريقة 3
        $old_image = $category->image;

        $data = $request->except('image');
        $data['image'] = $this->upload_image($request);


        $category->update($data); // هي اول طريقة

        if ($old_image && $data['image']) {
            Storage::dis('public')->delete($old_image);
        }


        return redirect()->route('dashboard.Categories.index')->with('update', 'category updated successfully');
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
        $category->delete();

        return redirect()->route('dashboard.Categories.index')->with('delete', 'category deleted successfully');
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


    public function trash()
    {
        $categories  = Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash',compact('categories'));
    }

    public function restore($id)
    {
        $categories = Category::onlyTrashed()->findOrFail($id);
        $categories->restore();
        return redirect()->route('dashboard.Categories.trash')->with('success', 'category restored successfully');

    }

    public function forcedelete($id){
        $categories= Category::onlyTrashed()->findOrFail($id);
        $categories->forcedelete();
        return redirect()->route('dashboard.Categories.trash')->with('delete', 'category deleted successfully');


    }



}
