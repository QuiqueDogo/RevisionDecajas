function traerData(base, estudio) {
    let ruta = "assets/php/revision.php";
    console.log(estudio)
    let FormBase = new FormData();
    FormBase.append('base', base);
    FormBase.append('estudio', estudio);

    let PeticionFetch = {
        method: "POST",
        header: {
            'Content-Type': 'application/json'
        },
        body: FormBase,
        mode: 'no-cors'
    }



    fetch(ruta, PeticionFetch).then(response => response.json().then(datos => console.log(datos)).catch(error => console
        .log(error))).catch(error => console.log(error));
}
// Para hacer todo en el DOM
function manejador_cuestionario(datos) {
    // console.log(datos);
    //Cabeceras y limpia cada vez que mande a llamar una campaña.
    let Cabeceras = document.querySelector('#titulosColum')
    while (Cabeceras.firstChild) {
        Cabeceras.removeChild(Cabeceras.firstChild);
    }

    //data a traer y limpiar 
    let contenedor = document.querySelector('#datosColum');
    while (contenedor.firstChild) {
        contenedor.removeChild(contenedor.firstChild);
    }

    // TITULO  del cuestionario
    let nombre_cuestionario = document.querySelector('.cuestionario');
    while (nombre_cuestionario.firstChild) {
        nombre_cuestionario.removeChild(nombre_cuestionario.firstChild);
    }
    console.log(datos[0]);
    let pcuestionario = document.createElement('h2');
    pcuestionario.innerHTML = datos[0][0];
    pcuestionario.className = datos[0][1];
    nombre_cuestionario.appendChild(pcuestionario);



    datos.shift();
    //cabeceras
    let titulos = datos[0];
    titulos.forEach(elementos => {
        let THs = document.createElement('th');
        THs.innerHTML = elementos;
        Cabeceras.appendChild(THs);
    });
    datos.shift();
    console.log(datos);
    datos.forEach(encuestas => {
        let data_encuesta = document.createElement('tr');
        data_encuesta.id = "id" + encuestas[0];
        data_encuesta.className = encuestas[0];
        for (let n = 0; n < 4; n++) {
            let TDdata = document.createElement('td');
            let contexto = document.createElement('p');
            contexto.innerHTML = encuestas[n];
            TDdata.appendChild(contexto);
            data_encuesta.appendChild(TDdata);
        }
        for (let n = 4; n < encuestas.length; n++) {
            let TDdata = document.createElement('td');
            let cajatexto = document.createElement('textarea');
            cajatexto.value = encuestas[n];
            cajatexto.setAttribute('cols','50');
            cajatexto.setAttribute('rows','10')
            cajatexto.id = titulos[n];

            TDdata.appendChild(cajatexto);
            data_encuesta.appendChild(TDdata);
        }
        let TDdata2 = document.createElement('td');

        //STATUS
        let losStatus = document.createElement('select');
        let vacio = document.createElement('option');
        vacio.setAttribute('selected', '');
        vacio.disabled = true
        vacio.value = ""
        losStatus.appendChild(vacio);
        let opciones1 = document.createElement('option');
        opciones1.innerText = "BO Revisar"
        opciones1.value = "BO Revisar"
        losStatus.appendChild(opciones1);
        let opciones2 = document.createElement('option');
        opciones2.innerText = "Cancelada";
        opciones2.value = "Cancelada";
        losStatus.appendChild(opciones2);
        let opciones3 = document.createElement('option');
        losStatus.appendChild(opciones3);
        opciones3.innerText = "Revisada";
        opciones3.value = "Revisada";
        //AGregamos al td
        TDdata2.appendChild(losStatus);
        data_encuesta.appendChild(TDdata2);

        //Agregamos un boton Guardar
        let tdboton = document.createElement('td');
        let botonGuardar = document.createElement('button');
        botonGuardar.setAttribute('onclick', 'guardarInfo("id' + encuestas[0] + '")');
        botonGuardar.innerHTML = "Guardar";
        tdboton.appendChild(botonGuardar);
        data_encuesta.appendChild(tdboton);

        //Agregamos la liga del 8 --- Primero hay que hacer un botony de ahi tomar el numero y mandarlo como parametro en una nueva funcion
        let tdaudio8 = document.createElement('td');
        let boton8 = document.createElement('button');
        boton8.setAttribute('onclick','creacionIframe8y5("'+ encuestas[2] +'","8")');
        boton8.innerHTML = "Audio .8";
        tdaudio8.appendChild(boton8);
        data_encuesta.appendChild(tdaudio8);

        //Agregamos la liga para buscar del 5
        let tdaudio5 = document.createElement('td');
        let boton5 = document.createElement('button');
        boton5.setAttribute('onclick','creacionIframe8y5("'+ encuestas[2] +'","5")');
        boton5.innerHTML = "Audio .5";
        tdaudio5.appendChild(boton5);
        data_encuesta.appendChild(tdaudio5);


        //Aqui mandamos todo al tr que hicimos y lo metemos a la tabla
        contenedor.appendChild(data_encuesta);
        // console.log(encuestas);

    })
}

function guardarInfo(data) {
    let confirmacion = confirm('¿Estas seguro que vas a guardar los datos?');

    if (confirmacion === true) {
        //desactivamos el boton
        let botonAquitar = document.querySelector('#'+ data +' button');
        botonAquitar.setAttribute('disabled', 'true');
        //Seleccionamos todo lo que vamos a guardar
        let id = document.querySelector('#' + data).firstElementChild.firstChild.innerHTML
        let status = document.querySelector('#' + data + ' select')
        let areas = document.querySelectorAll('#' + data + ' textarea')
        let cuestionario = document.querySelector('.cuestionario h2')
        let ruta = "assets/php/guardarInfo.php";
        //lo metemos a un form para mandar la info v:
        let FormaDataGuardar = new FormData();
        FormaDataGuardar.append('id', id);
        FormaDataGuardar.append('status', status.value);
        FormaDataGuardar.append('base', cuestionario.className)


        for (let n = 0; n < areas.length; n++) {
            FormaDataGuardar.append(areas[n].id, areas[n].value);
        }

        let PeticionGuardar = {
            method: "POST",
            header: {
                'Content-Type': 'application/json'
            },
            body: FormaDataGuardar,
            mode: 'no-cors'
        }



         fetch(ruta, PeticionGuardar).then(response => response.json().then(datos => manejador_datosGuardar(datos)).catch(error => console.log(error))).catch(error => console.log(error));

    }

}

function manejador_datosGuardar(datos) {
    console.log(datos)
    if (datos == 'no se pudo ejecutar'){
        alert('Hubo un error');
    }else{
        alert('Guardado');
    }
}

function creacionIframe8y5(telefono, servidor) {
    let iframeContenedor = document.querySelector('.frame');
    //limpiamos cada ves que se llame
    while (iframeContenedor.firstChild) {
        iframeContenedor.removeChild(iframeContenedor.firstChild);
    }
    let iframe8 = document.createElement('iframe');

    if(servidor == 8){
        iframe8.setAttribute('src','http://172.30.27.8/buscar_audios/?txt_telefono='+ telefono +'&btn_marcar=buscar');
    }else{
        iframe8.setAttribute('src','http://172.30.27.5/buscar_audios/?txt_telefono='+ telefono +'&btn_marcar=buscar');
    }

    iframe8.setAttribute('width','90%');
    iframe8.setAttribute('height','90%');
    iframeContenedor.appendChild(iframe8);

}