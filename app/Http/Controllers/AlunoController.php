<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlunoRequest;
use App\Http\Requests\SiteRequest;
use App\Models\Curso;
use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class AlunoController extends Controller
{
    private $alunos;
    private $cursos;

    public function __construct(Aluno $aluno, Curso $curso){
        $this->alunos = $aluno;
        $this->cursos = $curso;
    }

    public function index()
    {
        $alunos = $this->alunos->all();
        return view('admin.aluno.index', compact('alunos'));
    }


    public function create()
    {
        $cursos = $this->cursos->all();
        return view('admin.aluno.crud', compact('cursos'));
    }
    

    public function store(AlunoRequest $request)
    {
        $data = $request->all();
        $data['contratado'] = $request->has('contratado')? true:false;

        if($request->hasFile('imagem')){
            $data['imagem'] = '/storage/' . $request->file('imagem')->store('aluno', 'public');
        }

        $this->alunos->create($data);

        return redirect()->route('aluno.index')->with('sucess', 'Aluno cadastrado com sucesso!');
    }


    public function show($id)
    {
        $aluno = $this->alunos->find($id);
        $aluno = $aluno->load('curso');
        return response()->json($aluno);
    }


    public function edit($id)
    {
        $aluno = $this->alunos->find($id);
        $cursos = $this->cursos->all();
        return view('admin.aluno.crud', compact('aluno', 'cursos'));
    }

    public function contratar(Aluno $aluno)
    {
        $aluno->update(['contratado' => true]);
        return redirect()->back()->with('status', 'Aluno contratado com sucesso!');
    }

    public function update(AlunoRequest $request, $id)
    {
        $data = $request->all();
        $data['contratado'] = $request->has('contratado')? true:false;
        $aluno = $this->alunos->find($id);


        if($request->hasFile('imagem')){
            Storage::disk('public')->delete(substr($aluno->image, 9));
            $data['imagem'] = '/storage/' . $request->file('imagem')->store('aluno', 'public');
        }

        $aluno->update($data);
        
        return redirect()->route('aluno.index')->with('sucess', 'Aluno atualizado com sucesso!');
    }

    

    public function destroy($id)
    {
        $aluno = $this->alunos->find($id);
        Storage::delete('public/' . $aluno->imagem);
        $aluno->delete();

        return redirect()->route('aluno.index')->with('sucess', 'Aluno deletado com sucesso!');
    }
}
