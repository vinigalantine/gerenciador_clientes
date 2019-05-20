<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;

use App\Cliente;

class ClienteController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct(Cliente $model)
    {
    	$this->middleware('auth');

        $this->model = $model;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	return view('clientes.index', 
    		[
    			'clientes' => $this->model->list(),
    		]
    	);
    }

    public function list()
    {
        return response()->json($this->model->list(), 201);
    }

    public function info($id)
    {	
        return response()->json($this->model->info($id), 201);
    }

    public function store(Request $request)
    {
    	if ($this->model->store($request))
        	return response()->json("Cliente criado com sucesso!", 201);
    }

    public function update(Request $request)
    {
    	if ($this->model->edit($request))
			return response()->json("Cliente atualizado com sucesso!", 201);
    }

    public function delete($id)
    {
    	if ($this->model->erase($id))
        	return response()->json("Cliente deletado com sucesso!", 201);
    }
}
