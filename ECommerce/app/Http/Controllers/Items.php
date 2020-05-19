<?php

namespace App\Http\Controllers;

use App\Image;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Items extends Controller
{
    public function getItems()
    {
        $items = DB::table('items')->orderBy('created_at','desc')->get();
        return response()->json($items, 200);
    }

    public function getItem($id)
    {
        $item = Item::find($id);
        if(is_null($item))
        {
            return response()->json('Record not found!', 404);
        }

        return response()->json($item ,200);
    }

    public function getImages($id)
    {
        $images = Item::find($id)->images;
        if(is_null($images))
        {
            return response()->json('Record not found!', 404);
        }
        return response()->json($images ,200);
    }

    public function saveImage(Request $request , $id){
        $item = Item::find($id);
        $image = new Image();
        $image->image = $request->input('image');
        $rules = [
            'image' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $item->images()->save($image);
        return response()->json($image, 201);
    }

    public function saveItem(Request $request){

        $item = new Item();
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->category = $request->input('category');
        $item->price = $request->input('price');
        $item->userId = $request->input('userId');
        $rules = [
            'name' => 'required|min:2',
            'description' => 'required|min:3',
            'category' => 'required|min:2',
            'price' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $item->save();
        return response()->json($item, 201);
    }

    public function updateItem(Request $request, $id){
        $item = Item::find($id);
        if(is_null($item))
        {
            return response()->json('Record not found!', 404);
        }
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->category = $request->input('category');
        $item->price = $request->input('price');
        $rules = [
            'name' => 'required|min:2',
            'description' => 'required|min:3',
            'category' => 'required|min:2',
            'price' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $item->save();
        return response()->json($item, 200);
    }


    public function deleteItem($id)
    {
        $item = Item::find($id);
        if(is_null($item))
        {
            return response()->json('Record not found!', 404);
        }
        $item->delete();
        return response()->json(null, 204);
    }
}
