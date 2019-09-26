<?php

namespace Tests;

require_once('../vendor/autoload.php');
require_once('../models/Usuario.php');

use models\Usuario;
use PHPUnit\Framework\TestCase;

class UsuarioTest extends TestCase{
    /** @test */
    public function testLogar(){
        $usuario = new Usuario();

        $this->assertEquals(
            TRUE,
            $usuario->logar('ab', 'bb')
        );
        unset($usuario);

    }
    /** @test */

    public function testincluirUsuario(){
        $usuario = new Usuario();
        $this->assertEquals(
            TRUE,
            $usuario->incluirUsuario("bc", "abc@bb.com", "abc", "bbc")
        );
        unset($usuario);
    }
}
?>