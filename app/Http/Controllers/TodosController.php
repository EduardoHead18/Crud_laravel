<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;
class TodosController extends Controller
{
    //
    /**
     * index para mostrar todos los datos
     * store para guardar un dato
     * update para actualizar un dato
     * destroy para eliminar un dato
     * edit para mostrar el formulario de edicion
     */
    //store para guardar un dato
    public function store(Request $request){
        $request->validate([
            'title'=>'required|min:5'
        ]);
        $todo = new Todo;
        $todo->title = $request->title;
        $todo->category_id = $request->category_id;
        //$todo->category_id = $request->title;
        $todo->save();
        return redirect()->route('todos')->with('success','Tarea creada correctamente');
    }
    //index 
    public function index(){
        $todos = Todo::all();
        $categories = Category::all();
        return view('vistas.index',['todos'=>$todos,'categories'=>$categories]);
    }
    //show
    public function show($id){
        $todo = Todo::find($id);
        return view('vistas.show',['todo'=>$todo]);

    }
    public function update(Request $request,$id){
        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->save();
        //return view('vistas.index',['success'=> 'Tarea actualizada!']);
        return redirect()->route('todos')->with('success', 'Tarea actualizada!');
        
    }
    public function destroy($id){
        $todo = Todo::find($id);
        $todo->delete();
        return redirect()->route('todos')->with('success', 'La tarea se elimino');
        
    }

}
