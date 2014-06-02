var canvas;
var centerX = 300;
var centerY = 300;
var context;
var angulo_p = 0;
var angulo_c = 0;
var raio = 15;
var refresh = setInterval(draw, 3);
var op1 = 0;
var op = 0;

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
}

function progresso_login() {
    return setInterval(draw_progress,3);
}

function draw_cadastro(){
  document.getElementById("form_cadastro").style.display="block";
  document.getElementById("form_login").style.display="none";
  document.getElementById("form_cadastro").style.opacity=op;
  document.getElementById("form_login").style.opacity=op1;

  
  if (op1 > 0){
    op1 = op1 - 0.01;
  }
  
  if ((op1 == 0) && (op < 1)) {
    document.getElementById("form_login").style.display="none";
    op = op + 0.01;
  }
    
}

function cadastro_login() {
    var op1 = 1;
    return setInterval(draw_cadastro,3);
}

function stop_func(){
  clearInterval(refresh);
}

function draw() {
  
  background(raio);
  document.getElementById("form_login").style.opacity = op1;

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
        if (op1 < 1) {
          op1 = op1 + 0.5;
        }
        angulo_c = angulo_c + 2;
      }
    }
  return stop_func();
}

function init() {
    document.getElementById("hoverme").style.display = "none";
    canvas = document.getElementById("circle");
    context = canvas.getContext('2d');
    return setInterval(draw,2);
}

init();