<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enploy Hub</title>
  <link rel="stylesheet" href="{{ asset('site/css/style.css') }}">
</head>
<body>
  <header id="cabecalho">
    <img src="{{asset('img/Logo.png')}}" alt="Employ_Hub_Logo">
    <h1>Employ Hub</h1>
    <nav">
      <ul>
        <li><a href="#sobre_nos" class="nav_element">Sobre Nós</a></li>
        <li><a href="#contatos" class="nav_element">Contatos</a></li>
        <li><a href="http://127.0.0.1:8000/dashboard" class="nav_element">Entrar</a></li>
        <li class="nav_element"><button id="b_darkmode" onclick="toggleDarkModeButton()" class="nav_element"><i class="icon_darkmode"></i></button></li>
      </ul>
    </nav>
  </header id="header">
  <main id="principal">
    <div id="pesquisa">
      <h1>Alunos</h1>
      <form action="{{ url('/search') }}" method="GET" class="pesquisa_curso">
        <input name="search" type="text" placeholder="Digite o curso" class="imput_curso">
        <button action="{{ url('/search') }}" method="GET" class="b_pesquisar">Pesquisar</button>
      </form>
    </div>
    <div id="container_alunos">
      @foreach($alunos as $aluno)
      <div id="aluno" class="aluno">
        <img src="{{ $aluno->imagem }}" alt="">
        <div class="titulo_aluno"></div>
        <div id="informacoes_aluno">
          <ul id="lista">
            <li>Nome: <span id="resposta_aluno">{{ $aluno->nome }}</span></li>
            <li>Descrição: <span id="resposta_aluno">{{ $aluno->descricao }}</span></li>
            <li>Curso de Graduação: <span id="resposta_aluno">{{ $aluno->curso->curso }}</span></li>
          </ul>
        </div>
        @if($aluno->contratado)
            <button class="b_contratado"><p class="event type">Contratado</p></button>
        @else
            <form class="form" action="{{ route('aluno.contratar', $aluno) }}" method="post">
                @csrf
                <button type="submit" class="b_contratar"><p class="event type">Contratar</p></button>
            </form>
        @endif
      </div>
      @endforeach
    </div>
    <button id="btnTopo" onclick="voltarParaTopo()"><i id="icon_topo"></i></button>
  </main>
  <footer>
    <div class="rodape_container">
      <div id="sobre_nos" class="rodape-item">
        <h3>Sobre Nós</h3>
        <p>O Employ Hub é um espaço que promove a inserção dos alunos e formandos no mercado de trabalho.</p>
      </div>
      <div id="contatos" class="rodape-item">
        <h3>Contatos</h3>
        <p>Email: contato@meusite.com<br>Telefone: (123) 456-7890</p>
      </div>
    </div>
  </footer>
  <script src="{{ asset('site/js/script.js') }}"></script>
</body>
</html>