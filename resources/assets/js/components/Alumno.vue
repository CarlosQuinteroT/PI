<template>
            <div class="content">

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> ALUMNOS 
                      <div style="float:right;">
                        
                        <button type="button" @click="abrirModal('alumno', 'registrar')" class="btn btn-primary btn-round">
                            <i class="icon-plus"></i>&nbsp;Nuevo alumnos
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
                                    <input  type="text" v-model="buscar" @keyup.enter="listarAlumno(1,buscar,criterio)" class="form-control ml-4 " style="height:40px; border-top:0px; border-right:0px;" placeholder="Texto a buscar">
                                    <button type="submit" style="border-radius:50px;" @click="listarAcademia(1,buscar,criterio)" class="btn btn-primary mt-1 ml-2"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <tr>
                                    
                                    <th>NOMBRE</th>
                                    <th>TELEFONO</th>
                                    <th>DIRECCION</th>
                                    <th>ID DE CONTACTO</th>
                                    <th>ESTADO</th> 
                                    <th>OPCIONES</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="academia in arrayAcademia" :key="academia.idAcademia">
                                   
                                    <td v-text="academia.nombre"></td>
                                    <td v-text="academia.telefono"></td>
                                    <td v-text="academia.direccion"></td>
                                    <td v-text="academia.idContacto"></td>
                                    <td v-text="academia.estado"></td>
                                     <td>
                                        <button type="button" style="border-radius:30px;" class="btn btn-warning btn-sm">
                                          <i @click="abrirModal('academia', 'actualizar', academia)" class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template>
                                            <button type="button" style="border-radius:30px;" class="btn btn-danger btn-sm">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template >
                                            <button type="button" style="border-radius:30px;" class="btn btn-info btn-sm">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                        
