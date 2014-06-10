var canvas;
var centerX = 300;
var centerY = 300;
var context;
var angulo_p = 360;
var angulo_c = 360;
var raio = 200;
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
    
function background() {
  var radius = 360;
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

function draw_cadastro1() {
  document.getElementById("form_cadastro").style.display = "block";
  document.getElementById("form_login").style.display = "none";
}

function voltar1() {
  document.getElementById("form_cadastro").style.display = "none";
  document.getElementById("form_login").style.display = "block";
}

function draw() {
  background();
  contorno()
  document.getElementById("form_login").style.display = "block";
}

function init() {
  canvas = document.getElementById("circle");
  context = canvas.getContext('2d');
  return setInterval(draw,3);
  }
