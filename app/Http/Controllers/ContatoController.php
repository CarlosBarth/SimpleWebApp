<?php

namespace App\Http\Controllers;

use \LaravelDoctrine\ORM\Facades\EntityManager;
use App\Http\Controllers\ControllerPadrao;
use Illuminate\Http\Request;
use App\Models\Contato;

class ContatoController extends ControllerPadrao {

    public function create(Request $oRequest) {
        try {
            $oPessoa =  $this->getEntityManager()->getRepository(\App\Models\Pessoa::class)->find($oRequest->pesId);
            $oContato = new Contato($oRequest->tipo, $oRequest->descricao, $oPessoa);
            $this->getEntityManager()->merge($oContato);
            $this->getEntityManager()->flush();
            return redirect()->route('consulta_contato',['contatos' => $this->getContatosFromPessoa($oRequest->pesId), 'pesId' => $oRequest->pesId])->with('sucess', 'Registro Inserido com Sucesso');
        } catch (\Exception $ex) {
            return redirect()->route('consulta_contato',['contatos' => $this->getContatosFromPessoa($oRequest->pesId), 'pesId' => $oRequest->pesId])->with('erro', 'Não foi possivel Inserir o registro');
        }
    }

    public function index($pesId) {
        try {
            $aContatos = $this->getContatosFromPessoa($pesId);
            return view('contatos.consulta', ['contatos' => $aContatos, 'pesId' => $pesId])->with('sucess', 'Registro Alterado com Sucesso');
        } catch (\Exception $ex) {
            return view('lcontatos.consulta', ['contatos' => ($aContatos ?? []), 'pesId' => $pesId]);
        }
    }

    public function update(Request $oRequest) {
        try {
            $oRepository = $this->getEntityManager()->getRepository(Contato::class);
            $oContato = $oRepository->find($oRequest->id);

            if ($oContato) {
                $oContato->setTipo($oRequest->tipo);
                $oContato->setDescricao($oRequest->descricao);
                $this->getEntityManager()->merge($oContato);
                $this->getEntityManager()->flush();
            }

            return redirect()->route('consulta_contato',['contatos' => $this->getContatosFromPessoa($oRequest->pesId), 'pesId' => $oRequest->pesId])->with('sucess', 'Registro Alterado com Sucesso');
        } catch (Exception $ex) {
            return redirect()->route('consulta_contato',['contatos' => $this->getContatosFromPessoa($oRequest->pesId), 'pesId' => $oRequest->pesId])->with('erro', 'Não foi possivel alterar o registro');
        }
    }

    public function destroy($id) {
        $oRepository = $this->getEntityManager()->getRepository(Contato::class);
        $oContato = $oRepository->find($id);
        if ($oContato) {
            $this->getEntityManager()->remove($oContato);
            $this->getEntityManager()->flush();
            return redirect()->route('consulta_contato', ['pesId' => $oContato->getPessoa()->getId() ])->with('sucess', 'Registro removido com Sucesso');
        }
        return redirect()->route('consulta_pessoa', ['pesId' => $oContato->getPessoa()->getId() ])->with('error', 'Não foi possivel remover o registro');
    }

    public function getContatosFromPessoa($pesId) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('cont')
                ->from('\App\Models\Contato', 'cont')
                ->where("cont.pessoa = {$pesId}");
        return $qb->getQuery()->getResult();
    }

}
