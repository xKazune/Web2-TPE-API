## API VIDEOJUEGOS

#### /api/videojuegos

Metodo **GET**:

Opciones:

| Opcion  | Valores                                   | Accion                                  |
| ------- | ----------------------------------------- | --------------------------------------- |
| orderBy | titulo, genero, idVidejuego, idPlataforma | Filtra por lo indicado                  |
| order   | asc, desc                                 | Ordena de forma ascendete o descendente |

#### /api/videojuegos/:id

Podemos obtener cualquier juego que exista.

Metodo **POST**:

#### /api/videojuegos

Agregamos un nuevo juego a la base de datos.

Metodo **PUT**:

#### /api/videojuegos/:id

Modificamos (si existe el juego) todos los datos del juego.

Metodo **DELETE**:

#### /api/videojuegos/:id

Borramos (si existe el juego) el juego que queramos.

## API PLATAFORMAS

- Cambia los valores por el cual podemos ordenar, ahora pasan a ser:
    - idPlataforma
    - nombrePlataforma
    - fabricante
    - tipo

- Despues podemos realizar las mismas acciones que videojuegos, cambiando la URL a

#### /api/plataformas 
o 
#### /api/plataformas/:id

