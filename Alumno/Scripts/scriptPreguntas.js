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


/*Mostrar preguntas llamando a la función*/
llamarPreguntas();

function llamarPreguntas() {

    var pregunta1 = document.getElementById('pregunta1');
    var pregunta2 = document.getElementById('pregunta2');
    var pregunta3 = document.getElementById('pregunta3');
    var pregunta4 = document.getElementById('pregunta4');
    var pregunta5 = document.getElementById('pregunta5');

    
    recuperarPregunta(1,pregunta1);
    recuperarPregunta(2,pregunta2);
    recuperarPregunta(3,pregunta3);
    recuperarPregunta(6,pregunta4);
    recuperarPregunta(7,pregunta5);
    
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


function mostrar1() {
    if (display1 == 1) {
        respuesta1.style.display = 'none';
        display1 = 0;
    }
    else {
        respuesta1.style.display = 'block';
        display1 = 1;

        const numPregunta = 1;

        fetch('/Alumno/ClasesAlumno/respuestas.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(numPregunta)
        })
            .then(respuesta => {
                return respuesta.text();
            })
            .then(contenido => {
                respuesta1.innerHTML = contenido;

            })
            .catch(error => {
                console.error('Error al enviar los datos', error);
            })
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

        const numPregunta = 2;

        fetch('/Alumno/ClasesAlumno/respuestas.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(numPregunta)
        })
            .then(respuesta => {
                return respuesta.text();
            })
            .then(contenido => {
                respuesta2.innerHTML = contenido;

            })
            .catch(error => {
                console.error('Error al enviar los datos', error);
            })
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

        const numPregunta = 3;

        fetch('/Alumno/ClasesAlumno/respuestas.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(numPregunta)
        })
            .then(respuesta => {
                return respuesta.text();
            })
            .then(contenido => {
                respuesta3.innerHTML = contenido;

            })
            .catch(error => {
                console.error('Error al enviar los datos', error);
            })
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

        const numPregunta = 6;

        fetch('/Alumno/ClasesAlumno/respuestas.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(numPregunta)
        })
            .then(respuesta => {
                return respuesta.text();
            })
            .then(contenido => {
                respuesta4.innerHTML = contenido;

            })
            .catch(error => {
                console.error('Error al enviar los datos', error);
            })
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

        const numPregunta = 7;

        fetch('/Alumno/ClasesAlumno/respuestas.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(numPregunta)
        })
            .then(respuesta => {
                return respuesta.text();
            })
            .then(contenido => {
                respuesta5.innerHTML = contenido;

            })
            .catch(error => {
                console.error('Error al enviar los datos', error);
            })
    }
}

function regresar() {
    window.history.back();
}