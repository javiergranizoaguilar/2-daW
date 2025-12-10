# 📚 EXAMEN FINAL DE TEORÍA - DWES 2025
## Temas 2, 3 y 4 - PHP 8.4, Base de Datos y POO

| **Información del Examen** |                          |
|---------------------------|--------------------------|
| **Valor** | 75% de la nota final     |
| **Duración** | 2 horas (teoría + práctica) |
| **Parte Teoría** | 50 puntos                |
| **Material permitido** | ❌ SIN APUNTES            |
| **Fecha** | ____4__Diciembre________ |

---

| **Alumno/a** |                                                  |
|-------------|--------------------------------------------------|
| **Nombre** | ___________Javier_____________________           |
| **Apellidos** | _______Granizo_Aguilar__________________________ |

---

# PARTE A: TEST (20 puntos - 1 punto cada pregunta)
### Marca con una X la respuesta correcta

---

## TEMA 2: PHP 8.4 Básico

### 1. ¿Cuál es la forma correcta de declarar una variable en PHP?
- [ ] a) `var $nombre = "Juan";`
- [x] b) `$nombre = "Juan";`
- [ ] c) `let nombre = "Juan";`
- [ ] d) `nombre := "Juan";`

### 2. ¿Qué tipo de dato devuelve la expresión `3 / 2` en PHP?
- [ ] a) `int`
- [x] b) `float`
- [ ] c) `string`
- [ ] d) `double`

### 3. ¿Cuál es la diferencia entre `==` y `===` en PHP?
- [ ] a) No hay diferencia, son equivalentes
- [ ] b) `==` compara valor y tipo, `===` solo valor
- [x] c) `===` compara valor y tipo, `==` solo valor
- [ ] d) `===` es para strings, `==` para números

### 4. ¿Qué función se usa para obtener la longitud de un array en PHP?
- [ ] a) `length($array)`
- [ ] b) `size($array)`
- [x] c) `count($array)`
- [ ] d) `len($array)`

### 5. ¿Cuál es la sintaxis correcta de la expresión `match` en PHP 8.4?
- [ ] a) `match($x) { 1: "uno", 2: "dos" }`
- [x] b) `match($x) { 1 => "uno", 2 => "dos" }`
- [ ] c) `match $x { case 1: "uno"; case 2: "dos"; }`
- [ ] d) `match($x) { when 1 then "uno", when 2 then "dos" }`

### 6. ¿Qué valor devuelve `isset($variable)` si `$variable = null`?
- [x] a) `true`
- [ ] b) `false`
- [ ] c) `null`
- [ ] d) Error de sintaxis

### 7. ¿Cuál es la forma correcta de concatenar strings en PHP?
- [ ] a) `$a + $b`
- [x] b) `$a . $b`
- [ ] c) `$a & $b`
- [ ] d) `concat($a, $b)`

---

## TEMA 3: Acceso a Base de Datos

### 8. ¿Qué significa PDO en PHP?
- [ ] a) PHP Data Object
- [ ] b) PHP Database Operations
- [ ] c) PHP Data Objects
- [x] d) Personal Database Objects

### 9. ¿Cuál es el modo de error recomendado para PDO en producción?
- [ ] a) `PDO::ERRMODE_SILENT`
- [ ] b) `PDO::ERRMODE_WARNING`
- [ ] c) `PDO::ERRMODE_EXCEPTION`
- [x] d) `PDO::ERRMODE_DEBUG`

### 10. ¿Qué método de PDO se usa para obtener el ID del último registro insertado?
- [x] a) `getLastId()`
- [ ] b) `insertId()`
- [ ] c) `lastInsertId()`
- [ ] d) `getInsertedId()`

### 11. ¿Cuál es la principal ventaja de usar prepared statements?
- [ ] a) Son más rápidos
- [x] b) Previenen SQL Injection
- [ ] c) Usan menos memoria
- [ ] d) Son más fáciles de escribir

### 12. ¿Qué método se usa para obtener todos los resultados de una consulta SELECT?
- [ ] a) `fetch()`
- [x] b) `fetchAll()`
- [ ] c) `getAll()`
- [ ] d) `selectAll()`

### 13. ¿Qué operación SQL se usa en una relación 1:N para unir tablas?
- [ ] a) `MERGE`
- [ ] b) `UNION`
- [x] c) `JOIN`
- [ ] d) `CONCAT`

### 14. ¿Cuál es el propósito de `$pdo->beginTransaction()`?
- [ ] a) Iniciar una nueva conexión
- [x] b) Iniciar un grupo de operaciones que se ejecutan como unidad
- [ ] c) Resetear la base de datos
- [ ] d) Crear una nueva tabla

