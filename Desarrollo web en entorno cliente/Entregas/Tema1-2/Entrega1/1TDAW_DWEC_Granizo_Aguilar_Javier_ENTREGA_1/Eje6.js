'use strict'
function Eje6() {
    let list1 = [1, 2, 2, 4, 4, "2", "ddd","f","f"];
    let list2 = [1,88,88,5, "ddd", "a"];
    let listend = [];
    comprovacionD(list1, list2).forEach(l => {
        listend.push(l);
    })

    console.log(comprovationItself(listend));
}
function comprovationItself(lend) {
    let verdad = false;
    let listf = []
    for (let x = 0; x < lend.length; x++) {
        verdad=false;
        for (let y = 0; y < lend.length; y++) {
            if (lend[x] == lend[y] && x != y) {
                verdad = true;
            }
        }
        if (!verdad) {
            listf.push(lend[x]);
        }
    }
    return listf;
}
function comprovacionD(l1, l2) {
    let verdad = false;
    let listf = []
    l1.forEach(word => {
        verdad = false
        l2.forEach(colord => {
            if (colord == word) {
                verdad = true;
            }
        })
        if (!verdad) {
            listf.push(word);
        }
    })
    l2.forEach(word => {
        verdad = false
        l1.forEach(colord => {
            if (colord == word) {
                verdad = true;
            }
        })
        if (!verdad) {
            listf.push(word);
        }
    })
    return listf;
}