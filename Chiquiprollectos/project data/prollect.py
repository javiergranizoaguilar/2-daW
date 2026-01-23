import urllib.request
import json
import time

# URL base donde están todos los datos
BASE_URL = "https://raw.githubusercontent.com/5etools-mirror-1/5etools-mirror-1.github.io/master/data/bestiary/"

def obtener_todos_los_monstruos():
    todos_los_monstruos = []
    
    print("1️⃣  Descargando el índice maestro de libros...")
    # Descargamos el index.json que tiene la lista de todos los archivos
    with urllib.request.urlopen(BASE_URL + "index.json") as url:
        indice = json.load(url)
    
    # El índice es un diccionario. Los valores son los nombres de los archivos (ej: "bestiary-mm.json")
    archivos_libros = list(indice.values())
    total_libros = len(archivos_libros)
    
    print(f"📚 Se han encontrado {total_libros} libros/fuentes de monstruos. Iniciando descarga...")

    # Bucle para descargar cada archivo y extraer los monstruos
    for i, archivo in enumerate(archivos_libros):
        try:
            print(f"[{i+1}/{total_libros}] Descargando: {archivo}...")
            with urllib.request.urlopen(BASE_URL + archivo) as url:
                datos_libro = json.load(url)
                
                # Añadimos los monstruos de este libro a nuestra lista gigante
                if 'monster' in datos_libro:
                    todos_los_monstruos.extend(datos_libro['monster'])
            
            # Pequeña pausa para no saturar el servidor
            time.sleep(0.1) 
            
        except Exception as e:
            print(f"⚠️ Error al descargar {archivo}: {e}")

    # Guardamos todo en un único archivo JSON en tu ordenador
    print(f"\n✅ ¡Éxito! Se han descargado {len(todos_los_monstruos)} monstruos en total.")
    
    with open("todos_los_monstruos.json", "w", encoding="utf-8") as f:
        json.dump(todos_los_monstruos, f, ensure_ascii=False, indent=2)
        
    print("💾 Guardado en: 'todos_los_monstruos.json'")

# Ejecutar la función
obtener_todos_los_monstruos()