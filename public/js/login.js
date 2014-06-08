var canvas;
var centerX = 300;
var centerY = 300;
var context;
var angulo_p = 0;
var angulo_c = 0;
var raio = 15;
var op1 = 0;
var op = 0;

function senha_incorreta() {
  alert("Senha inválida. Tente novamente");
}

function sub(){
  document.forms['form_login'].action="<?php echo $this->url(array('controller' => 'Index', 'action' => 'index')); ?>";
  document.forms['form_login'].submit();
}

function contorno() {
  var radius = 200;
  context.beginPath();
  context.arc(centerX, centerY, radius, 0, angulo_c * (Math.PI / 180), false);
  context.fillStyle = '#A73339';
  //context.fill();
  context.lineWidth = 20;
  context.strokeStyle = '#A73339';
  context.stroke();
}
    
function background(raio) {
  var radius = raio;
  context.beginPath();
  context.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);
  context.fillStyle = '#FFF';
  context.fill();
  context.lineWidth = 20;
  context.strokeStyle = '#A73339';
  //context.stroke();
}

function progresso(angulo_p) {
  var radius = 220;
  context.beginPath();
  context.arc(centerX, centerY, radius, 0, angulo_p * (Math.PI / 180), false);
  context.fillStyle = '#FFF';
  //context.fill();
  context.lineWidth = 20;
  context.strokeStyle = '#FFF';
  context.stroke();
  

}

function draw_progress() {
  progresso(angulo_p);
  if (angulo_p < 360) {
    angulo_p = angulo_p + 3;
  }
    return sub();
}

function progresso_login() {
  return setInterval(draw_progress, 3);
}

function draw_cadastro1() {
  document.getElementById("form_cadastro").style.display = "block";
  document.getElementById("form_login").style.display = "none";
}

function stop_func() {
}

function voltar1() {
  document.getElementById("form_cadastro").style.display = "none";
  document.getElementById("form_login").style.display = "block";
}

function draw() {
  background(raio);

  if (angulo_c == 360) {
    document.getElementById("form_login").style.display = "block";
  }
  
  angulo_c = angulo_c + 2;
    
  if (raio < 200) {
    raio = raio + 2;
  }
  if (raio == 201) {
    contorno(angulo_c);
    if (angulo_c < 560) {
      angulo_c = angulo_c + 2;
    }
  }
}

function cadastro_login() {
  return setInterval(draw, 3);
}

function init() {
  document.getElementById("hoverme").style.display = "none";
  canvas = document.getElementById("circle");
  context = canvas.getContext('2d');
  return setInterval(draw, 3);
}



init();