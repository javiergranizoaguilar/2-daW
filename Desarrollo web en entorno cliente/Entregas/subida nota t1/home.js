const PRIMERASSALAS = ["Sala de peluches", "Pasillo del amor", "Ala del niño"];
const SEGUNDASSALAS = ["Sala del veterinario", "Pasillo de la curiosidad", "Ala del descubrimiento"];
const TERCERASSALAS = ["Sala de pruebas", "Pasillo de la linea ", "Ala del orgullo"];
const CUARTASSALAS = ["Sala del no retorno ", "Pasillo de la aceptacion", "Ala del pecado"];
const ULTIMASSALAS = ["Sala del dolor", "Pasillo del sufrimiento", "Ala del destino"];

const PRIMERADESCRIPCION = ["Una sala llena de peluches amigables y sonrientes, uno de estos tiene un bulto en su tripita parece que le duele,esta sala te da mucha añoranza.",
    "Un suelo lleno devaldosas de colores se ciernen en este pasillo, en el centro unas almoadas esconden lo que parecen un kit de costura, al fondo se encuentra una puerta cerrada esperando por una llave para ser abierta",
    `Al entrar a esta sala encuentras una cama con un oso de peluche enorme el cual llace sobre esta cama, el osito al que nombraste "Tesoro".`];

const SEGUNDADESCRIPCION = ["Una sala de juegos, llena de jugetes de veterinaria,un kit de costuras, posteres de anatomia de animales y animales de jugete uno de estos con una x en su tripita parece que le duele la tripita por que tiene algo dentro, un sentimiento de orgulo se cuela en tu mente",
    "Un suelo como de un ajedrez se encuentra delante de ti en el centro una caja con una cruz roja reposa sobre una pequeña mesa , al fondo se encuentra una puerta cerrada esperando por una llave para ser abierta",
    `Al entrar a esta sala encuentras una cama con un oso enorme de jugete el cual llace sobre la cama, el oso al que llamaste "Tesoro"`];

const TERCERADESCRIPCION = ["Una sala rebosante de jugetes y de peluches todos encerrados en jaulas colgando del techo, en el suelo un ascalpelo y un quit de costura se encuentran",
    "Un suelo con losas mal colocadas en el centro una mesa con una escalera apollada en esta llace , al fondo se encuentra una puerta cerrada esperando por una llave para ser abierta",
    `Al entrar encuentras una amalgama de el osito de peluche y el oso de jugete llaciendo en la cama, la amalgama que fue llamada y nombrada por "Tesoro"`];

const CUATADESCRIPCION = ["Una sala bañada en rellenos tando de jugetes como de peluches, la sala rebosante de jugetes y de peluches abiertos sin sus respectivos rellenos todos encerrados en jaulas",
    "Un suelo con losas mal colocadas puntiagusa y llenas de legos en el centro unos guantes bañados en una sustancia roja rodeados de rellenos de jugetes",
    `Al entrar encuentras una persona "descansando" en esta cama aquella a la que mas de una vez le dijiste que era tu "Tesoro"`];

const ULTIMADESCRIPCION = ["Una sala bañada en sangre cadaveres descuartizados se alzan sobre esta sala, atados y encerrados en jaulas, de una de estas cuelga un cuerpo con una X tatuada en su pecho",
    "Un suelo lleno de cristales y legos se ciernen en esta sala, en cualquier lado que miras encuentras dolor, todo parece estar diseñado para recivir dolor, en el centro una caja llena de alambre de espinas envolviendo unas tijeras desgastadas",
    `Al entrar a esta sala encuentras aquello que llamarias "Tesoro" la sucia y moina cama donde llace el cuerpo inerte de ### la ultima persona que MATASTE`];

let primeroObjetos = ["LLave", "kit de costura", ""]
let segundosObjetos = ["LLave", "Escalpelo", ""]
let tercerosObjetos = ["LLave", "Escalera", ""]
let cuartosObjetos = ["LLave", "Guantes", ""]
let ultimosObjetos = ["LLave", "Tijeras", "Tesoro"]

let inventario = [];
let posicion = 0;
let vuelta = 0;
let ganar = false;

let botton = document.getElementById("button");
botton.addEventListener("click",()=>juego());


function juego() {
    let option = 0;
    do {
        description(vuelta, getPosicion())
        option = parseInt(prompt("Elije la opcion \n 1. Avanzar a la siguiente habitación \n 2. Retroceder a la habitación anterior \n 3. Recoger objeto \n 4. Ver inventario \n 0. Salir del juego"));
        console.log(option);
        console.log(vuelta);
        switch (option) {
            case 0:
                break;
            case 1:
                Avanzar();
                break;
            case 2:
                Retroceder();
                break;
            case 3:
                recojer();
                break;
            case 4:
                break;

        }


    } while (option != 0 && !ganar);
}

