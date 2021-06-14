<!doctype html>
<html lang="ptBR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vendedores</title>
</head>
<body>


    <form name="frm_vendedores" method="post" action="{{   URL::to('/')   }}/app/vendedores">
        <table id="filters" well>
            <tr>
                <th>Vendedor</th>
                <th>CPF</th>
            </tr>
            <tr>
                <td><input type="text" name="nomevendedor" id="filter_nomevendedor" value=""></td>
                <td>
                    <input type="text" name="cpfvendedor" id="filter_cpfvendedor" value="">
                </td>
                <td><button name="acao" value="filtros">Buscar</button></td>
            </tr>
        </table>
    </form>
    <br>
    <table id="tableVedendor">
        <tr>
            <th>Vendedor</th>
            <th>CPF</th>
        </tr>
        @if(empty($vendedores))
        <td>-</td>
        <td>-</td>
        <td>-</td>
        @else
            @foreach($vendedores as $key => $value)
            <form name="frm_produtos" method="post">
                <tr>
                    <td>
                        <input type="text" name="nomevendedor" id="nomevendedor" value="{{ $value->nomevendedor }}" required>
                    </td>
                    <td>
                        <input type="text" name="cpfvendedor" id="cpfvendedor" value="{{  $value->cpfvendedor }}" required>
                    </td>
                    <td>
                        <input type="hidden" name="idvendedor" name="idvendedor" value="{{ $value->idvendedor }}">
                        <button name="acao" value="editar">Editar</button><button name="acao" value="deletar">deletar</button>
                    </td>
                </tr>
            </form>
            @endforeach
        @endif
    </table>
    </form>
    <br>
    <form name="frm_vendedores_novos" method="post" action="{{   URL::to('/')   }}/app/vendedores">
        <div>
            <h2>Adicionar Novo Vendedor:</h2>
            <input type="text" placeholder="Vendedor" name="nomevendedor" id="novo_nomevendedor" required="">
            <input type="text" placeholder="CPF" name="cpfvendedor" id="novo_cpfvendedor"  required="">
        </div>
        <button value="novo" name="acao">Adicionar Novo</button>
    </form>



</body>
</html>