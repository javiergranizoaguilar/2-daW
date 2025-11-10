'use strict'

function PrimerE() {
    //faltarian validaciones para comprovar que es un numero y no una letra pero 
    // es algo que no emos dado y extraño por lo que no se lo pondre para que 
    // se use pero aqui esta

    let num;
    let NumberList = [];
    let Cuadrados = 0;

    num = pedirNumero();
    eje1a(num);
    eje1b(NumberList);
    eje1c(Cuadrados);
    //a
    function eje1a(num1) {
        for (let x = 1; num1 >= x; x++) {
            if ((num1 % x) == 0) {
                NumberList.push(x);
            }
        }
        alert(NumberList)
    }
    //b
    function eje1b(NumberList1) {
        NumberList1.forEach(cuadra => {
            Cuadrados += (cuadra ** 2);

        });
        alert(Cuadrados);
    }
    //c
    function eje1c(Cuadrados1) {
        if (Number.isInteger(Math.sqrt(Cuadrados1))) {
            alert(Cuadrados1 + " Es un cuadrado y este es su numero" + Math.sqrt(Cuadrados1))
        }
        else {
            alert(Cuadrados1 + " No es un cuadrado")
        }
    }
    function pedirNumero() {
        let numero;
        do {
            numero = prompt("Introduce un número mallor a 0:");

            // Convertimos a número y validamos
            numero = parseFloat(numero);

            // Verificamos si:
            // - No es un número válido (isNaN)
            if (isNaN(numero) || numero <= 0) {
                alert("Por favor, introduce un número mallor a 0");
                numero = null; // Forzamos a que siga en el bucle
            }
        } while (numero === null || isNaN(numero) || numero <= 0);

        return numero;
    }
}
