<?php
    namespace Peticiones;
    
    require_once ('../negocio/ResolvedorPeticiones.php');
    
    use Peticiones\ResolvedorPeticiones;
    
    $resolverPeticion = new ResolvedorPeticiones();
    echo $resolverPeticion->resolverPeticion();
    
?>
