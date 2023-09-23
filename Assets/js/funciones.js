let tblUsuarios, tblClientes, tblCaja;
document.addEventListener("DOMContentLoaded", function(){
    tblUsuarios = $('#tblUsuarios').DataTable( {
        ajax: {
            url: base_url+'Usuarios/listar',
            dataSrc: ''
        },
        columns: [ 
            {'data' : 'id'},
            {'data' : 'usuario'},
            {'data' : 'nombre'},
            {'data' : 'caja'},
            {'data' : 'estado'},
            {'data' : 'acciones'}
        ]
    } );
    //fin de tabla usuarios
    tblClientes = $('#tblClientes').DataTable( {
        ajax: {
            url: base_url+'Clientes/listar',
            dataSrc: ''
        },
        columns: [ 
            {'data' : 'id'},
            {'data' : 'rut'},
            {'data' : 'nombre'},
            {'data' : 'telefono'},
            {'data' : 'direccion'},
            {'data' : 'estado'},
            {'data' : 'acciones'}
        ]
    } );
    //fin de tabla clientes
    tblCaja = $('#tblCaja').DataTable( {
        ajax: {
            url: base_url+'Caja/listar',
            dataSrc: ''
        },
        columns: [ 
            {'data' : 'id'},
            {'data' : 'caja'},
            {'data' : 'estado'},
            {'data' : 'acciones'}
        ]
    } );
})
 

function frmUsuario() {
    document.getElementById("title").innerHTML = "Nuevo Usuario";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmUsuarios").reset();
    $("#frmUsuario").modal("show");
    document.getElementById("id").value = "";
}
//
function registrarUser(e){
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const nombre = document.getElementById("nombre");
    const clave = document.getElementById("clave");
    const confirmar = document.getElementById("confirmar");
    const caja = document.getElementById("caja");

    if(usuario.value == "" || nombre.value == "" || caja.value == ""){
        Swal.fire({
            position: 'top-center',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
          })
    }else{
        const url = base_url+"Usuarios/registrar";
        const frm = document.getElementById("frmUsuarios");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Usuario registrado con éxito',
                        showConfirmButton: false,
                        timer: 3000
                      })
                } else if(res == "modificado"){
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Usuario modificado con éxito',
                        showConfirmButton: false,
                        timer: 3000
                      })
                }else {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                      })
                }
                frm.reset();
                $('#frmUsuario').modal("hide");
                tblUsuarios.ajax.reload();
            }
        }
    }
}

function btnEditarUser(id) {
    document.getElementById("title").innerHTML = "Actualizar Usuario";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    
    const url = base_url+"Usuarios/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("usuario").value = res.usuario;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("caja").value = res.id_caja;
            document.getElementById("claves").classList.add("d-none");
            $('#frmUsuario').modal("show");
        }
    }


}

function btnEliminarUser(id){
    // console.log(id);
    Swal.fire({
        title: '¿Esta seguro de eliminar?',
        text: "El usuario no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url+"Usuarios/eliminar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    if (res == "ok"){
                        Swal.fire(
                            'Mensaje!',
                            'Usuario inactivo/eliminado con éxito.',
                            'success'
                        )
                        tblUsuarios.ajax.reload();
                    }else{
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        )
                    }
                
                }
            }
        }
      })
}


function btnReingresarUser(id){
    // console.log(id);
    Swal.fire({
        title: '¿Esta seguro de Re-ingresar Usuario?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url+"Usuarios/reingresar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    if (res == "ok"){
                        Swal.fire(
                            'Mensaje!',
                            'Usuario re-ingresado con éxito.',
                            'success'
                        )
                        tblUsuarios.ajax.reload();
                    }else{
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        )
                    }
                
                }
            }
        }
      })
}

// FIN USUARIOS

