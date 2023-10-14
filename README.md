# API para Imprimir desde Internet a Local con PHP

## Descripción

Este proyecto proporciona una API en PHP que te permite imprimir documentos desde una ubicación remota a una impresora en tu red local. Para utilizar esta API, necesitas configurar un certificado SSL local para una IP estática, lo cual es un requisito fundamental para la seguridad y el funcionamiento adecuado de la impresión remota.

## Instrucciones

### Configuración del Certificado SSL Local

Antes de utilizar esta API, asegúrate de haber configurado un certificado SSL local para una IP estática en tu entorno de desarrollo. Puedes seguir los pasos recomendados en el siguiente enlace para generar certificados HTTPS para desarrollo local sin errores:

[Instrucciones para Generar Certificados HTTPS Locales](https://www.jasoft.org/Blog/post/como-generar-certificados-https-para-desarrollo-local-que-no-produzcan-errores)

Asegúrate de que tu entorno de desarrollo esté configurado correctamente con el certificado SSL antes de continuar con la utilización de la API.

### Uso de la API

Una vez que hayas configurado el certificado SSL local y copiado el contenido de este repositorio en la carpeta "print" de tu servidor local (por ejemplo, en XAMPP), puedes hacer un test de impresión ingresando a la siguiente dirección:

[https://print.incloud.pe/](https://print.incloud.pe/)

Sigue las instrucciones en esa dirección para realizar una prueba de impresión.

## Contribuciones

Agradecemos las contribuciones para mejorar este proyecto. Si deseas contribuir, sigue los pasos de contribución en el archivo `CONTRIBUTING.md`.

## Problemas

Si encuentras algún problema o tienes sugerencias, crea un informe de problemas en la sección de problemas del repositorio.

## Licencia

Este proyecto está bajo la Licencia MIT. Consulta el archivo `LICENSE` para obtener más detalles.

¡Gracias por utilizar esta API y disfruta de la impresión remota segura!
