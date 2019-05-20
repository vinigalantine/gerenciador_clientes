<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cliente extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'nascimento', 'tipo_pessoa', 'cadastro_nacional', 'cliente_desde', 'descricao', 'user_criou', 'user_atulizou'
    ];

    public function userCriou(){
    	return $this->belongsTo('App\User', 'user_criou', 'id');
    }

    public function userAtulizou(){
    	return $this->belongsTo('App\User', 'user_atualizou', 'id');
    }

    public function list(){
    	return $this->select('*')
    				->whereNull('deleted_at')
    				->orderBy('nome')
                    ->get()
                    ->toArray();
    }

    public function info($id){
    	return $this->find($id);
    }

    public function store($request){
    	$this->formatoCampos($request);

    	$this->user_criou = Auth::user()->id;

    	if($this->save())
    		return true;
    	else
    		return false;
    }

    public function edit($request){
    	$toUpdate = $this->find($request->input('id'));

    	$toUpdate->formatoCampos($request);

    	if($toUpdate->save())
    		return true;
    	else
    		return false;
    }

    public function erase($id){
    	$toDelete = $this->find($id);
    	$toDelete->deleted_at = date('Y-m-d H:i:s');

    	if($toDelete->save())
    		return true;
    	else
    		return false;
    }

    private function formatoData($date, $format = 'Y-m-d'){
        return date($format,strtotime(str_replace('/','-', $date)));
    }

    private function formatoCampos($request){
    	if ($request->input('nome'))
    		$this->nome = $request->input('nome');

    	if ($request->input('nascimento'))
    		$this->nascimento = $this->formatoData($request->input('nascimento'));

    	if ($request->input('tipo_pessoa')){
    		if($request->input('tipo_pessoa') == "cpf")
    			$this->tipo_pessoa = 0;
    		else
    			$this->tipo_pessoa = 1;
    	}

    	if ($request->input('cadastro_nacional'))
    		$this->cadastro_nacional = $request->input('cadastro_nacional');

    	if ($request->input('cliente_desde'))
    		$this->cliente_desde = $this->formatoData($request->input('cliente_desde'));

    	if ($request->input('descricao'))
    		$this->descricao = $request->input('descricao');

   		$this->user_atualizou = Auth::user()->id;
    }
}
