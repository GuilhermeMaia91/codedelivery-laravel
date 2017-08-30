@extends('app')

@section('content')
    <div class="container">
        <h3>Cupons</h3>
        <br>
        <a href="{{ route('admin.cupoms.create') }}" class="btn btn-default">Nova Cupom</a>
        <br><br>

        <table class="table table-bordered">
            <thead>
                <th>ID</th>
                <th>Código</th>
                <th>Valor</th>
                <th>Ação</th>
            </thead>
            <tbody>
                @foreach($cupoms as $cupom)
                    <tr>
                        <td>{{ $cupom->id }}</td>
                        <td>{{ $cupom->code }}</td>
                        <td>{{ $cupom->value }}</td>
                        <td>
                            <a href="{{route('admin.cupoms.edit', ['id' => $cupom->id])}}" class="btn btn-sm btn-default">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $cupoms->render() !!}
    </div>
@endsection