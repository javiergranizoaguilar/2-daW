'use strict'
function Eje7() {
    let numbers = [];
    let first = 0;
    let end = 0;
    for (let x = 0; x < 10; x++) {
        numbers.push(prompt("Dame el " + (x + 1) + "º numero"));
    }
    do {
        first = prompt("Dame la posicion Inicial");
        end = prompt("Dame la posicion Final");
    } while (first > end)



    printt(numbers, move(first, end, numbers));
}
function printt(t1, t2) {
    let table = "<h1>Array Inicial</h1><table border='1' style='border-collapse: collapse; width: 100%;'><tr>";

    for (let i = 0; i < t1.length; i++) {
        table += `<td>${i}</td>`;
    }
    table += "</tr> <tr>";
    for (let i = 0; i < t1.length; i++) {
        table += `<td>${t1[i]}</td>`;
    }
    table += "</tr> </table>";
    table += "<h1>Array Final</h1> <table border='1' style='border-collapse: collapse; width: 100%;'><tr>";
    for (let i = 0; i < t2.length; i++) {
        table += `<td>${i}</td>`;
    }
    table += "</tr> <tr>";
    for (let i = 0; i < t2.length; i++) {
        table += `<td>${t2[i]}</td>`;
    }
    table += "</tr> </table>";
    document.writeln(table);
}
function move(f, e, num) {
    let num1=[...num];
    let aux = []
    for (let x = (parseInt(f) + 1); x < e; x++) {
        aux[x] = num1[x]
    }
    num1.unshift(num1[9]);
    for (let x = 0; x <= f; x++) {
        aux[x] = num1[x]
    }
    for (let x = e; x <= 9; x++) {
        aux[x] = num1[x]
    }
    aux[e] = num[f];
    return aux;
}
function move2(first, end, num) {
    let num1=[...num];
    let aux = []
    aux.push(num1[first]);
    aux.push(num1[end]);
    num1[first]=aux[1];
    num1[end]=aux[0];
}

// [0,1,2,3,4,5]
// inicial = 2 final = 4
// [0,1,4,3,2,5]