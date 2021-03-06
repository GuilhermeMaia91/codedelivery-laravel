@extends('app')

@section('content')
    <div class="container">
        <h3>Pedidos</h3>
        <br>
        <a href="{{ route('admin.orders.create') }}" class="btn btn-default">Novo Pedido</a>
        <br><br>

        <table class="table table-bordered">
            <thead>
                <th>ID</th>
                <th>Total</th>
                <th>Data</th>
                <th>Itens</th>
                <th>Entregador</th>
                <th>Status</th>
                <th>Ação</th>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->total }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>
                            <ul>
                            @foreach($order->items as $item)
                                <li>{{ $item->product->name }}</li>
                            @endforeach
                            </ul>
                        </td>
                        <td>
                            @if ($order->deliveryman)
                                {{ $order->deliveryman->name }}
                            @else
                                --
                            @endif
                        </td>
                        <td>
                            {{$order->status}}
                        </td>
                        <td>
                            <a href="{{route('admin.orders.edit', ['id' => $order->id])}}" class="btn btn-sm btn-default">Editar</a>
                            <a href="{{route('admin.orders.destroy', ['id' => $order->id])}}" class="btn btn-sm btn-default">Remover</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $orders->render() !!}
    </div>
@endsection