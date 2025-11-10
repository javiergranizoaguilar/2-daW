'use strict'
function Eje5() {
    let colors = ['red', 'yellow', 'green', 'white', 'blue', 'brown', 'pink', 'black'];
    let usu = [];
    let usuOrdenCd = [];
    let usuOrdenC = [];
    let usuOrdenN = [];
    let verdad = false;
    for (let x = 0; x < 8; x++) {
        usu[x] = prompt("Dame una palabra")
    }
    usu.forEach(word => {
        verdad = false
        colors.forEach(colord => {
            if (colord == word) {
                verdad = true;
            }
        })
        if (verdad) {
            usuOrdenCd.push(word);
        } else {
            usuOrdenN.push(word)
        }
    });
    colors.forEach(color => {
        usuOrdenCd.forEach(desorden => {
            if (color == desorden) {
                usuOrdenC.push(desorden);
            }
        })
    })
    console.log(usuOrdenC.concat(usuOrdenN));
}