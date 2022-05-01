<?php

namespace App\Models;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contato")
 */
class Contato {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\Column(type="integer")
     * @ORM\SequenceGenerator(sequenceName="contato_seq", initialValue=1, allocationSize=1)
     */
    private $id = null;

    /**
     * @ORM\Column(type="integer")
     */
    private $tipo;

    /**
     * @ORM\Column(type="string")
     */
    private $descricao;

    /**
     * @ORM\ManyToOne(targetEntity="pessoa", cascade={"persist"}, fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="pessoa_id", referencedColumnName="id", onDelete="CASCADE")
     * @var pessoa
     */
    private $pessoa;

    function __construct($tipo, $descricao, $Pessoa) {
        $this->descricao = $descricao;
        $this->tipo = $tipo;
        $this->pessoa = $Pessoa;
    }

    function getId() {
        return $this->id;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setTipo($tipo): void {
        $this->tipo = $tipo;
    }

    function setDescricao($descricao): void {
        $this->descricao = $descricao;
    }
    
    function getPessoa() {
        return $this->pessoa;
    }

    function setPessoa($Pessoa): void {
        $this->pessoa = $Pessoa;
    }

}
