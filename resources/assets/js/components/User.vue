<template>
            <div class="content">

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
          <i class="fa fa-align-justify"></i> USUARIOS 
                      <div style="float:right;">
                        
            <button type="button" @click="abrirModal('user', 'registrar')" class="btn btn-primary btn-round">
              <i class="icon-plus"></i>&nbsp;Nuevo Usuario
                        </button>                                       
                        <button type="button" class="btn btn-info btn-round">
                            <i class="icon-doc"></i>&nbsp;Reporte
                        </button>                        
                      </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">   
                                    <select style="border-top:0px; border-right:0px; border-left:0px;" class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      <option value="telefono">Telefono</option>
                                      <option value="estado">Estado</option>
                                    </select>
                                  <input  type="text" v-model="buscar" @keyup.enter="listarUser(1,buscar,criterio)" class="form-control ml-4 " style="height:40px; border-top:0px; border-right:0px;" placeholder="Texto a buscar">
                                    <button type="submit" style="border-radius:50px;" @click="listarUser(1,buscar,criterio)" class="btn btn-primary mt-1 ml-2"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <tr>
                                    
                                    <th>USUARIO</th>
                                    <th>ROL</th>
                                    <th>CONDICION</th>
                                    <th>OPCIONES</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                              <tr v-for="user in arrayUser" :key="user.id">
                                   
                                    <td v-text="user.usuario"></td>
                                    <td v-text="user.idrol"></td>
                                    <td>
                                              <div v-if="user.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                     <td>
                                        <button type="button" style="border-radius:30px;" class="btn btn-warning btn-sm">
                                                      <i @click="abrirModal('user', 'actualizar', user)" class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="user.condicion">
                                            <button type="button" @click="desactivarUser(user.id)" style="border-radius:30px;" class="btn btn-danger btn-sm">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                         <template v-else>
                                            <button type="button" @click="activarUser(user.id)" style="border-radius:30px;" class="btn btn-info btn-sm">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                        </div>
                        <nav>
                         <br>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1" >
                                    <a class="page-link" style="border-radius:30px;" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1, buscar, criterio)" >Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" style="border-radius:30px;" href="#" @click.prevent="cambiarPagina(page, buscar, criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" style="border-radius:30px;" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, buscar, criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
              
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="row">
                                    <div class="col-md-5 pr-1">
                                      <div class="form-group">
                                        <label for="text-input">Nombre de usuario</label>
                                         <input type="text" v-model="usuario" class="form-control"  placeholder="Ingresa el nombre de usuario">
                                      </div>
                                    </div>
                                      <div class="col-md-6 pl-1">
                                        <div class="form-group">
                                          <label for="text-input">Contraseña</label>
                                          <input type="text" v-model="password" class="form-control" placeholder="Contraseña">
                                        </div>
                                      </div>
                                      <div class="col-md-6 pl-1">
                                        <div class="form-group">
                                          <label for="text-input">Rol</label>
                                          <select v-model="idrol" class="form-control">
                                            <option value="0">-Seleccione una opción</option>
                                            <option value="1">Administrador</option>
                                            <option value="2">Contacto</option>
                                          </select>
                                        </div>
                                      </div>
                                </div>
                                    <div v-show="errorUser" class="form-group row div-error">
                                    <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjUser" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarUser()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarUser()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
        </div>
</template>

<script>
    export default {
        //props : ['ruta'],
        data (){
            return {
                id : '',
                usuario : '',
                password : '',
                idrol: 0,
                arrayUser : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorUser : 0,
                errorMostrarMsjUser : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : '',
                buscar : ''
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
        methods : {
            listarUser (page,buscar,criterio){
                let me=this;
                //var url= this.ruta + '/user?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                var url = '/user?page=' + page + '&buscar='+ buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayUser = respuesta.users.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error.response);
                });
            },
            /*cargarPdf(){
                window.open(this.ruta + '/user/listarPdf','_blank');
            },
            selectRol(){
                let me=this;
                var url= this.ruta + '/rol/selectRol';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayRol = respuesta.roles;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },*/

            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarUser(page,buscar,criterio);
            },
            registrarUser(){
             
                console.log(this.usuario);
                console.log(this.password);
                console.log(this.idrol);
                let me = this;

                //axios.post(this.ruta + '/user/registrar',{
                axios.post('/user/registrar',{
                    'usuario': this.usuario,
                    'password': this.password,
                    'idrol' : this.idrol
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarUser(1,'','usuario');
                }).catch(function (error) {
                    console.log(error.response);
                    //console.log(this.idrol);
                });
            },
            actualizarUser(){
               if (this.validarUser()){
                    return;
                }
                
                let me = this;

                //axios.put(this.ruta + '/user/actualizar',{
                axios.put('/user/actualizar',{
                    'usuario': this.usuario,
                    'password': this.password,
                    'idrol' : this.idrol,
                    'id': this.id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarUser(1,'','usuario');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            validarUser(){
                this.errorUser=0;
                this.errorMostrarMsjUser =[];

                if (!this.usuario) this.errorMostrarMsjUser.push("El nombre de usuario no puede estar vacío.");
                if (!this.password) this.errorMostrarMsjUser.push("La password del usuario no puede estar vacía.");
                if (this.idrol==0) this.errorMostrarMsjUser.push("Seleccione un Rol.");
                if (this.errorMostrarMsjUser.length) this.errorUser = 1;

                return this.errorUser;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.usuario='';
                this.password='';
                this.idrol=0;
                this.errorUser=0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "user":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Usuario';
                                this.usuario='';
                                this.password='';
                                this.idrol=0;
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Usuario';
                                this.tipoAccion=2;
                                this.usuario=data['usuario'];
                                this.password=data['password'];
                                this.idrol=data['idrol'];
                                this.id=data['id'];
                                break;
                            }
                        }
                    }
                }
            },
            desactivarUser(id){
               swal({
                title: 'Esta seguro de desactivar este registro?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    //axios.put(this.ruta + '/user/desactivar',{
                      axios.put('/user/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarUser(1,'','usuario');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            activarUser(id){
               swal({
                title: 'Esta seguro de activar este registro?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    //axios.put(this.ruta + '/user/activar',{
                      axios.put('/user/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarUser(1,'','usuario');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
        },
        mounted() {
            this.listarUser(1,this.buscar,this.criterio);
        }
    }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>
