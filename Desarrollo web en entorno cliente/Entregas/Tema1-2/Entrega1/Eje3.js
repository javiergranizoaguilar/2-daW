'use strict'
function Eje3() {
    let num = 0;
    //faltarian validaciones para comprovar que es un numero y no una letra pero es algo que no emos dado y extraño por lo que no se lo pondre

    num = pedirNumero();
    if (numero < 0) {
        document.writeln("<h1>Error Su Presupuesto es NEGATIVO</h1>");
    } else {
        let list = [((num * 50) / 100), ((num * 20) / 100), ((num * 30) / 100)];
        document.writeln("<ul>"
            + "<li> Documento de presupuestos </li>"
            + "<li> Materiales " + list[0] + "</li>"
            + "<li> Mano de Obra " + list[1] + "</li>"
            + "<li> Licencias de Obra " + list[2] + "</li>"
            + "</ul>"
        );
    }
    function pedirNumero() {
        let numero;
        do {
            numero = prompt("Introduce un número mallor a 0:");

            // Convertimos a número y validamos
            numero = parseFloat(numero);

            // Verificamos si:
            // - No es un número válido (isNaN)
            if (isNaN(numero)) {

                numero = null; // Forzamos a que siga en el bucle
            }
        } while (numero === null || isNaN(numero));

        return numero;
    }
}