---

## TEMA 4: Clases y Herencia (POO)

### 15. ¿Cuál es la visibilidad por defecto de una propiedad en PHP si no se especifica?
- [ ] a) `private`
- [ ] b) `protected`
- [x] c) `public`
- [ ] d) Error de sintaxis (debe especificarse)

### 16. ¿Qué palabra clave se usa para heredar de una clase en PHP?
- [ ] a) `inherits`
- [x] b) `extends`
- [ ] c) `implements`
- [ ] d) `derives`

### 17. ¿Cuál es la diferencia entre una clase abstracta y una interfaz?
- [ ] a) No hay diferencia
- [x] b) Una clase abstracta puede tener implementación, una interfaz no (antes de PHP 8)
- [ ] c) Una interfaz puede tener propiedades, una clase abstracta no
- [ ] d) Solo se puede heredar de interfaces

### 18. ¿Qué son los Property Hooks en PHP 8.4?
- [x] a) Funciones para validar propiedades al asignarlas o accederlas
- [ ] b) Eventos que se disparan al crear objetos
- [ ] c) Decoradores de métodos
- [ ] d) Macros de preprocesamiento

### 19. ¿Cuál es la sintaxis correcta para Asymmetric Visibility en PHP 8.4?
- [ ] a) `public(get) private(set) string $nombre`
- [x] b) `public private(set) string $nombre`
- [ ] c) `get:public set:private string $nombre`
- [ ] d) `@visibility(public, private) string $nombre`

### 20. ¿Para qué sirven los Traits en PHP?
- [ ] a) Para crear interfaces múltiples
- [x] b) Para reutilizar código entre clases no relacionadas por herencia
- [ ] c) Para definir constantes globales
- [ ] d) Para crear variables estáticas

---

# PARTE B: PREGUNTAS CORTAS (15 puntos - 3 puntos cada una)

### 21. Explica la diferencia entre `include` y `require` en PHP. ¿Cuándo usarías cada uno?

```
El include añade el codigo sin pararse a mirar si carga bien o no, por lo que si lo añades 

pero no se hace bien no da error________________________________________

En cambio el require si no se carga o no da bien da un error_____________

Usaria el include cuando no importe si esta cargado o no y el required cuando sea obligatorio para el funcionamineto

_______________________________________________________________________________
```

### 22. ¿Qué es "Soft Delete" en base de datos? Escribe un ejemplo de consulta SQL que lo implemente.

```
___Es cuando en vez de borrar directamente de la Base de datos creas una columna la cual indica si a sido borrado o no 

___SELECT * FROM casas WHERE casas.borrado==true____________________________________________________________________________

_______________________________________________________________________________

_______________________________________________________________________________
```

### 23. Explica qué es una transacción en base de datos y para qué sirven los métodos `commit()` y `rollBack()`.

```
___Una transaccion es cuando hace una o mas consultas sql a una base de datos reciviendo, 

añadiendo, borrando o cambiando algo de esta base de datos_________________________________

___El commit() es un metodo que asegura que los cambios que as echo se guarden en una base de datos_______

___El rollBack() es la contraparte de el commit(), este debuelve a su estado 

original(antes de comenzar la transaccion) la base de datos_____________________

_______________________________________________________________________________
```

### 24. ¿Cuál es la diferencia entre `public`, `private` y `protected` en POO? Pon un ejemplo de cuándo usarías cada uno.

```
_____Public= todo el mundo tiene acceso a el metodo o variable que lo tenga,=> 

usado para cosas que quiero poder usar en programas externos__________________________________________________________________________

_____Private= solo se permite su uso en la misma clase,=>

lo usaria para cosas como Id autogenerados que no quero que los progrmas los cambien o modifiquen__________________________________________________________________________

_____Protected= es posible cambiar atrabes de otros metodos,=>

cambios que solo quireon que sean cambiados de maneras especificas o que se haccedan a ellos en partes especificas__________________________________________________________________________

```

### 25. Explica qué es el operador nullsafe (`?->`) en PHP 8.4 y pon un ejemplo de su uso.

```
__Nos permite hhacer que si algo esta null ease vacio darle un valor especifico
_______________________________________________________________________________

_______________________________________________________________________________

_______________________________________________________________________________
```

---

# PARTE C: CÓDIGO Y ANÁLISIS (15 puntos - 5 puntos cada pregunta)

### 26. Analiza el siguiente código e indica qué errores tiene y cómo los corregirías:

