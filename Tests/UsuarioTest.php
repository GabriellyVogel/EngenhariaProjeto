<?php

namespace Tests;

require_once('../vendor/autoload.php');
require_once('../models/Usuario.php');
require_once('../DAO/DAOUsuario.php');

use DAO\DAOUsuario;
use models\Usuario;
use PHPUnit\Framework\TestCase;

class UsuarioTest extends TestCase{
    /** @test */
    public function testLogar(){
        $usuario = new Usuario();
        $daoUsuario = new DAOUsuario();

        $usuario->addUsuario("paulo", "paulo", "paulo@eu.com", true);

        $this->assertEquals(
            $usuario,
            $daoUsuario->logar('paulo', '123')
        );
        unset($usuario);

    }
    /** @test */

    public function testincluirUsuario(){
        $daoUsuario = new DAOUsuario();
        $this->assertEquals(
            TRUE,
            $daoUsuario->incluirUsuario("bcd", "abcd@bb.com", "abcd", "bbcd")
        );
        unset($usuario);
    }
}
?>