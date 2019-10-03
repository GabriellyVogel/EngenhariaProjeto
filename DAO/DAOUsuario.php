<?php

namespace DAO;
require_once('../models/Usuario.php');
use models\Usuario;


class DAOUsuario{

    public function logar($login, $senha){
        $conexaoDB = $this->conectarBanco();
        $sql = $conexaoDB->prepare("select nomecompleto, email, login from usuario
                                    where
                                    login = ?
                                    and
                                    senha = ?");
        $sql->bind_param("ss", $login, $senha);
        //String String -> ss
        //Int Int -> ii
        $sql->execute();

        $resultado = $sql->get_result(); //Filtra o resultado em uma linha
        if($resultado->num_rows === 0){ //Número de linhas = 0 -> Login Incorreto
            $usuario->addUsuario(null, null, null, null, false);

        }else{
            //Login certo
            while($linha = $resultado->fetch_assoc()){ //Cada resulttadp lê uma linhas
                $usuario->addUsuario($linha['login'], $linha['nome'], $linha['email'], true);
            }
        }
        $sql->close();
        $conexaoDB->close();
        return $usuario;
    }
    public function incluirUsuario($nomecompleto, $email, $login, $senha){
        $conexaoDB = $this->conectarBanco();

        $sqlInsert = $conexaoDB->prepare("insert into usuario
                                        (nomecompleto, email, login, senha)
                                        values
                                        (?, ?, ?, ?)");

        $sqlInsert->bind_param("ssss", $nomecompleto, $email, $login, $senha);

        $sqlInsert->execute();

        if(!$sqlInsert->error){
            return true;
        }else{
            return false;
        }
        return TRUE;
    }
    private function conectarBanco(){
        $conn = new \mysqli('localhost', 'root', '', 'cadastrodeprospect');
        return $conn;
    }
}




?>