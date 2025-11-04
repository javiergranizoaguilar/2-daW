const exameneje2 = () => {
    let response = 0;
    let heroes = [];
    do {
        response = parseInt(prompt("Que deseas hacer? \n 1.Nuevo \n 2.Listar \n 3.Buscar \n 4.Mision \n 5.Mejor \n 6.Salir"));
        switch (response) {
            case 1:
                heroes.push(nuevo());
                break;
            case 2:
                listar(heroes);
                break;
            case 3:
                buscar(heroes);
                break;
            case 4:
                mision(heroes);
                break;
            case 5:
                mejor(heroes)
                break;
            case 6:
                console.log("Fin del Programa")
                break;
            default:
                console.log("Inserte un numero de opcion")
        }
    } while (response !== 6);
}
const nuevo = () => {
    let name = prompt("Nombre");
    let clas = prompt("Clase");
    let kindomOrigin = prompt("Reino Origen");
    let heroe = {
        nombre: name,
        clase: clas,
        reino: kindomOrigin,
        misionesCompletadas: 0
    }
    return heroe;
}
const listar = (heroes) => {
    heroes.forEach(heroe => {
        console.log("Nombre: " + heroe.nombre + " Clase: " + heroe.clase + " Reino:" + heroe.reino + " Misiones completadas: " + heroe.misionesCompletadas);
    });
}
const buscar = (heroes) => {
    let name = prompt("Nombre de heroe");
    let heroesarrays = heroes.filter(heroe => {
        return heroe.nombre == name;
    });
    if (isNaN(heroesarrays)) {
        heroesarrays.forEach(heroe => {
            console.log("Nombre: " + heroe.nombre + " Clase: " + heroe.clase + " Reino:" + heroe.reino + " Misiones completadas: " + heroe.misionesCompletadas);
        })
    }
    else {
        console.log("Ningun heroe con este nombre");
    }
}
const mision = (heroes) => {
    let name = prompt("Nombre de heroe");
    let heroesarrays = heroes.filter(heroe => {
        return heroe.nombre == name;
    });
    if (isNaN(heroesarrays)) {
        heroesarrays.forEach(heroe => {
            heroe.misionesCompletadas++;
        })
    }
    else {
        console.log("Ningun heroe con este nombre");
    }
}
const mejor = (heroes) => {
    heroes.sort((a, b) => {
        return b.misionesCompletadas - a.misionesCompletadas;
    });
    console.log(heroes[0].misionesCompletadas);

    let heroesarrays = heroes.filter(heroe => {
        return heroe.misionesCompletadas == heroes[0].misionesCompletadas;
    });
    heroesarrays.forEach(heroe => {
        alert("Nombre: " + heroe.nombre + " Clase: " + heroe.clase + " Reino:" + heroe.reino + " Misiones completadas: " + heroe.misionesCompletadas);
    })
}