function frmCliente() {
    document.getElementById("title").innerHTML = "Nuevo Cliente";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmCliente").reset();
    $("#nuevo_cliente").modal("show");
    document.getElementById("id").value = "";
}
//
function registrarCli(e){
    e.preventDefault();
    const rut = document.getElementById("rut");
    const nombre = document.getElementById("nombre");
    const telefono = document.getElementById("telefono");
    const direccion = document.getElementById("direccion");
    

    if(rut.value == "" || nombre.value == "" || telefono.value == "" || direccion.value == ""){
        Swal.fire({
            position: 'top-center',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
          })
    }else{
        const url = base_url+"Clientes/registrar";
        const frm = document.getElementById("frmCliente");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Cliente registrado con éxito',
                        showConfirmButton: false,
                        timer: 3000
                      })
                } else if(res == "modificado"){
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Cliente modificado con éxito',
                        showConfirmButton: false,
                        timer: 3000
                      })
                }else {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                      })
                }
                frm.reset();
                $('#nuevo_cliente').modal("hide");
                tblClientes.ajax.reload();
            }
        }
    }
}

function btnEditarCli(id) {
    document.getElementById("title").innerHTML = "Actualizar Cliente";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    
    const url = base_url+"Clientes/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("rut").value = res.rut;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("telefono").value = res.telefono;
            document.getElementById("direccion").value = res.direccion;
            
            $('#nuevo_cliente').modal("show");
        }
    }


}

function btnEliminarCli(id){
    // console.log(id);
    Swal.fire({
        title: '¿Esta seguro de eliminar?',
        text: "El usuario no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url+"Clientes/eliminar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    if (res == "ok"){
                        Swal.fire(
                            'Mensaje!',
                            'Cliente inactivo/eliminado con éxito.',
                            'success'
                        )
                        
                    }else{
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        )
                    }
                    tblClientes.ajax.reload();
                }
            }
        }
      })
}


function btnReingresarCli(id){
    // console.log(id);
    Swal.fire({
        title: '¿Esta seguro de Re-ingresar Cliente?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url+"Clientes/reingresar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    if (res == "ok"){
                        Swal.fire(
                            'Mensaje!',
                            'Cliente re-ingresado con éxito.',
                            'success'
                        )
                    }else{
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        )
                    }
                    tblClientes.ajax.reload();
                }
            }
        }
      })
}

// FIN CLIENTES


function frmCaja() {
    document.getElementById("title").innerHTML = "Nueva Caja";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmCajas").reset();
    $("#nueva_caja").modal("show");
    document.getElementById("id").value = "";
}
//
function registrarCaja(e){
    e.preventDefault();
    const caja = document.getElementById("caja");
    const estado = document.getElementById("estado");

    if(caja.value == "" || estado.value == "" ){
        Swal.fire({
            position: 'top-center',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
          })
    }else{
        const url = base_url+"Caja/registrar";
        const frm = document.getElementById("frmCajas");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Caja registrado con éxito',
                        showConfirmButton: false,
                        timer: 3000
                      })
                } else if(res == "modificado"){
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Caja modificado con éxito',
                        showConfirmButton: false,
                        timer: 3000
                      })
                }else {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                      })
                }
                frm.reset();
                $('#nueva_caja').modal("hide");
                tblCaja.ajax.reload();
            }
        }
    }
}

function btnEditarCaja(id) {
    document.getElementById("title").innerHTML = "Actualizar Caja";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    
    const url = base_url+"Caja/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("caja").value = res.caja;
            document.getElementById("estado").value = res.estado;
            
            $('#nueva_caja').modal("show");
        }
    }


}

function btnEliminarCaja(id){
    // console.log(id);
    Swal.fire({
        title: '¿Esta seguro de eliminar?',
        text: "El tipo de Caja no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url+"Caja/eliminar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    if (res == "ok"){
                        Swal.fire(
                            'Mensaje!',
                            'Caja inactivo/eliminado con éxito.',
                            'success'
                        )
                        
                    }else{
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        )
                    }
                    tblCaja.ajax.reload();
                }
            }
        }
      })
}


function btnReingresarCaja(id){
    // console.log(id);
    Swal.fire({
        title: '¿Esta seguro de Re-ingresar Caja?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url+"Caja/reingresar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    const res = JSON.parse(this.responseText);
                    if (res == "ok"){
                        Swal.fire(
                            'Mensaje!',
                            'Caja re-ingresado con éxito.',
                            'success'
                        )
                    }else{
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        )
                    }
                    tblCaja.ajax.reload();
                }
            }
        }
      })
}
