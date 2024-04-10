<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Notificación</title>
</head>
<body>
    <p>Buen día,</p>
    <p>Estos son los datos del usuario:</p>
    <ul>
        <li>Nombre: {{ $notification->name }}</li>
        <li>Correo: {{ $notification->email }}</li>
        <li>Teléfono: {{ $notification->phone }}</li>
        <li>Lenguaje de programación: {{ $notification->language }}</li>
        <li>Fecha de Creación: {{ $notification->created_at }}</li>
        <li>Fecha de Actualización: {{ $notification->updated_at }}</li>
    </ul>
    <p>Saludos.</p>
</body>
</html>