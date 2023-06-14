<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\plat\Category;
use App\Models\plat\Dish;
use App\Models\plat\DishIngredient;
use App\Models\plat\DishDetail;


class DishController extends Controller
{
    private $dishDetail;
    public function __construct(DishDetail $d){
        $this->dishDetail=$d;
    }
    public function getInsert(){
        $cat=Category::all();
        return view('dish/dish_create')->with("category", $cat);
    }
    public function postInsert(Request $request){
        $dish=new Dish();
        $dish->name=$request->input('name');
        $dish->description=$request->input('description');
        $dish->image=$request->input('image');
        $dish->category_id=$request->input('category_id');

        $arrayIngredient=$request->array('ingredient_id');
        $arrayQuantity=$request->array('quantity');
        $ingredients=array();
        for($i=0;$i<count($arrayIngredient);$i++){
            array_push($ingredients, new DishIngredient($arrayIngredient[$i], $arrayQuantity[$i]));
        }

        $dish->save();
        foreach($ingredients as $in){
            $in->dish_id=$dish->id;
            $in->save();
        }
    }
    //recherche avance, par nom/description, categorie, prix unitaire.
    public function getRead(Request $request){
        $allDish=$this->dishDetail->search(10, $request->input('name'), $request->input('prixmin'),$request->input('prixmax'),$request->input('category'));
        //var_dump($allIngredient->links());
        return view('dish/dish_liste')->with("dishes",$allDish)->with("filters",$request->all());
    }
}
