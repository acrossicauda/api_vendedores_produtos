<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class VendedoresDAO extends Controller
{
    // se o request vier da pagina deve retornar em uma VIEW
    private $isPage = false;

    public function __construct(Request $request)
    {
        /*
         * se for 'app' retorna em uma VIEW, caso contrario retorna como object
         */
        if($request->is('app/*')) {
            $this->isPage = true;
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
        $arrVendedores = $this->getVendedores($filter);
        if($this->isPage) {
            return view('vendedores', ['vendedores' =>  $arrVendedores]);
        } else {
            return ['vendedores' =>  $arrVendedores];
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($dadosPost = array())
    {
        $vendedorNew = [
            'nomevendedor' => $dadosPost['nomevendedor'],
            'cpfvendedor' => $dadosPost['cpfvendedor']
        ];
        $id = DB::table('vendedores')->insertGetId($vendedorNew);
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
                $arrVendedores = $this->getVendedores($dadosPost);
                if($this->isPage) {
                    return view('vendedores', ['vendedores' => $arrVendedores]);
                } else {
                    return ['vendedores' => $arrVendedores];
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

        $arrVendedores = $this->getVendedores($where);
        if($this->isPage) {
            return view('vendedores', ['vendedores' => $arrVendedores]);
        } else {
            return ['vendedores' => $arrVendedores];
        }
    }

    public function getVendedores($where = array()) {
        $where = array_filter($where);
        $resp = DB::table('vendedores')
            ->where(function($query) use($where) {
                foreach ($where as $k => $v) {
                    if($k == 'idvendedor') {
                        $query->where($k, '=', "{$v}");
                    } else {
                        $query->where($k, 'like', "%{$v}%");
                    }
                }
            })
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
        $idvendedor = $dadosPost['idvendedor'];
        unset($dadosPost['acao']);
        unset($dadosPost['idvendedor']);
        $ok = DB::table('vendedores')
            ->where('idvendedor', $idvendedor)
            ->update($dadosPost);

        $arrVendedores = $this->index();
        if($this->isPage) {
            return view('vendedores', ['vendedores' => $arrVendedores]);
        } else {
            return ['vendedores' => $arrVendedores];
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
        $id = $dataPost['idvendedor'];
        $ok = false;
        $message = '';
        if(!empty($id)) {
            $ok = DB::delete("DELETE FROM vendedores where idvendedor = $id");
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
