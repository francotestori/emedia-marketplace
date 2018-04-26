<?php
/**
 * Created by PhpStorm.
 * User: francotestori
 * Date: 6/11/17
 * Time: 0:27
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Messages Language Lines
    |--------------------------------------------------------------------------
    |
    |
    */

    'mail' => [
        'resetting' => 'Puedes restablecer tu contraseña de eMediaMarket',
        'link' => 'haciendo clic en el enlace de abajo:',
    ],

    'no_items_found' => 'No se encontraron items.',

    'created' => ':item fue creado exitosamente !',
    'edited' => ':item fue editado exitosamente !',
    'deleted' => ':item fue eliminado exitosamente !',
    'updated' => 'Actualizacion exitosa !',

    'forbidden' => 'No tienes permiso para acceder a este recurso!',

    'threads' => [
        'open' => 'Este hilo sigue pendiente.',
        'close' => 'Se cerro la operación por resultado ',
        'operation' => 'La operación finalizó',
        'ACCEPTED' => 'ACEPTADA',
        'REJECTED' => 'RECHAZADA',
        'USER_REJECTED' => 'RECHAZADA POR ANUNCIANTE',
    ],

    'messenger' => [
        'tuft' => 'Todos los mensajes enviados y recibidos',
        'empty' => 'No hay mensajes en tu inbox !',
        'new' => 'Agregar mensaje.',
        'accepting' => 'Al clickear aceptar se esta CONFIRMANDO esta transacción y el pago se acreditará al editor.',
        'rejecting' => 'Al rechazarla, la misma queda SUSPENDIDA y será revisada por nuestros administradores para determinar su resultado.',
    ],

    'transaction' => 'Tu transaccion fue exitosa!',

    'attributed' => 'La transaccion fue confirmada. Ahora podes visualizar tu balance actualizado!',

    'sales' => 'Ventas',
    'sales_subtitle' => 'Aca puedes visualizar tus ventas realizadas',

    'wallet' =>[
        'tuft' => 'Este es el listado de tus transacciones. Podrás retirar tu dinero aqui.',
    ],

    'addspaces' =>[
        'tuft' => 'Este es el listado de todas sus webs. Aquí puede crear nuevas y editar las existentes.',
        'deactivate' => 'Esta por desactivar',
        'confirm' => 'Por favor confirme.',
    ],

    'editor' =>[
        'tuft' => 'Este es su panel de Editor. Aqui puede enviar mensajes, crear y editar sus webs, revisar sus ventas y consultar su monedero',
    ],

    'advertiser' =>[
        'tuft' => 'Este es su panel de Anunciante. Aqui puede enviar mensajes, buscar webs, revisar sus compras y consultar su monedero',
    ],

    'filter' => 'Filtrar',

    'query' => 'Consulta de @:user relacionada a :url',

    'sender' => 'Emisor',
    'paypal_account' => 'Cuenta de Paypal',
    'cbu' => 'CBU',
    'alias' => 'Alias bancario',
    'amount' => 'Cantidad',

    'activated' => ':item fue activado !',
    'paused' => ':item fue pausado !',
    'closed' => ':item fue cerrado !',

    'rollbacked' => 'La transacción fue rechazada y está pendiente de revision por un administrador de EMarket.',

    'withdrawal' => [
        'accepted' => 'El retiro fue aceptado. Recorda enviar la transferencia!',
        'success' => 'Tu retiro de u$s :amount se solicito correctamente !',
        'failure' => 'Los retiros deben respetar los limites de EMarketplace (u$s :min - u$s :max). Tenes u$s :available disponibles para retirar.',
    ],

    'password' => [
        'unauthorized' => 'No tenes permisos para ejecutar esta acción !',
        'different' => 'La nueva contraseña tiene que ser distinta de la anterior.',
        'success' => 'La contraseña fue modificada con éxito !',
    ],

];
