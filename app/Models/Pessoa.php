<?php

namespace App\Models;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="pessoa")
 */
class Pessoa {
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\Column(type="integer")
     * @ORM\SequenceGenerator(sequenceName="pessoa_seq", initialValue=1, allocationSize=1)
     */
    private $id = null;
     /**
     * @ORM\Column(type="string")
     */
    private $nome;
     /**
     * @ORM\Column(type="string")
     */
    private $cpf;
    
    function __construct($nome, $cpf) {
        $this->nome = $nome;
        $this->cpf = $cpf;
    }
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getCpf() {
        return $this->cpf;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setNome($nome): void {
        $this->nome = $nome;
    }

    function setCpf($cpf): void {
        $this->cpf = $cpf;
    }

}
