<?php

namespace models;

class Usuario{
    public $nomecompleto;
    public $email;
    public $login;
    public $estaLogado;

    public function logar($login, $senha){
        $conexaoDB = $this->conectarBanco();
        $sql = $conexaoDB->prepara("select nomecompleto, email, login from usuario
                                    where
                                    login = ?
                                    and
                                    senha = ?");
        $sql->bind_param("ss", $login, $senha);
        //String String -> ss
        //Int Int -> ii
        $sql>execute();

        $resultado = $sql->get_result(); //Filtra o resultado em uma linha
        if($resultado->num_rows === 0){ //Número de linhas = 0 -> Login Incorreto
            $this->nomecompleto = null;
            $this->email = null;
            $this->login = null;
            $this->estaLogado = FALSE;
        }else{
            //Login certo
            while($linha = $resultado->fetch_assoc()){ //Cada resulttadp lê uma linhas
                $this->login = $linha['login'];
                $this->nomecompleto = $linha['nomecompleto'];
                $this->email = $linha['email'];
                $this->estaLogado = TRUE;
            }
        }
        $sql->close();
        $conexaoDB->close();
        return $this->estaLogado;
    }
    public function incluirUsuario($nomecompleto, $email, $loin, $senha){
        $conexaoDB = $this->conectarBanco();

        $sqlInsert = $conexaoDB->prepare("insert into usuario
                                        (nomecompleto, email, login, senha
                                        values
                                        (?, ?, ?, ?)");

        $sqlInsert->bind_param("ssss", $nomecompleto, $email, $loin, $senha);

        $sqlInsert->execute();

        return TRUE;
    }
    private function conectarBanco(){
        $conn = new \mysqli('localhost', 'root', '', 'cadastrodeprospect');
        return $conn;
    }
}




?>