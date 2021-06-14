<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref ">
            <div class="content">
                <div class="">
                    <h3>Páginas de Vendedores e Produtos</h3>
                </div>

                <div class="links">
                    <a href="{{  URL::to('/')  }}/app/vendedores">Pagina de CRUD de Vendedores</a>
                    <a href="{{  URL::to('/')  }}/app/produtos">Pagina de CRUD de Produtos</a>
                </div>

                <br><br>
                <div class="content">
                    <div class="">
                        <h3>API's para CRUD de vendedores</h3>
                    </div>
                    <div class="links">
                        <p>{{  URL::to('/')  }}/api/vendedores</p>
                        <p>Todos Vendedores: [_GET]</p> - [RETURN]: JSON
                        <pre>
                            {{  json_encode([
                            "vendedores" => [
                                "idvendedor" => 16,
                                "nomevendedor" => "Tiago Sousa33",
                                "cpfvendedor" => "431231234512"
                            ]]) }}
                        </pre>
                    </div>
                    <div class="links">
                        <p>{{  URL::to('/')  }}/api/vendedores</p>
                        <p>Filtro de Vendedores: [_POST]</p> - [SEND]: JSON
                        <pre>
                            {{  json_encode([
                                "idvendedor" => 16,
                                "nomevendedor" => "Tiago Sousa33",
                                "cpfvendedor" => "431231234512",
                                "acao" => "filtros"
                            ])  }}
                        </pre>
                    </div>
                    <div class="links">
                        <p>{{  URL::to('/')  }}/api/vendedores</p>
                        <p>Edição de Vendedores: [_POST]</p> - [SEND]: JSON
                        <pre>
                            {{  json_encode([
                                "idvendedor" => 16,
                                "nomevendedor" => "Tiago Sousa33",
                                "cpfvendedor" => "431231234512",
                                "acao" => "editar"
                            ])  }}
                        </pre>
                    </div>
                    <div class="links">
                        <p>{{  URL::to('/')  }}/api/vendedores</p>
                        <p>Edição de Vendedores: [_POST]</p> - [SEND]: JSON
                        <pre>
                            {{  json_encode([
                                "nomevendedor" => "Tiago Sousa33",
                                "cpfvendedor" => "431231234512",
                                "acao" => "novo"
                            ])  }}
                        </pre>
                    </div>
                    <div class="links">
                        <p>{{  URL::to('/')  }}/api/vendedores</p>
                        <p>Edição de Vendedores: [_POST]</p> - [SEND]: JSON
                        <pre>
                            {{  json_encode([
                                "idvendedor" => "16",
                                "acao" => "deletar"
                            ])  }}
                        </pre>
                    </div>
                </div>

                <div class="content">
                    <div class="">
                        <h3>API's para CRUD de produtos</h3>
                    </div>
                    <div class="links">
                        <p>{{  URL::to('/')  }}/api/produtos</p>
                        <p>Todos Produtos: [_GET]</p> - [RETURN]: JSON
                        <pre>
                            {{  json_encode([
                            "vendedores" => [
                                "idproduto" => 1,
                                "idvendedor" => 16,
                                "nomeproduto" => "Feijão",
                                "preco" => "10.20"
                            ]])  }}
                        </pre>
                    </div>
                    <div class="links">
                        <p>{{  URL::to('/')  }}/api/produtos</p>
                        <p>Filtro de Produtos: [_POST]</p> - [SEND]: JSON
                        <pre>
                            {{  json_encode([
                                "idproduto" => 1,
                                "nomeproduto" => "Feijão",
                                "acao" => "filtros"
                            ])  }}
                        </pre>
                    </div>
                    <div class="links">
                        <p>{{  URL::to('/')  }}/api/produtos</p>
                        <p>Edição de Produtos: [_POST]</p> - [SEND]: JSON
                        <pre>
                            {{  json_encode([
                                "idproduto" => 1,
                                "idvendedor" => 16,
                                "nomeproduto" => "Pão",
                                "preco" => "5.20",
                                "acao" => "editar"
                            ])  }}
                        </pre>
                    </div>
                    <div class="links">
                        <p>{{  URL::to('/')  }}/api/produtos</p>
                        <p>Edição de Produtos: [_POST]</p> - [SEND]: JSON
                        <pre>
                            {{  json_encode([
                                "idvendedor" => 16,
                                "nomeproduto" => "Arraoz",
                                "preco" => "22.30",
                                "acao" => "novo"
                            ])  }}
                        </pre>
                    </div>
                    <div class="links">
                        <p>{{  URL::to('/')  }}/api/produtos</p>
                        <p>Edição de Produtos: [_POST]</p> - [SEND]: JSON
                        <pre>
                            {{  json_encode([
                                "idproduto" => 16,
                                "acao" => "deletar"
                            ])  }}
                        </pre>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
