<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function ProductList(){
        try{
            $user_id=Auth::id();
            $row = Product::where('user_id', $user_id)->get();
            return response()->json(['status' => 'success', 'message' => "Request Successful", 'data' => $row]);

        }
        catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }

    function ProductCreate(Request $request)
    {
        try {
            $user_id=Auth::id();
            $request->validate([
                'name' => 'required|string|max:50',
                'price' => 'required|string|max:50',
                'unit' => 'required|string|max:11',
                "category_id"=> 'required|string',
            ]);
            Product::create([
                'name'=>$request->input('name'),
                'price'=>$request->input('price'),
                'unit'=>$request->input('unit'),
                'category_id'=>$request->input('category_id'),
                'user_id'=>$user_id
            ]);
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        }catch (\Exception $e){
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function ProductDelete(Request $request)
    {
        try {
            $user_id=Auth::id();
            $request->validate([
                "id"=> 'required|string',
            ]);
            Product::where('id',$request->input('id'))->where('user_id',$user_id)->delete();
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        }catch (\Exception $e){
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function ProductByID(Request $request){
        try {
            $request->validate([
                'id' => 'required|min:1'
            ]);
            $product_id=$request->input('id');
            $user_id=Auth::id();
            $rows= Product::where('id',$product_id)->where('user_id',$user_id)->first();
            return response()->json(['status' => 'success', 'rows' => $rows]);
        }catch (\Exception $e){
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function ProductUpdate(Request $request)
    {
        try {
            $user_id=Auth::id();
            $request->validate([
                'name' => 'required|string|max:50',
                'price' => 'required|string|max:50',
                'unit' => 'required|string|max:11',
                "category_id"=> 'required|string',
                "id"=> 'required|string',
            ]);

            Product::where('id',$request->input('id'))->where('user_id',$user_id)->update([
                'name'=>$request->input('name'),
                'price'=>$request->input('price'),
                'unit'=>$request->input('unit'),
                'category_id'=>$request->input('category_id'),
            ]);

            return response()->json(['status' => 'success', 'message' => "Request Successful"]);

        }catch (\Exception $e){
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }

    }
}
