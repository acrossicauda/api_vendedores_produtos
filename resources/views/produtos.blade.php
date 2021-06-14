<!doctype html>
<html lang="ptBR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produtos</title>
</head>
<body>


    <form name="frm_produtos" method="post" action="{{   URL::to('/')   }}/app/produtos">
        <table id="filters" well>
            <tr>
                <th>Produto</th>
                <th>Preço</th>
            </tr>
            <tr>
                <td><input type="text" name="nomeproduto" id="filter_nomeproduto" value=""></td>
                <td><button name="acao" value="filtros">Buscar</button></td>
            </tr>
        </table>
    </form>
    <br>
    <table id="tableVedendor">
        <tr>
            <th>Produtos</th>
            <th>Preço</th>
            <th>Vendedor</th>
        </tr>
        @if(empty($produtos))
            <td>-</td>
            <td>-</td>
            <td>-</td>
        @else
            @foreach($produtos as $key => $value)
                <form name="frm_produtos" method="post">
                    <tr>
                        <td>
                            <input type="text" name="nomeproduto" id="nomeproduto" value="{{ $value->nomeproduto }}" required>
                        </td>
                        <td>
                            <input type="text" name="preco" id="preco" value="{{  $value->preco }}" required>
                        </td>
                        <td>
                            <select name="idvendedor" id="idvendedor">
                                <option value="">-- VENDEDOR --</option>
                                @if(isset($vendedores) && !empty($vendedores))
                                    @foreach($vendedores as $k => $vend)
                                        <option value="{{  $vend->idvendedor   }}" <?=  ($vend->idvendedor == $value->idvendedor) ? 'selected' : ''  ?> >{{  $vend->nomevendedor   }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </td>
                        <td>
                            {{--<input type="hidden" name="idproduto" name="idproduto" value="<?= $value['idprod'] ?>">--}}
                            <input type="hidden" name="idproduto" name="idproduto" value="{{ $value->idproduto }}">
                            <button name="acao" value="editar">Editar</button><button name="acao" value="deletar">deletar</button>
                        </td>
                    </tr>
                </form>
            @endforeach
        @endif
    </table>
    </form>
    <br>
    <form name="frm_produtos_novos" method="post" action="{{   URL::to('/')   }}/app/produtos">
        <div>
            <h2>Adicionar Novo Produto:</h2>
            <input type="text" placeholder="Produto" name="nomeproduto" id="novo_nomeproduto" required="">
            <input type="text" placeholder="Preço" name="preco" id="novo_preco"  required="">
            <select name="idvendedor" id="idvendedor">
                <option value="">-- VENDEDOR --</option>
                @if(isset($vendedores) && !empty($vendedores))
                    @foreach($vendedores as $k => $vend)
                        <option value="{{  $vend->idvendedor   }}" >{{  $vend->nomevendedor   }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <button value="novo" name="acao">Adicionar Novo</button>
    </form>


</body>
</html>