<!--                                     <td>
                                        <div >
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div >
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td> -->
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
                                        <label for="text-input">Nombre de la academia</label>
                                        <input type="text" v-model="nombre" class="form-control"  placeholder="Ingresa el nombre de la academia">
                                      </div>
                                    </div>
                                    <div class="col-md-3 px-1">
                                      <div class="form-group">
                                        <label for="text-input">Teléfono</label>
                                        <input type="text" v-model="telefono" class="form-control" placeholder="Telefono">
                                      </div>
                                    </div>     
                                      <div class="col-md-3 px-1">
                                        <div class="form-group">
                                          <label>Contacto</label>
                                          <input type="text"  v-model="idContacto" class="form-control" placeholder="Contacto">
                                        </div>
                                      </div>
                                </div>
                                  <div class="row">
                                      <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                          <label for="text-input">Direccion</label>
                                          <input type="text" v-model="direccion" class="form-control" placeholder="Ingresa la direccion de la academia" >
                                        </div>
                                      </div>
                                      <div class="col-md-6 pl-1">
                                        <div class="form-group">
                                          <label for="text-input">Estado</label>
                                          <input type="text" v-model="estado" class="form-control" placeholder="Estado">
                                        </div>
                                      </div>
                                </div>
                                                   
                              
                                <div v-show="errorAcademia" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMensajesAcademia" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarAcademia()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarAcademia()">Actualizar</button>
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
        data (){
            return {
                alumno_id : 0,
                idPersona : 0,
                idAcademia : '',
                condicion : '',
                arrayAlumno : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorAcademia : 0,
                errorMostrarMensajesAlumno : [],
                pagination : 
                {
                    'total'        : 0,
                    'current_page' : 0,
                    'per_page'     : 0,
                    'last_page'    : 0,
                    'from'         : 0,
                    'to'           : 0,
                },
                offset : 3,
                criterio : 'nombre',
                buscar : ''
            }
        },
     //PROPIEDADES COMPUTADAS 
        computed:{
            isActived: function(){
              return this.pagination.current_page;
            },
            pagesNumber: function(){
                if(!this.pagination.to){
                  return [];
                }
                //variable offset
                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }
                
                //VARIABLE TO
                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }
               //VARIABLE PAGESARRAY
                var pagesArray = [];
                while(from <= to){
                  pagesArray.push(from);
                  from++;
                }
                return pagesArray;
            }
        },
      
        //METODOS
        methods : {
          listarAlumno (page, buscar, criterio){
                 let me=this;
                 var url = '/alumno?page=' + page + '&buscar='+ buscar + '&criterio=' + criterio;
                 axios.get(url).then(function (response){
                     var respuesta=response.data;
                     me.arrayAlumno = respuesta.alumnos.data;
                     me.pagination=respuesta.pagination;
                 })
                .catch(function (error){
                       console.log(error);         
               });
          },
          cambiarPagina(page, buscar, criterio){
              let me = this;
              //Actualiza la pagina actual
              me.pagination.current_page = page;
              //Envia la peticion para visualizar la data de esa pagina 
              me.listarAlumno(page, buscar, criterio);
          },
          registrarAlumno(){
            
            if(this.validarAlumno()){
              return;
            }
            
            let me = this;
            axios.post('/alumno/registrar', {
              'idContacto' : this.idContacto,
              'nombre' : this.nombre,
              'telefono' : this.telefono,
              'direccion' : this.direccion,
              'estado' : this.estado
            }).then(function (response){
                me.cerrarModal();
                me.listarAlumno(1, '', 'nombre');
              
            }).catch(function (error){
                   console.log(error);         
           });
            
          },
          
          actualizarAlumno(){
                if(this.validarAlumno()){
                  return;
                }

                let me = this;
                axios.put('/alumno/actualizar', {
                  'idContacto' : this.idContacto,
                  'nombre' : this.nombre,
                  'telefono' : this.telefono,
                  'direccion' : this.direccion,
                  'estado' : this.estado,
                  'idAlumno' : this.alumno_id
                }).then(function (response){
                    me.cerrarModal();
                    me.listarAlumno(1,'', 'nombre');

                }).catch(function (error){
                       console.log(error);         
               });

          },
          
          desactivarAlumno(idAlumno){
                swal({
                title: 'Esta seguro de desactivar este alumno?',
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

                    axios.put('/alumno/desactivar',{
                        'idAlumno': idAlumno
                    }).then(function (response) {
                        me.listarAlumno(1,'','nombre');
                        swal(
                        'Desactivado!',
                        'El alumno ha sido desactivado con éxito.',
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
          
           activarAlumno(idPersona){
                 swal({
                title: 'Esta seguro de activar esta alumno?',
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

                    axios.put('/alumno/activar',{
                        'idAlumno': idAlumno
                    }).then(function (response) {
                        me.listarPersona(1,'','nombre');
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
          
          validarAlumno(){
            this.errorAlumno = 0;
            this.errorMostrarMensajesAlumno = [];
            
            if(!this.nombre){
              this.errorMostrarMensajesAlumno.push("El nombre de la alumno no puede estar vacio");
            }
            
            
            if(this.errorMostrarMensajesAlumno.length){
              this.errorAlumno = 1;
            }
            
            return this.errorAlumno;
          },
          cerrarModal(){
            this.modal = 0;
            this.tituloModal = '';
            this.nombre = '';
            this.idContacto = 0;
            this.direccion = '';
            this.telefono = '';
            this.estado = '';
          },
          abrirModal(modelo, accion, data = []){
              switch(modelo){
                case "alumno":
                  {
                    switch(accion)
                    {
                      case "registrar":
                      {
                        this.modal = 1;
                        this.tituloModal = 'Registrar Alumno'
                        this.nombre = '';
                        this.idContacto = '';
                        this.telefono = '';
                        this.direccion = '';
                        this.estado = '';
                        this.tipoAccion = 1;
                        break;
                      }              
                      case "actualizar":
                      {
                          this.modal = 1;
                          this.tituloModal = 'Axtualizar alumno';
                          this.tipoAccion = 2;
                          this.idContacto = data['idContacto'];
                          this.nombre = data['nombre'];
                          this.telefono = data['telefono'];
                          this.direccion = data['direccion'];
                          this.estado = data['estado'];
                          this.alumno_id = data['idAlumno'];
                          break;
                      }
                    }
                  }
              }
          },
        },
        
        mounted() {
            this.listarAlumno(1, this.buscar, this.criterio);
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
