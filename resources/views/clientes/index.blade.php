@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8"><h3>Clientes</h3></div>
                        <div class="col-4" id="div-btn-close-cliente" style="display: none;"><button class="form-control btn btn-danger" type="button"  onclick="closeNovo()">Fechar</button></div>
                        <div class="col-4" id="div-btn-new-cliente"><button class="form-control btn btn-success" type="button" onclick="openNovo()">Novo&nbsp<i class="fas fa-lg fa-plus"></i></button></div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="form-cliente" style="display: none;">
                        {{ csrf_field() }}
                        <input type="hidden" class="clearForm" name="id" id="id" value="">
                        <div class="row" >
                            <div class="col-4">
                                <label style="margin-right: 15px;">Pessoa</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input clearFormRadio" type="radio" name="tipo_pessoa" id="cpf" value="cpf" required="">
                                    <label class="form-check-label" for="cpf">
                                        Física
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input clearFormRadio" type="radio" name="tipo_pessoa" id="cnpj" value="cnpj">
                                    <label class="form-check-label" for="cnpj">
                                        Jurídica
                                    </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <input class="form-control clearForm" type="text" name="cadastro_nacional" id="cadastro_nacional" placeholder="CPF/CNPJ" required="" maxlength="20">
                            </div>
                            <div class="col-4">
                                <input class="form-control clearForm" type="text" name="nome" id="nome" placeholder="Nome" required="">
                            </div>                            
                        </div>          
                        <br>          
                        <div class="row">
                            <div class="col-3">
                                <input class="form-control tooltipers clearForm" type="date" name="nascimento" id="nascimento" title="Data Nascimento/Fundação" required="">
                            </div>
                            <div class="col-3">
                                <input class="form-control tooltipers clearForm" type="date" name="cliente_desde" id="cliente_desde" title="Cliente Desde" required="">
                            </div>
                            <div class="col-6">
                                <textarea class="form-control clearForm" style="resize: none;" name="descricao" id="descricao" rows="1" placeholder="Descrição"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row div-edit" style="display: none; text-align: center;">
                            <div class="col-3" id="labe-created_at">Criado em</div>
                            <div class="col-3" id="labe-updated_at">Atualizado em</div>
                            <div class="col-3" id="labe-user_atualizou">Quem atualizou</div>
                            <div class="col-3" id="labe-user_criou">Quem criou</div>
                        </div> 
                        <div class="row div-edit" style="display: none; text-align: center;">
                            <div class="col-3 clearDiv" id="created_at"></div>
                            <div class="col-3 clearDiv" id="updated_at"></div>
                            <div class="col-3 clearDiv" id="user_atualizou"></div>
                            <div class="col-3 clearDiv" id="user_criou"></div>
                        </div>       
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <button class="form-control btn btn-success" type="button" id="btn-salver" onclick="chooseAction();">Salvar</button>
                            </div>
                        </div>                    
                    </form>
                    <br>          
                    <table class="table" style="text-align: center;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Pessoa</th>
                                <th scope="col">CPF/CNPJ</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Deletar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clientes as $cliente)
                                <tr>
                                    <td>{{$cliente['id']}}</td>
                                    <td>
                                        @if ($cliente['tipo_pessoa'] == 0)
                                            Física
                                        @else
                                            Jurídica
                                        @endif
                                    </td>
                                    <td>{{$cliente['cadastro_nacional']}}</td>
                                    <td>{{$cliente['nome']}}</td>
                                    <td><button class="form-control btn btn-primary" type="button" onclick="info_cliente({{$cliente['id']}})"><i class="fas fa-lg fa-edit"></i></button></td>
                                    <td><button class="form-control btn btn-danger" type="button" onclick="askDelete({{$cliente['id']}})"><i class="fas fa-lg fa-trash"></i></button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal') 
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deletar cliente?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete-cliente-id" value="">
                    Tem certeza que deseja deletar o cliente?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="delete_cliente()">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js') 
    <script src="{{ asset('js/clientes/index.js?v=') }}{{filemtime('js/clientes/index.js')}}"></script>
@endsection

