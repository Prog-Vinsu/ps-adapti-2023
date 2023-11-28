const body = document.body;
const toggleDarkModeButton = document.getElementById('b_darkmode');

const isDarkMode = localStorage.getItem('dark-Mode') === 'enabled';

if (isDarkMode) {
  document.body.classList.add('dark-mode');
}

toggleDarkModeButton.addEventListener('click', () => {
  if (document.body.classList.contains('dark-mode')) {
    localStorage.setItem('dark-Mode', 'disabled');
  } else {
      localStorage.setItem('dark-Mode', 'enabled');
  }
  
  body.classList.toggle('dark-mode');
});

function voltarParaTopo() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

window.onscroll = function() {
  exibirOcultarBotao();
};

function exibirOcultarBotao() {
  var btnTopo = document.getElementById("btnTopo");

  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      btnTopo.style.display = "block";
  } else {
      btnTopo.style.display = "none";
  }
}