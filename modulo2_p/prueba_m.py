#ingresar el comando en la terminal para ejecutar      python prueba.py

import asyncio
from typing import List, Dict, Callable

class Eleccion:
    def __init__(self, nombre: str, tipo: str, fecha_inicio: str, fecha_fin: str,
                 candidatos: List[Dict], votantes: List[Dict]):
        self.nombre = nombre
        self.tipo = tipo
        self.fecha_inicio = fecha_inicio
        self.fecha_fin = fecha_fin
        self.candidatos = candidatos
        self.votantes = votantes

# Arreglo de elecciones (arreglo de objetos)
elecciones: List[Eleccion] = [
    Eleccion(
        "Elección Presidencial 2025",
        "Presidencial",
        "2025-06-01",
        "2025-06-05",
        candidatos=[
            {"nombre": "Juan Pérez", "lista": "Lista 35"},
            {"nombre": "Ana Gómez", "lista": "Lista Social 15"},
        ],
        votantes=[
            {"nombre": "Mario", "cedula": "123456"},
            {"nombre": "Lucía", "cedula": "654321"},
            {"nombre": "Miguel", "cedula": "112233"},
        ]
    ),
    Eleccion(
        "Elección Estudiantil 2025",
        "Estudiantil",
        "2025-05-10",
        "2025-05-12",
        candidatos=[
            {"nombre": "Laura Ríos", "lista": "Lista Universitaria 1"},
            {"nombre": "David León", "lista": "Lista Estudiantil 2"},
        ],
        votantes=[
            {"nombre": "Miguel", "cedula": "112233"},
            {"nombre": "Valentina", "cedula": "445566"},
        ]
    )
]

# Función para verificar votante (callback)
def verificar_votante(nombre: str, cedula: str, callback: Callable):
    habilitado_en = []
    for eleccion in elecciones:
        for v in eleccion.votantes:
            if v["nombre"].lower() == nombre.lower() and v["cedula"] == cedula:
                habilitado_en.append(eleccion)
                break
    callback(habilitado_en)

# Función async simulando sufragio
async def realizar_sufragio(candidato: Dict):
    print(f"\nRegistrando voto...")
    await asyncio.sleep(2)  # Simula retardo de proceso
    print("sufragio exitoso")

# Función principal
def main():
    nombre = input("Ingrese su nombre: ").strip()
    cedula = input("Ingrese su cédula: ").strip()

    def continuar_con_elecciones(elecciones_disponibles: List[Eleccion]):
        if not elecciones_disponibles:
            print("no está habilitado para votar")
            return

        print("\nusted está habilitado para votar")
        for idx, eleccion in enumerate(elecciones_disponibles, start=1):
            print(f"{idx}. {eleccion.nombre}")

        try:
            seleccion = int(input("Seleccione una elección (número): ")) - 1
            if 0 <= seleccion < len(elecciones_disponibles):
                eleccion_sel = elecciones_disponibles[seleccion]
                print(f"\nCandidatos en {eleccion_sel.nombre}:")
                for idx, c in enumerate(eleccion_sel.candidatos, start=1):
                    print(f"{idx}. {c['nombre']} ({c['lista']})")

                candidato_sel = int(input("Seleccione un candidato (número): ")) - 1
                if 0 <= candidato_sel < len(eleccion_sel.candidatos):
                    candidato = eleccion_sel.candidatos[candidato_sel]
                    asyncio.run(realizar_sufragio(candidato))  # Llama async desde sync
                else:
                    print("Opción de candidato inválida.")
            else:
                print("Opción de elección inválida.")
        except ValueError:
            print("Debe ingresar un número.")

    # Callback con función como parámetro
    verificar_votante(nombre, cedula, continuar_con_elecciones)

# Ejecutar programa
main()