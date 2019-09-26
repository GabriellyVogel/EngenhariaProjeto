<?php

namespace Tests;

require_once('../vendor/autoload.php');
require_once('../models/Prospect.php');

use models\Prospect;
use PHPUnit\Framework\TestCase;

class ProspectTest extends TestCase{
    /** @test */
    public function testincluirProspect(){
        $prospect = new Prospect();
        $this->assertEquals(
            TRUE,
            $prospect->incluirProspect("Azul", "12345678900", "azul@eumacor.com", "49940028922", "1234-1234", "10100100", "Uma Rua Ai", "00", "Um Bairro", "Cidade", "CD", "azul é uma cor")
        );
        unset($prospect);
    }
    
    /** @test */
    public function testdeletarProspect(){
       $prospect = new Prospect();
       $this->assertEquals(
           TRUE,
           $prospect->deletarProspect("12345678900")
       );
       unset($prospect);
    }
}
?>