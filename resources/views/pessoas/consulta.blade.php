@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title text-muted">Consulta Pessoas</h5>
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
                                    Nome
                                </th>
                                <th>
                                    CPF/CNPJ
                                </th>
                                <th>
                                    Ações
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pessoas as $pes) 
                            <tr>
                                <td>
                                    {{$pes->getId()}}
                                </td>
                                <td>
                                    {{$pes->getNome()}}
                                </td>
                                <td>
                                    {{$pes->getCpf()}}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only"  href="#" role="button" data-toggle="dropdown" aria-haspopup="true">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href=""  data-toggle="modal" data-target="#alt-{{ $pes->getId() }}" >Alterar</a>
                                            <a class="dropdown-item" href=""  data-toggle="modal" data-target="#ex-{{ $pes->getId() }}" >Excluir</a>
                                            <a class="dropdown-item" href=""  data-toggle="modal" data-target="#vis-{{ $pes->getId() }}" >Visualizar</a>
                                            <a class="dropdown-item" href="{{ Route('consulta_contato', ['pesId' => $pes->getId()]) }}" >Contatos</a>
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
                <button type="button" class="btn btn-fill btn-primary" data-toggle="modal" data-target="#cadastrar">Cadastrar Pessoa</button>
            </div>
        </div>
    </div>
    <!-- Criar o Modal de inclusão-->
    <div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="cadastrarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title title" id="incluir">Cadastrar Pessoa</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form  method="POST" id="form" action="{{ route('incluir_pessoa') }}">
                    <div class="modal-body">
                        @csrf
                        <div class="col-md-3">
                            <div class="row">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" value="" id="nome" required=""> <br/>  
                            </div>
                            <div class="row">
                                <label for="cpf">CPF</label>
                                <input type="text" name="cpf" value="" id="cpf" required="" maxlength="14" onkeyup="mascara('cpf', '###.###.###-##')"> <br/>  
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
    @foreach ($pessoas as $pes) 
    
    <!-- Criar os Modais de exclusão-->
    <div class="modal fade" id="ex-{{ $pes->getId() }}" tabindex="-1" role="dialog" aria-labelledby="excluirModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title title" id="excluir">Deletar Pessoa</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form  method="POST" id="form" action="{{ route('excluir_pessoa',['id' => $pes->getId()]) }}">
                    <div class="modal-body">
                        @csrf
                        <label for="">Tem certeza eu deseja excluir este registro?</label>
                        <input type="text" name="nome" value="{{ $pes->getNome() }}" id="nome" disabled=""> <br/>  
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
    <div class="modal fade" id="alt-{{ $pes->getId() }}" tabindex="-1" role="dialog" aria-labelledby="alterarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title title" id="alterar">Alterar Pessoa</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{Route('alterar_pessoa', ['id' => $pes->getId()])}}" >
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-3">
                            <div class="row">
                                <label for="id">ID</label>
                            </div>
                            <div class="row">
                                <input type="number" name="id" value="{{$pes->getId()}}" size="2" readonly="">
                            </div>
                            <div class="row">
                                <label for="nome1">Nome</label>
                            </div>
                            <div class="row">
                                <input type="text" name="nome" value="{{$pes->getNome()}}" size="15">
                            </div>
                            <div class="row">
                                <label for="cpf">CPF</label>
                            </div>
                            <div class="row">
                                <input type="text" name="cpf" id="cpfAlt"value="{{$pes->getCpf()}}" size="7" maxlength="14" onkeyup="mascara('cpfAlt', '###.###.###-##')">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary" id="btnExcluir">Alterar</button>
                        </div>
                    </div>
                </form>
            </div> 
        </div>
    </div>
    <!-- Criar os Modais de visualização-->
    <div class="modal fade" id="vis-{{ $pes->getId() }}" tabindex="-1" role="dialog" aria-labelledby="visualizarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title title" id="visualizar">Visualizar Pessoa</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-3">
                        <div class="row">
                            <label for="id">ID</label>
                        </div>
                        <div class="row">
                            <input type="number" name="id" value="{{$pes->getId()}}" size="2" readonly="" disabled="">
                        </div>
                        <div class="row">
                            <label for="nome1">Nome</label>
                        </div>
                        <div class="row">
                            <input type="text" name="nome" value="{{$pes->getNome()}}" size="15" disabled="">
                        </div>
                        <div class="row">
                            <label for="cpf">CPF</label>
                        </div>
                        <div class="row">
                            <input type="text" name="cpf" id="cpfAlt"value="{{$pes->getCpf()}}" size="7" maxlength="14" onkeyup="mascara('cpfAlt', '###.###.###-##')" disabled="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    @endforeach
</div>
@endsection
<script>
    /**
     * Aplica determinada máscara
     * @param string $valor
     * @param string $formato
     * @return string
     */
    function mascara(campoId) {
        var valor = $('#' + campoId).val();

        if (valor.length <= 14 && valor.indexOf('/') == -1) {
            var formato = '###.###.###-##'
        } else {
            var formato = '##.###.###/####-##'
            if (valor.indexOf('/') == -1) {
                valor = valor.replace('.', '');
                valor = valor.replace('.', '');
                valor = valor.replace('/', '');
                valor = valor.replace('-', '');
            }
        }

        var retorno = '';

        var posicao_valor = 0;

        for (let i = 0; i <= formato.length - 1; i++) {
            if (i > valor.length) {
                break;
            }
            if (formato[i] == '#') {

                if (valor[posicao_valor] != null && valor[posicao_valor] != '.' && valor[posicao_valor] != '-') {

                    retorno += valor[posicao_valor++];
                }
            } else {
                if (formato[i] == '.' || formato[i] == '-' || formato[i] == '/') {
                    posicao_valor++;
                }
                retorno += formato[i];
            }
        }

        $('#' + campoId).val(retorno);
    }
</script>


