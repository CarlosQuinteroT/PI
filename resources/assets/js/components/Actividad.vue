<template>
            <div class="content">

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> ACTIVIDAD 
                      <div style="float:right;">
                        
                        <button type="button" @click="abrirModal('actividad', 'registrar')" class="btn btn-primary btn-round">
                            <i class="icon-plus"></i>&nbsp;Nueva actividad
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
                                     
                                    </select>
                                    <input  type="text" v-model="buscar" @keyup.enter="listarActividad(1,buscar,criterio)" class="form-control ml-4 " style="height:40px; border-top:0px; border-right:0px;" placeholder="Texto a buscar">
                                    <button type="submit" style="border-radius:50px;" @click="listarActividad(1,buscar,criterio)" class="btn btn-primary mt-1 ml-2"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <tr>
                                    
                                    
                                    <th>CURSO</th>
                                    <th>DESCRIPCION</th>
                                    <th>CONDICION</th>                                 
                                    <th>OPCIONES</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="actividad in arrayActividad" :key="actividad.idActividad">
                                   
                                    <td v-text="actividad.nombreCurso"></td>
                                    <td v-text="actividad.descripcion"></td>
                                    
                                  <td>
                                        <div v-if="actividad.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                      <td>
                                        <button type="button" style="border-radius:30px;" class="btn btn-warning btn-sm">
                                          <i @click="abrirModal('actividad', 'actualizar', actividad)" class="icon-pencil"></i>
                                        </button> &nbsp;
                                       
                                        <template v-if="actividad.condicion">
                                            <button type="button" @click="desactivarActividad(actividad.idActividad)" style="border-radius:30px;" class="btn btn-danger btn-sm">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                         <template v-else>
                                            <button type="button" @click="activarActividad(actividad.idActividad)" style="border-radius:30px;" class="btn btn-info btn-sm">
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
                                      <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                          <label for="text-input">Curso</label>
                                         <input type="text" v-model="idCurso" class="form-control"  placeholder="Curso">
                                        </div>
                                      </div>
                                      <div class="col-md-6 pl-1">
                                        <div class="form-group">
                                         <label for="text-input">Descripcion</label>
                                        <input type="text" v-model="descripcion" class="form-control" placeholder="Descripcion">
                                        </div>
                                      </div>
                                </div>
                                                   
                              
                                <div v-show="errorActividad" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMensajesActividad" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarActividad()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarActividad()">Actualizar</button>
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
                actividad_id : 0,
                idCurso : 0,
                descripcion : '',
                arrayActividad : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorActividad : 0,
                errorMostrarMensajesActividad : [],
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
                criterio : '',
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
          listarActividad (page, buscar, criterio){
                 let me=this;
                 var url = '/actividad?page=' + page + '&buscar='+ buscar + '&criterio=' + criterio;
                 axios.get(url).then(function (response){
                     var respuesta=response.data;
                     me.arrayActividad = respuesta.actividades.data;
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
              me.listarActividad(page, buscar, criterio);
          },
          registrarActividad(){
            
            if(this.validarActividad()){
              return;
            }
            
            let me = this;
            axios.post('/actividad/registrar', {
              'idCurso' : this.idCurso,
              'descripcion' : this.descripcion
            }).then(function (response){
                me.cerrarModal();
                me.listarActividad(1, '', 'descripcion');
              
            }).catch(function (error){
                   console.log(error.response);         
           });
            
          },
          
          actualizarActividad(){
                if(this.validarActividad()){
                  return;
                }

                let me = this;
                axios.put('/actividad/actualizar', {
                  'idCurso' : this.idCurso,
                  'descripcion' : this.descripcion,
                  'idActividad' : this.actividad_id
                }).then(function (response){
                    me.cerrarModal();
                    me.listarActividad(1,'', 'idCurso');

                }).catch(function (error){
                       console.log(error);         
               });

          },
          
          desactivarActividad(idActividad){
                swal({
                title: '¿Esta seguro de desactivar esta actividad?',
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

                    axios.put('/actividad/desactivar',{
                        'idActividad': idActividad
                    }).then(function (response) {
                        me.listarActividad(1,'','descripcion');
                        swal(
                        'Desactivado!',
                        'La actividad ha sido desactivado con éxito.',
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
           activarActividad(idActividad){
                 swal({
                title: '¿Esta seguro de desactivar esta actividad?',
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

                    axios.put('/actividad/activar',{
                        'idActividad': idActividad
                    }).then(function (response) {
                        me.listarActividad(1,'','descripcion');
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
          
          validarActividad(){
            this.errorActividad = 0;
            this.errorMostrarMensajesActividad = [];
            
            if(!this.descripcion){
              this.errorMostrarMensajesActividad.push("La descripcion de la actividad no puede estar vacia");
            }
            
            
            if(this.errorMostrarMensajesActividad.length){
              this.errorActividad = 1;
            }
            
            return this.errorCurso;
          },
          cerrarModal(){
            this.modal = 0;
            this.tituloModal = '';
            this.IdCurso = 0;
            this.descripcion = '';
          },
          abrirModal(modelo, accion, data = []){
              switch(modelo){
                case "actividad":
                  {
                    switch(accion)
                    {
                      case "registrar":
                      {
                        this.modal = 1;
                        this.tituloModal = 'Registrar actividad'
                        
                        this.idCurso = 0;
                        this.descripcion = '';
                   
                        this.tipoAccion = 1;
                        break;
                      }              
                      case "actualizar":
                      {
                          this.modal = 1;
                          this.tituloModal = 'Actualizar actividad';
                          this.tipoAccion = 2;
                          this.idCurso = data['idCurso'];
                          this.descripcion = data['descripcion'];
                          this.actividad_id = data['idActividad'];
                          break;
                      }
                    }
                  }
              }
          },
        },
        
        mounted() {
            this.listarActividad(1, this.buscar, this.criterio);
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
