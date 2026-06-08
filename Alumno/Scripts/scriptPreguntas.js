var pregunta1 = document.getElementById('pregunta1');
var div2 = document.getElementById('pregunta2');
var div3 = document.getElementById('pregunta3');
var div4 = document.getElementById('pregunta4');
var div5 = document.getElementById('pregunta5');
var display1 = 0;
var display2 = 0;
var display3 = 0;
var display4 = 0;
var display5 = 0;


function mostrar1() {
    if (display2 == 1) {
        pregunta1.style.display = 'none';
        display2 = 0;
    }
    else {
        pregunta1.style.display = 'block';
        display2 = 1;

        const pregunta = 1;

        fetch('/Alumno/ClasesAlumno/prueba.php', {
            method: 'POST',
            headers: {'Content-Type':'application/json'},
            body: JSON.stringify(pregunta)
        })
            .then(respuesta => {
                return respuesta.text();
            })
            .then(contenido => {
                pregunta1.innerHTML = contenido;

            })
            .catch(error => {
                console.error('Error al enviar los datos', error);
            })

    }
}

function mostrar2() {
    if (display2 == 1) {
        div2.style.display = 'none';
        display2 = 0;
    }
    else {
        div2.style.display = 'block';
        display2 = 1;
    }
}

function mostrar3() {
    if (display3 == 1) {
        div3.style.display = 'none';
        display3 = 0;
    }
    else {
        div3.style.display = 'block';
        display3 = 1;
    }
}


function mostrar4() {
    if (display4 == 1) {
        div4.style.display = 'none';
        display4 = 0;
    }
    else {
        div4.style.display = 'block';
        display4 = 1;
    }
}


function mostrar5() {
    if (display5 == 1) {
        div5.style.display = 'none';
        display5 = 0;
    }
    else {
        div5.style.display = 'block';
        display5 = 1;
    }
}

function regresar() {
    window.history.back();
}

