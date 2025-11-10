'use strict'
function eje8() {
    let mesas = []
    let nummesas = 0;
    let comensales = 0;
    do {
        nummesas = prompt("Escriba el numero de Mesas");

        if (nummesas <= 0) {
            alert("Introduzca un numero Mallor a 0");
        }
    } while (nummesas <= 0);
    for (let x = 0; x < nummesas; x++) {
        mesas.push(Math.floor(Math.random() * 5))
    }
    console.log("El usuario ha metido el valor :" + nummesas)
    console.log(mesas)

    do {
        comensales = 0;
        do {
            comensales = parseInt(prompt("Escriba el numero comensales"));
            if (comensales > 4) {
                alert("Lo siento, no admitimos grupos de " + comensales + ", haga grupos de 4 personas como máximo e intente de nuevo")
            }
        } while (comensales > 4)
        if (comensales > 0) {
            let y = 1;
            for (let x = 0; x < y; x++) {
                if (x < mesas.length) {
                    if ((mesas[x] + comensales) <= 4) {
                        mesas[x] += comensales;
                        listarMesas(mesas);
                    }
                    else { y++; }
                }
                else { alert("No quedan Mesas sueltas") }
            }
        }
    } while (comensales > 0);
}
function listarMesas(tableList) {
    console.log("Mesas");
    for (let x = 0; x < tableList.length; x++) {
        console.log((x + 1) + "º Mesa: " + tableList[x]);
    }
}