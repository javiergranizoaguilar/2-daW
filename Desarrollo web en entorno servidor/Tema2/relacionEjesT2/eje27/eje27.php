<?php
//no entiendo el para que sirve ?-> ya que si se lo quito a el ultimo se queda igual
$persona=[
    'nombre'=>'Juan',
    'direccion'=>[
        'calle'=>'Calle',
        'ciudad'=>'Ciudad',
    ]
];
acceso($persona);
function acceso( $usuario){
    $usuario["direccion"]=(object)$usuario["direccion"];
    $usuario=(object)$usuario;
    echo $usuario?->nombre??"No existe";
    echo "\n";
    echo $usuario?->direccion?->calle??"No existe";
    echo "\n";
    echo $usuario?->direccion?->ciudad??"No existe";
    echo "\n";
    echo $usuario?->direccion?->codigoPostal??"No existe";
}

?>