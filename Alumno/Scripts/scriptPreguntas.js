var varExamen = document.getElementById('numExamen');
var pregunta1 = document.getElementById('pregunta1');
var pregunta2 = document.getElementById('pregunta2');
var pregunta3 = document.getElementById('pregunta3');
var pregunta4 = document.getElementById('pregunta4');
var pregunta5 = document.getElementById('pregunta5');
var respuesta1 = document.getElementById('respuesta1');
var respuesta2 = document.getElementById('respuesta2');
var respuesta3 = document.getElementById('respuesta3');
var respuesta4 = document.getElementById('respuesta4');
var respuesta5 = document.getElementById('respuesta5');
var display1 = 0;
var display2 = 0;
var display3 = 0;
var display4 = 0;
var display5 = 0;
varExamen.dataset.numero = 2;
pregunta1.dataset.numero = 1;
pregunta2.dataset.numero = 2;
pregunta3.dataset.numero = 3;
pregunta4.dataset.numero = 4;
pregunta5.dataset.numero = 5;


/*Mostrar preguntas llamando a la función*/
llamarPreguntas();
recuperaNumExamen(varExamen.dataset.numero, varExamen);

function recuperaNumExamen(numeroEx, varExamen) {

    fetch('/Alumno/ClasesAlumno/examen.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(numeroEx)
    })
        .then(respuesta => {
            return respuesta.text();
        })
        .then(contenido => {
            varExamen.innerHTML = contenido;

        })
        .catch(error => {
            console.error('Error al enviar los datos', error);
        })
}

function llamarPreguntas() {

    recuperarPregunta(pregunta1.dataset.numero, pregunta1);
    recuperarPregunta(pregunta2.dataset.numero, pregunta2);
    recuperarPregunta(pregunta3.dataset.numero, pregunta3);
    recuperarPregunta(pregunta4.dataset.numero, pregunta4);
    recuperarPregunta(pregunta5.dataset.numero, pregunta5);

}

function recuperarPregunta(numPregunta, varPregunta) {

    fetch('/Alumno/ClasesAlumno/preguntas.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(numPregunta)
    })
        .then(respuesta => {
            return respuesta.text();
        })
        .then(contenido => {
            varPregunta.innerHTML = contenido;

        })
        .catch(error => {
            console.error('Error al enviar los datos', error);
        })
}

/* Mostrar respuestas.... acción del click*/
function recuperarRespuesta(numPregunta, varRespuesta) {

    fetch('/Alumno/ClasesAlumno/respuestas.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(numPregunta)
    })
        .then(respuesta => {
            return respuesta.text();
        })
        .then(contenido => {
            varRespuesta.innerHTML = contenido;

            renderMathInElement(varRespuesta, {
                delimiters: [
                    { left: "$$", right: "$$", display: true },
                    { left: "$", right: "$", display: false }
                ]
            });

        })
        .catch(error => {
            console.error('Error al enviar los datos', error);
        })
}

function mostrar1() {
    if (display1 == 1) {
        respuesta1.style.display = 'none';
        display1 = 0;
    }
    else {
        respuesta1.style.display = 'block';
        display1 = 1;
        recuperarRespuesta(pregunta1.dataset.numero, respuesta1);
    }
}

function mostrar2() {

    if (display2 == 1) {
        respuesta2.style.display = 'none';
        display2 = 0;
    }
    else {
        respuesta2.style.display = 'block';
        display2 = 1;
        recuperarRespuesta(pregunta2.dataset.numero, respuesta2);
    }
}

function mostrar3() {
    if (display3 == 1) {
        respuesta3.style.display = 'none';
        display3 = 0;
    }
    else {
        respuesta3.style.display = 'block';
        display3 = 1;
        recuperarRespuesta(pregunta3.dataset.numero, respuesta3);
    }
}

function mostrar4() {
    if (display4 == 1) {
        respuesta4.style.display = 'none';
        display4 = 0;
    }
    else {
        respuesta4.style.display = 'block';
        display4 = 1;
        recuperarRespuesta(pregunta4.dataset.numero, respuesta4);
    }
}

function mostrar5() {
    if (display5 == 1) {
        respuesta5.style.display = 'none';
        display5 = 0;
    }
    else {
        respuesta5.style.display = 'block';
        display5 = 1;
        recuperarRespuesta(pregunta5.dataset.numero, respuesta5);
    }
}

function regresar() {
    window.history.back();
}