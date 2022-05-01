@extends('layouts.app', ['page' => __('Pessoa'), 'pageSlug' => 'contato'])
@section('content')
<button type="button" class="btn btn-fill btn-primary">
    <a style="text-decoration: none; color: #ffffff;display: inline-block; position: relative; z-index: 1; padding: 4em; margin: -4em;" href="{{ Route('consulta_pessoa') }}">Voltar</a></button>

<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title text-muted">Consulta Contatos Pessoa Id: {{ $pesId }}</h5>
            </div>
            <div class="card-body" >
                @if(session('sucess'))
                <div class="alert alert-success">
                    <p>{{session('sucess')}}</p>
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">
                    <p>{{session('error')}}</p>
                </div>
                @endif
                @if(session('alert'))
                <div class="alert alert-warning">
                    <p>{{session('alert')}}</p>
                </div>
                @endif
                <div class="table "style="padding-bottom: 7rem">
                    <table  id="order" class="table table-full-width table-responsive-xl" style="width: 100%">
                        <thead class=" text-primary">
                            <tr>
                                <th>
                                    Id
                                </th>
                                <th>
                                    Tipo
                                </th>
                                <th>
                                    Descriçao
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contatos as $contato) 
                            <tr>
                                <td>
                                    {{$contato->getId()}}
                                </td>
                                <td>
                                    {{  App\Enums\ContatoEnum::getDescription($contato->getTipo()) }}
                                </td>
                                <td>
                                    {{$contato->getDescricao()}}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only"  href="#" role="button" data-toggle="dropdown" aria-haspopup="true">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href=""  data-toggle="modal" data-target="#alt-{{ $contato->getId() }}" >Alterar</a>
                                            <a class="dropdown-item" href=""  data-toggle="modal" data-target="#vis-{{ $contato->getId() }}" >Visualizar</a>
                                            <a class="dropdown-item" href=""  data-toggle="modal" data-target="#ex-{{ $contato->getId() }}" >Excluir</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title text-muted">Cadastro</h5>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-fill btn-primary" data-toggle="modal" data-target="#cadastrar"  data-pesId="{{ $pesId }}">Cadastrar Contato</button>
            </div>
        </div>
    </div>
    <!-- Criar o Modal de inclusão-->
    <div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="cadastrarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title title" id="incluir">Cadastrar Contato</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form  method="POST" id="form" action="{{ route('incluir_contato') }}">
                    <div class="modal-body">
                        @csrf
                        <div class="col-md-3">
                            <div class="row">
                                <label for="pesId" hidden="">Id Pessoa</label>
                                <input type="text" name="pesId" value="{{ $pesId }}" id="pesId" required="" readonly="" hidden=""> <br/>  
                            </div>
                            <div class="row">
                                <label for="tipo">Tipo</label>
                                <select name="tipo" id="tipo">
                                    @foreach (App\Enums\ContatoEnum::getListaTipo() as $key => $value) 
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <label for="descricao">Descrição</label>
                                <input type="text" name="descricao" value="" id="descricao" required=""> <br/>  
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" id="btnExcluir">Salvar</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>
    @foreach ($contatos as $contato) 
    <!-- Criar os Modais de exclusão-->
    <div class="modal fade" id="ex-{{ $contato->getId() }}" tabindex="-1" role="dialog" aria-labelledby="excluirModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title title" id="excluir">Deletar Contato</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form  method="POST" id="form" action="{{ route('excluir_contato',['id' => $contato->getId()]) }}">
                    <div class="modal-body">
                        @csrf
                        <div class="col-md-6">
                            <div class="row">
                                <h4 class="text-dark">Tem certeza eu deseja excluir este registro?</h4>
                            </div>
                            <div class="row">
                                <label for="tipo">Tipo: </label>
                            </div>
                            <div class="row">
                                <select name="tipo" id="tipo" disabled="">
                                    @foreach (App\Enums\ContatoEnum::getListaTipo() as $key => $value) 
                                    <option value="{{ $key }}" {{ $key == $contato->getTipo() ? 'selected' : ''}}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <label for="descricao">Descrição</label>
                                <input type="text" name="descricao" value="{{ $contato->getDescricao() }}" id="descricao" disabled=""> <br/>  
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" id="btnExcluir">Excluir</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>
    <!-- Criar os Modais de alteração-->
    <div class="modal fade" id="alt-{{ $contato->getId() }}" tabindex="-1" role="dialog" aria-labelledby="alterarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title title" id="excluir">Alterar Contato</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{Route('alterar_contato', ['id' => $contato->getId()])}}" >
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-6">
                            <div class="row">
                                <label for="pesId" hidden="">Pessoa Id</label>
                                <input type="number" name="pesId" value="{{$pesId}}" size="2" readonly="" hidden="">
                            </div>
                            <div class="row">
                                <label for="id">id</label>
                            </div>
                            <div class="row">
                                <input type="number" name="id" value="{{ $contato->getId() }}" size="2" readonly="">
                            </div>
                            <div class="row">
                                <label for="tipo">Tipo</label>
                            </div>
                            <div class="row">
                                <select name="tipo" id="tipo">
                                    @foreach (App\Enums\ContatoEnum::getListaTipo() as $key => $value) 
                                        <option value="{{ $key }}" {{ $key == $contato->getTipo() ? 'selected' : ''}}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <label for="descricao">Descrição</label>
                            </div>
                            <div class="row">
                                <input type="text" name="descricao" value="{{$contato->getDescricao()}}" size="7">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" id="btnExcluir">Alterar</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>
    <!-- Criar os Modais de visualização-->
    <div class="modal fade" id="vis-{{ $contato->getId() }}" tabindex="-1" role="dialog" aria-labelledby="alterarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title title" id="excluir">Visualizar Contato</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                        <div class="col-md-6">
                            <div class="row">
                                <label for="pesId" hidden="">Pessoa Id</label>
                                <input type="number" name="pesId" value="{{$pesId}}" size="2" readonly="" hidden="">
                            </div>
                            <div class="row">
                                <label for="id">id</label>
                            </div>
                            <div class="row">
                                <input type="number" name="id" value="{{ $contato->getId() }}" size="2"  disabled="">
                            </div>
                            <div class="row">
                                <label for="tipo">Tipo</label>
                            </div>
                            <div class="row">
                                <select name="tipo" id="tipo" disabled="">
                                    @foreach (App\Enums\ContatoEnum::getListaTipo() as $key => $value) 
                                        <option value="{{ $key }}" {{ $key == $contato->getTipo() ? 'selected' : ''}}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <label for="descricao">Descrição</label>
                            </div>
                            <div class="row">
                                <input type="text" name="descricao" value="{{$contato->getDescricao()}}" size="7" disabled="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
            </div>
        </div> 
    </div>
    @endforeach
</div>
@endsection


