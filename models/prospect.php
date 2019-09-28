<?php

namespace models;

class Prospect{
    public $nomecompleto;
    public $cpf;
    public $email;
    public $whatsapp;
    public $telefone;
    public $cep;
    public $rua;
    public $numero;
    public $bairro;
    public $cidade;
    public $uf;
    public $facebook;
    public $idprospect;

    public function incluirProspect($nomecompleto, $cpf, $email, $whatsapp, $telefone, $cep, $rua, $numero, $bairro, $cidade, $uf, $facebook){
        $conexaoDB = $this->conectarBanco();

        $sqlInsert = $conexaoDB->prepare("insert into prospect
                                        (nomecompleto, cpf, email, whatsapp, telefone, cep, rua, numero, bairro, cidade, uf, facebook)
                                        values
                                        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $sqlInsert->bind_param("ssssssssssss", $nomecompleto, $cpf, $email, $whatsapp, $telefone, $cep, $rua, $numero, $bairro, $cidade, $uf, $facebook);

        $sqlInsert->execute();

        if(!$sqlInsert->error){
            $retorno = true;
        }else{
            $retorno = false;
        }

        $conexaoDB->close();
        $sqlInsert->close();
        return $retorno;
    }

    public function atualizarProspect($nomecompleto, $cpf, $email, $whatsapp, $telefone, $cep, $rua, $numero, $bairro, $cidade, $uf, $facebook, $idprospect){
        $conexaoDB = $this->conectarBanco();

        $sqlUpdate = $conexaoDB->prepare("update prospect set
                                        nomecompleto = ?,
                                        cpf = ?, 
                                        email = ?, 
                                        whatsapp = ?, 
                                        telefone = ?, 
                                        cep = ?, 
                                        rua = ?, 
                                        numero = ?, 
                                        bairro = ?, 
                                        cidade = ?, 
                                        uf = ?, 
                                        facebook = ?
                                        where
                                        idprospect = ?");
        $sqlUpdate->bind_param("ssssssssssssi", $nomecompleto, $cpf, $email, $whatsapp, $telefone, $cep, $rua, $numero, $bairro, $cidade, $uf, $facebook, $idprospect);

        $sqlUpdate->execute();

        if(!$sqlUpdate->error){
            $retorno = true;
        }else{
            $retorno = false;
        }
        $conexaoDB->close();
        $sqlUpdate->close();
        return $retorno;
    }

    
    public function deletarProspect($idprospect){
        $conexaoDB = $this->conectarBanco();

        $sqlDelete = $conexaoDB->prepare("delete from prospect
                                            where idprospect = ?");
        $sqlDelete->bind_param("i", $idprospect);

        $sqlDelete->execute();

        if(!$sqlDelete->error){
            $retorno = true;
        }else{
            $retorno = false;
        }
        $conexaoDB->close();
        $sqlDelete->close();
        return $retorno;
    }

    public function buscarProspect($email=null){
        $conexaoDB = $this->conectarBanco();
        $listaProspects = array();

        if($email === null){
            $sqlBuscar = $conexaoDB->prepare("select idprospect, nome, email, celular
                                            from prospect");
            $sqlBuscar->execute();
        }else{
            $sqlBuscar = $conexaoDB->prepare("select idprospect, nome, email, celular
                                            from prospect
                                            where
                                            email = ?");
            $sqlBuscar->bind_param("s", $email);
            $sqlBuscar->execute();
        }

        $resultado = $sqlBuscar->get_result();

        if($resultado->num_rows !==0){
            while($linha = $resultado->fetch_assoc()){
                $prospects = array(
                    "idprospect" => $linha['idprospect'],
                    "nomecompleto" => $linha['nomecompleto'],
                    "email" => $linha['email'], 
                    "whatsapp" => $linha['whatsapp'], 
                    "telefone" => $linha['telefone'], 
                    "cep" => $linha['cep'],
                    "rua" => $linha['rua'],
                    "numero" => $linha['numero'],
                    "bairro" => $linha['bairro'],
                    "cidade" => $linha['cidade'], 
                    "uf" => $linha['uf'], 
                    "facebook" => $linha['facebook']
                );

                $listaProspects[] = $prospects;
            }
        }
        $conexaoDB->close();
        $sqlBuscar->close();
        return $listaProspects;

    }

    private function conectarBanco(){
        $conn = new \mysqli('localhost', 'root', '', 'cadastrodeprospect');
        return $conn;
    }
}




?>