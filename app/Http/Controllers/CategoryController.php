<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Events\CategoryUpdated;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        $categories=Category::where('user_id',Auth::id())->get();

        return view('pages.category.categoryList', compact('categories') );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.category.categoryAdd');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

            try{
                $request->validate([
                    'category' => 'required|string|min:3|max:50'
                ]);
                $user_id=Auth::id();
                Category::create([
                    'name'=>$request->input('category'),
                    'user_id'=>$user_id
                ]);
                return redirect()->route('category.index')->with('success','student updated successfully');
            }catch (\Exception $e){
                return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
            }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category=Category::find($id);
        return view('pages.category.categoryedit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
     $category=Category::find($id);

     $category->update([
        'name'=>$request->input('category'),
    ]);
    return redirect()->route('category.index')->with('success','student updated successfully');

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $category=Category::find($id);

        $category->delete();
       return back()->with('success','student updated successfully');

    }

    function CategoryList(){
        try{
            $user_id=Auth::id();
            $rows= Category::where('user_id',$user_id)->get();
            return response()->json(['status' => 'success', 'data' => $rows]);
        }catch (\Exception $e){
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

}
