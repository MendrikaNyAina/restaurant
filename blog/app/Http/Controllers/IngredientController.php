<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ingredient\Ingredient;
use App\Models\ingredient\Unity;
use App\Models\ingredient\StockIngredient;
use App\Models\ingredient\MovementIngredient;
use App\Models\ingredient\UpdateStock;

class IngredientController extends Controller
{
    private $stockIngredient;
    private $movementIngredient;
    private $updateStock;
    public function __construct(StockIngredient $stockIngredient, MovementIngredient $movementIngredient, UpdateStock $updateStock)
    {
        $this->middleware('auth');
        $this->stockIngredient=$stockIngredient;
        $this->movementIngredient=$movementIngredient;
        $this->updateStock=$updateStock;
    }
    public function postCreate(Request $request){
        $ingredient = new Ingredient();
        $ingredient->name=$request->input('name');
        $ingredient->unity_id=$request->input('unity_id');
        $ingredient->unit_price=0;
        $filename=$ingredient->name.'.'.$request->file('image')->getClientOriginalExtension();
        $img=$request->file('image')->storeAs('image/ingredient', $filename);
        $ingredient->image='image/ingredient'.$filename;
        $ingredient->save();
        // var_dump($img);
        // var_dump($ingredient->name);
        return $this->getCreate("insertion reussi");
    }
    public function getCreate($message="", $erreur=""){
        $allUnity=Unity::all();
        return view('ingredient/ingredient_create')->with("unities",$allUnity)->with("message",$message)->with("erreur", $erreur);
    }

    //recherche avance, par nom, reste dans le stock, prix unitaire.
    public function getRead(Request $request){
        $allIngredient=$this->stockIngredient->search(3, $request->input('prixmin'),$request->input('prixmax'),$request->input('name'),$request->input('stockmin'),$request->input('stockmax'));
        //var_dump($allIngredient->links());
        return view('ingredient/ingredient_stock')->with("ingredient",$allIngredient)->with("filters",$request->all());
    }
    public function getDetail($id, $entry=null, $output=null, $update=null){
        $ingredient=StockIngredient::find($id);
        $current_week=date('o-\WW');
        isset($entry)?$entry=$entry:$entry=$this->movementIngredient->entry($id,$current_week);
        isset($output)?$output=$output:$output=$this->movementIngredient->output($id,$current_week);
        isset($update)?$update=$update:$update=$this->updateStock->getByWeek($id,$current_week);

        // return view('ingredient/ingredient_detail')->with("ingredient",$ingredient);
        return view('ingredient/ingredient_detail')->with("ingredient",$ingredient)->with("entry",$entry)->with("output",$output)->with("update",$update);
    }
    public function getMovementEntry($id, Request $req){
        $entry= $this->movementIngredient->entry($id,$req->input('week_entre'));
        return $this->getDetail($id, $entry);
    }
    public function postMovementEntry($id, Request $req){
        $mov=new MovementIngredient();
        $mov->ingredient_id=$id;
        $mov->quantity=$req->input('quantite_entre');
        $mov->type_movement='e';
        $mov->unit_price=$req->input('unit_price_entre');
        $mov->date_movement=$req->input('date_entre');
        $mov->save();
        return redirect('/ingredient/'.$id)->with("message", "insertion reussie");
        // $entry= $this->movementIngredient->entry($id,$req->input('date_entre'));
    }

    public function getMovementOutPut($id, Request $req){
        $entry= $this->movementIngredient->output($id,$req->input('week_sortie'));
        return $this->getDetail($id, $entry);
    }
    public function getUpdateStock($id, Request $req){
        $entry= $this->updateStock->getByWeek($id,$req->input('week_rappel'));
        return $this->getDetail($id, $entry);
    }
    public function postUpdateStock($id, Request $req){
        $mov=new UpdateStock();
        $mov->ingredient_id=$id;
        $mov->quantity=$req->input('quantite_rappel');
        $mov->unit_price=$req->input('unit_price_rappel');
        $mov->date_update=$req->input('date_rappel');
        $mov->save();
        return redirect('/ingredient/'.$id)->with("message", "insertion reussie");
        // $entry= $this->movementIngredient->entry($id,$req->input('date_entre'));
    }

}
