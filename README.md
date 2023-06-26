# vueTest

Este proyecto fue desarrollado en Vue 3 para el front-end, y Laravel 8 como API para el back-end

## Recomendaciones para correr el Larvel Api

1. tener instalado composer para el manejo de dependencias
2. Dentro del directiorio del api correr

```
composer install
```

Para descargar las librerias necesarias

3. Para correr el servidor local

```
php artisan serve
```

4. Motor de base de datos mysql, crear una base de dato con el nombre store_people.

5. Para crear las tablas en la base de datos, con información de prueba

```
php artisan migrate:fresh --seed
```

## Customize configuration

See [Vite Configuration Reference](https://vitejs.dev/config/).

## Project Setup

```sh
npm install
```

### Compile and Hot-Reload for Development

```sh
npm run dev
```

### Compile and Minify for Production

```sh
npm run build
```
