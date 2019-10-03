<?php

namespace models;

class Usuario{
    public $nomecompleto;
    public $email;
    public $login;
    public $estaLogado;

//GET E SET
    public function addUsuario($login, $nomecompleto, $email, $estaLogado){
        $this->login = $login;
        $this->nomecompleto = $nomecompleto;
        $this->email = $email;
        $this->estaLogado = $estaLogado;
    }
}

?>