```php
<?php
class Producto {
    public $nombre;
    private $precio;
    
    public function __construct($nombre, $precio) {
        $this->nombre = $nombre;
        $this->precio = $precio;
    }
    
    private function getPrecio() {
        return $this->precio;
    }
}

$p = new Producto("Manzana", 2.50);
echo $p->getPrecio();
?>
```

**Errores encontrados y correcciones:**
```
De base $precio es privado al crear un metodo privado que te debuelbe este mismo 

no podra ser usado fuera provocando que este sea inutil , yo cambiaria el private 

por un public haciendolo acceible

```

---

### 27. Escribe el código PHP para conectar a una base de datos MySQL llamada "tienda" con las siguientes características:
- Host: localhost
- Puerto: 3306
- Usuario: admin
- Contraseña: secret123
- Debe configurarse para lanzar excepciones en caso de error

```php
<?php
// Escribe tu código aquí:


try {
    $pdo=new PDO("Mysql;Host:127.0.0.1;Port:3306","admin","secret123");
 }catch(PDOException $e){
    echo $e->getMessage();
 }






?>
```

---

### 28. Dado el siguiente diagrama de clases, escribe la declaración de la clase `Empleado` en PHP 8.4 usando Property Hooks:

```
┌─────────────────────────────┐
│         Empleado            │
├─────────────────────────────┤
│ - nombre: string            │
│ - salario: float (≥ 1000)   │
│ - email: string             │
├─────────────────────────────┤
│ + getNombreCompleto()       │
│ + subirSalario(porcentaje)  │
└─────────────────────────────┘
```

**Requisitos:**
- El salario mínimo es 1000 (validar al asignar)
- El nombre debe guardarse en mayúsculas
- El email es de solo lectura después de crearse

```php
<?php
// Escribe tu código aquí:

class Empleado {
    public string $nombre{
    set=>$this->nombre= str_lower($value)
    }
    public float $salario{
    set=>$salario<1000?new throw(Exception):$this->salario=$value
    }
    private(set) string $email;
    function getNombreCompleto():string {
    return this->nombre;
}
}











?>
```

---

# PARTE D: TEORÍA CONCEPTUAL (10 puntos)

### 29. (5 puntos) Explica los tipos de relaciones en Base de Datos (1:1, 1:N, N:M) con ejemplos del mundo real:

```
ONE-TO-ONE (1:1):

______relacion entre tablas la cual nos permite hacer relaciones de una tabla a otra solo si ese dato no tiene mas relaciones_________________________________________________________________________

Ejemplo: _________una perosna solo puede tener un banco___________________________________________________________

ONE-TO-MANY (1:N):
____________relacion entre tablas la cual nos permite hacer relaciones entre todos los datos limitando a que una a 

de las partes relacionadas solo pueden tener una relacion o no se pueden relaciona mas con el___________________________________________________________________




Ejemplo: _______una persona puede tener muchos perros_____________________________________________________________

MANY-TO-MANY (N:M):
___________relacion entre tablas la cual nos permite hacer relaciones entre todos los datos____________________________________________________________________

_______________________________________________________________________________

Ejemplo: __________mucho humanos pueden tener muchos coches y muchos coche pueden tener muchos humanos__________________________________________________________
```

---

### 30. (5 puntos) Explica las diferencias entre **Clase Abstracta**, **Interface** y **Trait** en PHP. ¿Cuándo usarías cada uno?

```
CLASE ABSTRACTA:
¿Qué es? _____por asi decirlo es una plantilla para poder hacer las clases___________________________________________________________________

¿Cuándo usarla? ________class hola extends (Clase abstracta)_________________________________________________________

INTERFACE:
¿Qué es? __________nos permite crear una "guia " la cual nos indica las cosas que deve tener nuestra clase______________________________________________________________

¿Cuándo usarla? ________class hola implement (interface)_________________________________________________________

TRAIT:
¿Qué es? ________________________________________________________________________

¿Cuándo usarlo? _________________________________________________________________

¿Puede una clase usar los tres a la vez? Explica: _______Si deveriua ya que ninguno se solapa

y al inicializarse de manera distinta tanboco abra problemas de redirecion__________________________

```

---

## 📊 TABLA DE PUNTUACIÓN

| Parte | Puntos Máximos | Puntos Obtenidos |
|-------|----------------|------------------|
| A - Test | 20 | |
| B - Preguntas Cortas | 15 | |
| C - Código y Análisis | 15 | |
| D - Teoría Conceptual | 10 | |
| **TOTAL TEORÍA** | **50** | |

---

> ⏰ **Recuerda:** Esta es solo la parte teórica. Después continuarás con la parte práctica donde SÍ podrás usar apuntes.
