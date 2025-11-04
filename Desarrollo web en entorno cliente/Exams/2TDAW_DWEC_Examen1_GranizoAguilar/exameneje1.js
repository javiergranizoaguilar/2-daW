const exameneje1 = () => {
    let response=0
    let previous="";
    for(let i; i<previous.length;i++){

    }
    do {
        response = parseInt(prompt("Que deseas hacer? \n 1.Cifrar \n 2.descifrar \n 3.Salir"));
        switch(response){
            case 1:
                previous=cifrar(prompt("Dame el conjuro").trim());
                console.log(previous);
                break;
            case 2:
                console.log(descifrar(previous))
            break;
            case 3:
                console.log("Hechizo terminado")
            break;
            default:
                console.log("Inserte un numero de opcion")
        }
    } while (response !== 3);
}
const cifrar=(spell)=>{
    let aux2="";
    spell=spell.replaceAll("A","^").replaceAll("E","%").replaceAll("I","&").replaceAll("O","#").replaceAll("U","@");
    let aux=spell.split(" ");
    for(let i=(aux.length-1); i>=0;i--){
        aux2+=aux[i]+" "
    }
    aux2=aux2.trim().replaceAll(" ","_");
    return aux2;
}
const descifrar=(spellCifrado)=>{
    let aux=spellCifrado.split("_");
    let aux2="";
    for(let i=(aux.length-1); i>=0;i--){
        aux2+=aux[i]+" "
    }
    return aux2.trim().replaceAll("^","A").replaceAll("%","E").replaceAll("&","I").replaceAll("#","O").replaceAll("@","U")
}