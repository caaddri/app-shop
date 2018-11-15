<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Nuevo pedido</title>
  </head>
  <body>
    <p>Se ha realizado un nuevo pedido!</p>
    <p>Estos son los datos del cliente que realizo el pedido:</p>
    <ul>
      <li>
        <strong>Nombre:</strong>
        {{ $user->name }}
      </li>
      <li>
        <strong>E-mail:</strong>
        {{ $user->email }}
      </li>
      <li>
        <strong>Fecha del pedido</strong>
        {{ $cart->order_date }}
      </li>
    </ul>

    <hr>
    <p>Detalles del pedido:</p>
    <ul>
      @foreach ($cart->details as $detail)
      <li>
        {{ $detail->product->name }} x {{ $detail->quantity }} ($ {{ $detail->quantity * $detail->product->price }} )
      </li>
      @endforeach
    </ul>
    <p>
      <strong>Importe a pagar: </strong> {{ $cart->total }}
    </p>
    <hr>

    <p>
      <a href="{{ url('/admin/orders/'.$cart->id) }}">Haz click aquí</a>
      para ver mas información sobre este pedido.
    </p>
  </body>
</html>
