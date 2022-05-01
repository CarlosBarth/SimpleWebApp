<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ControllerPadrao;
use Illuminate\Http\Request;

use App\Models\Pessoa;

class PessoaController extends ControllerPadrao {

    public function create(Request $oResuqest) {
        try {
            $oPessoa = new Pessoa($oResuqest->nome, $oResuqest->cpf);
            $this->getEntityManager()->persist($oPessoa);
            $this->getEntityManager()->flush();
            return  redirect()->route('consulta_pessoa')->with('sucess', 'Registro Incluido com Sucesso');
            
        } catch (\Exception $ex) {
            return  redirect()->route('consulta_pessoa')->with('error', 'Erro ao incluir o registro');
        }
    }

    public function index() {
        $repository =  $this->getEntityManager()->getRepository(Pessoa::class);
        return view('pessoas.consulta', ['pessoas' => $repository->findAll()]);
    }
    
    public function update(Request $oRequest) {
        $oRepository = $this->getEntityManager()->getRepository(\App\Models\Pessoa::class);
        $oPessoa = $oRepository->find($oRequest->id);
        if ($oPessoa) {
            $oPessoa->setNome($oRequest->nome);
            $oPessoa->setCpf($oRequest->cpf);
            $this->getEntityManager()->merge($oPessoa);
            $this->getEntityManager()->flush();
            return  redirect()->route('consulta_pessoa')->with('sucess', 'Registro Alterado com Sucesso');
        }
        return  redirect()->route('consulta_pessoa')->with('error', 'Não foi possivel alterar o registro');
    }
    
    public function destroy($id) {
        $oRepository = $this->getEntityManager()->getRepository(\App\Models\Pessoa::class);
        $oPessoa = $oRepository->find($id);
        if ($oPessoa) {
            $this->getEntityManager()->remove($oPessoa);
            $this->getEntityManager()->flush();
            return  redirect()->route('consulta_pessoa')->with('sucess', 'Registro removido com Sucesso');
        }
        return  redirect()->route('consulta_pessoa')->with('error', 'Não foi possivel remover o registro');
        
    }

}
