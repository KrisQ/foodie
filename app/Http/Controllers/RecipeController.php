<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;

class RecipeController extends Controller
{
    public function read($filter = 'all', $category = 'All', $param = null){
        if($filter == 'all'){
            if($category != 'All'){
                $recipes = Recipe::where('categories', $category)->paginate(6);
            } else {
                $recipes = Recipe::paginate(6);
            }
        } else if ($filter == 'author'){
            if($category != 'All'){
                $recipes = Recipe::where('author', $param)->where('categories', $category)->paginate(6);

            } else {
                $recipes = Recipe::where('author', $param)->paginate(6);
            }
        } else {
            $recipes = [];
        }
        return $recipes;
    }

    public function readOne($id){
        $recipe = Recipe::findOrFail($id);
        return $recipe;
    }


    public function store(Request $request)
    {
        $recipe = new Recipe;
        $recipe->title = $request->title;
        $recipe->author = $request->author;
        $recipe->ingredients = $request->ingredients;
        $recipe->instructions = $request->instructions;
        $recipe->categories = $request->category;


		if($request->image != ''){
			$exploded = explode(',', $request->image);
			$decoded = base64_decode($exploded[1]);
			if(str_contains($exploded[0], 'jpg')){
				$extention = 'jpg';
			} else if (str_contains($exploded[0], 'jpeg')) {
				$extention = 'jpeg';
			} else {
				$extention = 'png';
			}
			$fileName = str_random().'.'.$extention;
			$path = public_path().'/recipeImages/'.$fileName;
			if($extention){
				file_put_contents($path, $decoded);
				$recipe->photo = 'recipeImages/'.$fileName;
			}
        }

        $recipe->save();
        return response([
            'status' => 'success',
            'data' => $recipe
           ], 200);
     }
     public function edit(Request $request, $id)
     {
         $recipe = Recipe::findOrFail($id);
         $recipe->title = $request->title;
         $recipe->author = $request->author;
         $recipe->ingredients = $request->ingredients;
         $recipe->instructions = $request->instructions;
         $recipe->categories = $request->category;
 
         if($request->image != '' && $request->has_new_image == "1"){
             $exploded = explode(',', $request->image);
             $decoded = base64_decode($exploded[1]);
             if(str_contains($exploded[0], 'jpg')){
                 $extention = 'jpg';
             } else if (str_contains($exploded[0], 'jpeg')) {
                 $extention = 'jpeg';
             } else {
                 $extention = 'png';
             }
             $fileName = str_random().'.'.$extention;
             $path = public_path().'/recipeImages/'.$fileName;
             if($extention){
                 file_put_contents($path, $decoded);
                 $recipe->photo = 'recipeImages/'.$fileName;
             }
         }
 
         $recipe->save();
         return response([
             'status' => 'success',
             'data' => $recipe
            ], 200);
      }

      public function destroy($id){
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();
        return response([
            'status' => 'success',
           ], 200);

      }
 
}
