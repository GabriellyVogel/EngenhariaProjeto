<?php

namespace models;

class Usuario{
    public $nomecompleto;
    public $email;
    public $login;
    public $estaLogado;

    public function logar($login, $senha){
        $conexaoDB = $this->conectarBanco();
        $sql = $conexapDB->prepara("select nomecompleto, email, login from usuario
                                    where
                                    login = ?
                                    and
                                    senha = ?");
    $sql->bind_param("ss", $login, $senha);
    $sql>execute();

    $resultado = $sql->get_result();
        if($resultado->num_rows() == "0"){
        $this->nomecompleto = null;
        $this->email = null;
        $this->login = null;
        $this->estaLogado = FALSE;
        }else{
            While($linha = $resultado->fetch_assoc()){
                $this->login = $linha['login'];
                $this->nomecompleto = $linha['nomecompleto'];
                $this->email = $linha['email'];
                $this->estaLogado = TRUE;
            }
        }
        $sql->close();
    }

    private function conectarBanco(){
        $conn = new \mysqli('localhost', 'root', '', 'cadastrodeprospect');
        return $conn;
    }
}


?>