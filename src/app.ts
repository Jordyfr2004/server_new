import * as readline from 'readline';
//ingresar el comando en la terminal para ejecutar      npm run dev

interface Votante {
  nombre: string;
  cedula: string;
  voto?: string | "Blanco" | "Nulo";
}

type TipoEleccion = "Presidencial" | "Estudiantil" | "Municipal" | "Otra";

interface Candidato {
  nombre: string;
  votos: number;
}

interface Eleccion {
  nombre: string;
  tipo: TipoEleccion;
  votosValidos: number;
  votosNulos: number;
  votosBlanco: number;
  candidatos: Candidato[];
  votantes: Votante[];
}

const elecciones: Eleccion[] = [
  {
    nombre: "Elección Municipal Ciudad Y",
    tipo: "Municipal",
    votosValidos: 2,
    votosNulos: 0,
    votosBlanco: 1,
    candidatos: [
      { nombre: "Candidato 1", votos: 1 },
      { nombre: "Candidato 2", votos: 1 }
    ],
    votantes: [
      { nombre: "Miguel", cedula: "123", voto: "Candidato Municipal 1" },
      { nombre: "Laura", cedula: "456", voto: "Candidato Municipal 2" },
      { nombre: "Paula", cedula: "987", voto: "Blanco" }
    ]
  },
  {
    nombre: "Elección Estudiantil Universidad",
    tipo: "Estudiantil",
    votosValidos: 6,
    votosNulos: 1,
    votosBlanco: 1,
    candidatos: [
      { nombre: "Candidato 1", votos: 5 },
      { nombre: "Candidato 2", votos: 1 }
    ],
    votantes: [
      { nombre: "Carlos", cedula: "789", voto: "Estudiante 1" },
      { nombre: "Ana", cedula: "321", voto: "Estudiante 2" },
      { nombre: "Luis", cedula: "654", voto: "Nulo" },
      { nombre: "Paula", cedula: "987", voto: "Blanco" },
      { nombre: "David", cedula: "111", voto: "Estudiante 1" },
      { nombre: "Maria", cedula: "222", voto: "Estudiante 1" },
      { nombre: "Daniela", cedula: "333", voto: "Estudiante 1" },
      { nombre: "Karla", cedula: "444", voto: "Estudiante 1" }
    ]
  }
];

const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

rl.question("Ingrese su nombre: ", (nombre) => {
  rl.question("Ingrese su cédula: ", (cedula) => {
    const eleccionesVotadas = elecciones.filter(eleccion =>
      eleccion.votantes.some(v => v.nombre === nombre && v.cedula === cedula)
    );

    if (eleccionesVotadas.length > 0) {
      console.log("\nUsted ya sufragó. Ver resultados:");

      eleccionesVotadas.forEach((eleccion, index) => {
        console.log(`${index + 1}. ${eleccion.nombre}`);
      });

      rl.question("\nSeleccione el número de la elección para ver detalles: ", (input) => {
        const opcion = parseInt(input);
        const seleccionada = eleccionesVotadas[opcion - 1];

        if (seleccionada) {
          console.log(`\nResultado de ${seleccionada.nombre}:`);
          seleccionada.candidatos.forEach(c => {
            console.log(`- ${c.nombre}: ${c.votos} votos`);
          });
          console.log(`Votos en blanco: ${seleccionada.votosBlanco}`);
          console.log(`Votos nulos: ${seleccionada.votosNulos}`);
        } else {
          console.log("Opción inválida.");
        }
        rl.close();
      });

    } else {
      console.log("Usted no ha votado aún.");
      rl.close();
    }
  });
});