function ganarJuego() {
    if (inventario.includes("Tesoro")) {
        ganar = true;
        let itemFinal = "TESORO";
        console.log(`¡Has CONSEGUIDO el ${itemFinal} y ¿"ganado"?`);
    }
}

function recojer() {
    if (posicion != 2 || vuelta == 4) {
        switch (vuelta) {
            case 0:
                if (posicion == 0) {
                    if (inventario.includes("kit de costura")) {
                        inventario.push(primeroObjetos[posicion]);
                        primeroObjetos[posicion] = "";
                    } else {
                        console.log(`Necesitas ${primeroObjetos[1]}`)
                    }
                }
                else {
                    inventario.push(primeroObjetos[posicion]);
                    primeroObjetos[posicion] = "";
                }
                break;
            case 1:
                if (posicion == 0) {
                    if (inventario.includes("Escalpelo")) {
                        inventario.push(segundosObjetos[posicion]);
                        segundosObjetos[posicion] = "";
                    } else {
                        console.log(`Necesitas ${segundosObjetos[1]}`)
                    }
                }
                else {
                    inventario.push(segundosObjetos[posicion]);
                    segundosObjetos[posicion] = "";
                }
                break;
            case 2:
                if (posicion == 0) {
                    if (inventario.includes("Escalera")) {
                        inventario.push(tercerosObjetos[posicion]);
                        tercerosObjetos[posicion] = "";
                    } else {
                        console.log(`Necesitas ${tercerosObjetos[1]}`)
                    }
                }
                else {
                    inventario.push(tercerosObjetos[posicion]);
                    tercerosObjetos[posicion] = "";
                }

                break;
            case 3:
                if (posicion == 0) {
                    if (inventario.includes("Guantes")) {
                        inventario.push(cuartosObjetos[posicion]);
                        cuartosObjetos[posicion] = "";
                    } else {
                        console.log(`Necesitas ${cuartosObjetos[1]}`)
                    }
                }
                else {
                    inventario.push(cuartosObjetos[posicion]);
                    cuartosObjetos[posicion] = "";
                }
                inventario.push(cuartosObjetos[posicion]);
                cuartosObjetos[posicion] = "";
                break;
            case 4:
                if (posicion == 0) {
                    if (inventario.includes("Tijeras")) {
                        inventario.push(ultimosObjetos[posicion]);
                        ultimosObjetos[posicion] = "";
                    } else {
                        console.log(`Necesitas ${ultimosObjetos[1]}`)
                    }
                }
                else {
                    inventario.push(ultimosObjetos[posicion]);
                    ultimosObjetos[posicion] = "";
                }

                break;
        }
    } 
    ganarJuego();
}
function Avanzar() {
    if (posicion + 1 < 3) {
        if (posicion + 1 == 2) {
            if (inventario.includes("LLave")) {
                posicion++;
            }
            else {
                console.log("La puerta te impide el paso")
            }
        }
        else {
            posicion++;
        }
    }
    else {
        console.log("Un sueño inaudito cae sobre ti mismo")
        siguienteBucle();
    }
}
function Retroceder() {
    if (posicion - 1 >= 0) {
        posicion--;
    }
    else {
        console.log("No se puede retroceder mas");
    }
}
function description() {

    switch (vuelta) {
        case 0:
            console.log(`Estas en "${PRIMERASSALAS[posicion]}"`);
            console.log(PRIMERADESCRIPCION[posicion]);
            console.log(primeroObjetos[posicion] != "" ? primeroObjetos[posicion] : "no hay objetos");
            break;
        case 1:
            console.log(`Estas en "${SEGUNDASSALAS[posicion]}"`);
            console.log(SEGUNDADESCRIPCION[posicion]);
            console.log(segundosObjetos[posicion] != "" ? segundosObjetos[posicion] : "no hay objetos");
            break;
        case 2:
            console.log(`Estas en "${TERCERASSALAS[posicion]}"`);
            console.log(TERCERADESCRIPCION[posicion]);
            console.log(tercerosObjetos[posicion] != "" ? tercerosObjetos[posicion] : "no hay objetos");
            break;
        case 3:
            console.log(`Estas en "${CUARTASSALAS[posicion]}"`);
            console.log(CUATADESCRIPCION[posicion]);
            console.log(cuartosObjetos[posicion] != "" ? cuartosObjetos[posicion] : "no hay objetos");
            break;
        case 4:
            console.log(`Estas en "${ULTIMASSALAS[posicion]}"`);
            console.log(ULTIMADESCRIPCION[posicion]);
            console.log(ultimosObjetos[posicion] != "" ? ultimosObjetos[posicion] : "no hay objetos");
            break;
    }
}
function getPosicion() {
    return posicion;
}
function siguienteBucle() {
    inventario = [];
    posicion = 0;
    vuelta++;
}