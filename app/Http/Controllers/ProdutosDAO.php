<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProdutosDAO extends Controller
{
    private $arrVendedores = array();

    // se o request vier da pagina deve retornar em uma VIEW
    private $isPage = false;

    /**
     * ProdutosDAO constructor.
     * Trazendo todos os vendedores para monstrar no select de produtos
     */
    public function __construct(Request $request)
    {
        /*
        * se for 'app' retorna em uma VIEW, caso contrario retorna como object
        */
        if($request->is('app/*')) {
            $this->isPage = true;
            // os vendedores so sao uteis para a tela, para a API nao
            $vendedores = new VendedoresDao($request);
            $this->arrVendedores = $vendedores->getVendedores();
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request = null)
    {
        $filter = array();
        if($request) {
            $filter = $request->all();
        }
        $arrProdutos = $this->getProdutos($filter);
        if($this->isPage) {
            return view('produtos',
                ['produtos' =>  $arrProdutos, 'vendedores' => $this->arrVendedores]);
        } else {
            return ['produtos' =>  $arrProdutos];
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($dadosPost = array())
    {
        $produtoNew = [
            'nomeproduto' => $dadosPost['nomeproduto'],
            'preco' => $dadosPost['preco'],
            'idvendedor' => $dadosPost['idvendedor']
        ];
        $id = DB::table('produtos')->insertGetId($produtoNew);
        return ['id' => $id];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dadosPost = $request->all();

        $erro = array();
        if(!empty($dadosPost['acao'])) {
            if($dadosPost['acao'] == 'editar') {
                $ok = $this->edit($dadosPost);
            } else if($dadosPost['acao'] == 'deletar') {
                $ok = $this->destroy($dadosPost);
            } else if($dadosPost['acao'] == 'novo') {
                $this->create($dadosPost);
            } else if($dadosPost['acao'] == 'filtros') {
                unset($dadosPost['acao']);
                $arrProdutos = $this->getProdutos($dadosPost);
                if($this->isPage) {
                    return view('produtos', ['produtos' => $arrProdutos, 'vendedores' => $this->arrVendedores]);
                } else {
                    return ['produtos' => $arrProdutos];
                }
            } else {
                $erro = ['successs' => false, 'message' => 'Método não encontrado'];
            }
        }
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($filters = array())
    {
        $where = array();
        if(!empty($filters)) {
            foreach ($filters as $key => $value) {
                if(trim($value) != '') {
                    $where[] = " {$key} = {$value} ";
                }
            }
        }

        $arrProdutos = $this->getProdutos($where);
        if($this->isPage) {
            return view('produtos', ['produtos' => $arrProdutos, 'vendedores' => $this->arrVendedores]);
        } else {
            return ['produtos' => $arrProdutos];
        }
    }

    private function getProdutos($where = array()) {
        $where = array_filter($where);
        $resp = DB::table('produtos')
            ->leftJoin('vendedores', 'produtos.idvendedor', '=', 'vendedores.idvendedor')
            ->where(function($query) use($where) {
                foreach ($where as $k => $v) {
                    if($k == 'nomeproduto') {
                        $query->where($k, 'like', "%{$v}%");
                    } else {
                        // por enquanto trazendo os valores menores ou igual
                        $query->where($k, '=', "{$v}");
                    }
                }
            })
            ->select('produtos.*', 'vendedores.idvendedor', 'vendedores.nomevendedor')
            ->get();

        return $resp;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($dadosPost = array())
    {
        $dadosPost = array_filter($dadosPost);
        $idproduto = $dadosPost['idproduto'];
        unset($dadosPost['acao']);
        unset($dadosPost['idproduto']);
        $ok = DB::table('produtos')
            ->where('idproduto', $idproduto)
            ->update($dadosPost);

        $arrProdutos = $this->index();
        if($this->isPage) {
            return view('produtos', ['produtos' => $arrProdutos, 'vendedores' => $this->arrVendedores]);
        } else {
            return ['produtos' => $arrProdutos];
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($dataPost = array())
    {
        $id = $dataPost['idproduto'];
        $ok = false;
        $message = '';
        if(!empty($id)) {
            $ok = DB::delete("DELETE FROM produtos where idproduto = $id");
            if($ok) {
                $message = 'Mensagem Excluída';
            } else {
                $message = 'Ocorreu um erro na tentativa de excluir a mensagem ' . $id;
            }
        } else {
            $message = "O campo 'id' não pode ser vazio";
        }

        if($this->isPage) {
            return view('vendedores', ['success' => $ok, 'message' => $message]);
        } else {
            return ['success' => $ok, 'message' => $message];
        }
    }

}
