const persona = {
    nombre: "Jose Fernández García",
    edad: 27,
    peso: 82,
    altura: 180
}

formatos = {}
formatos.nombre = (nombre) => console.log(nombre.toUpperCase()); 
formatos.edad = (edad) => console.log(edad + "años"); 
formatos.peso = (peso) => console.log(peso + "kilos");
formatos.altura = (altura) => console.log(altura + "centimetros"); 

for(let propiedad in persona) { 
    formatos [propiedad] (persona [propiedad]);
}