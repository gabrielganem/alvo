var canvas;
var centerX = 300;
var centerY = 300;
var context;
var raio = 15;

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


function progresso(angulo) {
    var radius = 200;
    context.beginPath();
    context.arc(centerX, centerY, radius, 0, angulo * (Math.PI / 180), false);
    context.fillStyle = '#FFF';
    //context.fill();
    context.lineWidth = 20;
    context.strokeStyle = '#FFF';
    context.stroke();
}

function draw() {
    background(raio);
    if (raio > 200) {
        document.getElementById("form_login").style.display = "block";
    }
    if (raio < 200) {
        raio = raio + 2;
    }

}

function init() {
    document.getElementById("hoverme").style.display = "none";
    canvas = document.getElementById("circle");
    context = canvas.getContext('2d');
    return setInterval(draw, 3);
}