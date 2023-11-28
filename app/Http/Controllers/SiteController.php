<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlunoRequest;
use App\Models\Curso;
use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SiteRequest;


class SiteController extends Controller
{

    private $alunos;

    public function __construct(Aluno $aluno){
        $this->alunos = $aluno;
    }

    public function index()
    {
        $alunos = $this->alunos->all();
        return view('site.index', compact('alunos'));
    }

    public function create()
    {
    }


    public function store(Request $request)
    {
    }


    public function show($id)
    {
    }


    public function edit($id)
    {
    }


    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }

    public function search(SiteRequest $request)
    {
        $pesquisar = $request["search"];
        $alunos = $this->alunos
            ->where("nome", "like", "%$pesquisar%")
            ->orWhereHas("curso", function($query) use($pesquisar)
            {$query->where("curso", "like","%$pesquisar%");})
            ->get();

        return view('site.index', compact('alunos'));
    }
}
