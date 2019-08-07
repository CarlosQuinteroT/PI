<template>
            <div class="content">

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> CALIFICAR CURSO 
                      <div style="float:right;">
                        
                        <button type="button" @click="abrirModal('curso', 'registrar')" class="btn btn-primary btn-round">
                            <i class="icon-plus"></i>&nbsp;Nuevo curso 
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
                                    <input  type="text" v-model="buscar" @keyup.enter="listarCurso(1,buscar,criterio)" class="form-control ml-4 " style="height:40px; border-top:0px; border-right:0px;" placeholder="Texto a buscar">
                                    <button type="submit" style="border-radius:50px;" @click="listarCurso(1,buscar,criterio)" class="btn btn-primary mt-1 ml-2"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <tr>
                                    
                                    <th>NOMBRE</th>
                                    <th>COSTO</th>
                                    <th>FECHA DE INICIO</th>
                                    <th>FECHA DE FIN</th> 
                                    <th>CONDICION</th> 
                                    <th>OPCIONES</th>
                                    <th>ASIGNAR ACADEMIA</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="curso in arrayCurso" :key="curso.idCurso">
                                   
                                    <td v-text="curso.nombreCurso"></td>
                                    <td v-text="curso.costo"></td>
                                    <td v-text="curso.fechaInicio"></td>
                                    <td v-text="curso.fechaFin"></td>
                                  <td>
                                        <div v-if="curso.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                      <td>
                                        <button type="button" style="border-radius:30px;" class="btn btn-warning btn-sm">
                                          <i @click="abrirModal('curso', 'actualizar', curso)" class="icon-pencil"></i>
                                        </button> &nbsp;
                                       
                                        <template v-if="curso.condicion">
                                            <button type="button" @click="desactivarCurso(curso.idCurso)" style="border-radius:30px;" class="btn btn-danger btn-sm">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                         <template v-else>
                                            <button type="button" @click="activarCurso(curso.idCurso)" style="border-radius:30px;" class="btn btn-info btn-sm">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>

                                    </td>
                                    <td>
                                       
                                       <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                       <div class="row">
                                       <div class="col-lg-8 col-md-8">
                                       <select class="form-control sin" v-model="idAcademia" name="" id="" >
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="academias in arrayAcademia" :key="academias.idAcademia" :value="academias.idAcademia" v-text="academias.nombre"></option>
                                        </select>
                                        </div>
                                         <div class="col-lg-3 col-md-3">
                                          <button type="button" style="border-radius:30px;" class="btn btn-warning btn-sm">
                                          <i @click="registrarCursoAcademia(curso.idCurso)" class="icon-pencil"></i>
                                        </button> &nbsp;
                                         </div>
                                       </div>
                                      </form>
                                      
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
                        <div class="modal-body">
                             <div class="row">
                       
                             <div class="col-md-12">
                               <div class="card card-user">
                                  <div class="card-header">
                                        <h5  v-text="tituloModal" class="card-title"></h5>
                                  </div>
                                <div class="card-body">
                                 <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                  <div class="row">
            
                                    <div class="col-md-5 pr-1">
                                      <div class="form-group">
                                        <label for="text-input"></label>
                                        <input type="text" v-model="nombreCurso" class="form-control sin"  placeholder="Nombre">
                                      </div>
                                    </div>

                                   </div>
                                   <div class="row">
                                   &nbsp <div class="col-md-3 px-1">
                                        <div class="form-group"> 
                                        &nbsp  <label>Costo</label>
                                          <input type="number" required min="1"v-model="costo" class="form-control sin" placeholder="Costo">
                                        </div>
                                    </div>
                                     <div class="col-md-4 pr-1">
                                        <div class="form-group">
                                          <label for="text-input">Fecha de inicio</label>
                                          <input type="date" v-model="fechaInicio" class="form-control sin" placeholder="Fecha de inicio" >
                                        </div>
                                      </div>
                                      <div class="col-md-4 pl-1">
                                        <div class="form-group">
                                          <label for="text-input">Fecha de finalizacion</label>
                                          <input type="date" v-model="fechaFin" class="form-control sin" placeholder="Fecha de fin">
                                        </div>
                                      </div>
                                </div>
                                  
                                <div class="row">
                                   <div class="update ml-auto mr-auto">
                                           <button type="button"  v-if="tipoAccion==1" class="btn btn-primary btn-round" @click="registrarCurso()">Registrar</button>
                                           <button type="button"  v-if="tipoAccion==2" class="btn btn-primary btn-round" @click="actualizarCurso()">Actualizar</button>
                                         </div> 
                             </div>     
                             <div v-show="errorCurso" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMensajesCurso" :key="error" v-text="error">

                                        </div>
                                    </div>
                              </div>

                            </form>
                        </div>
                     
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
        </div>
                 <div class="modal-footer">
                               <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                 </div>     
     </div>
   </div>    
</div>
</div>       
</template>

<script>
    export default {
        data (){
//           variables que se utilizan para guardar la informacion traida de las rutas 
            return {
                curso_id : 0,
                nombreCurso : '',
                costo : '',
                fechaInicio : '',
                fechaFin : '',
                arrayCurso : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorCurso : 0,
                errorMostrarMensajesCurso : [],
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
                criterio : 'nombreCurso',
                buscar : '',
                arrayInstructor : [],
                arrayInfoPersona : [],
                idAcademia : 0,
                arrayAcademia : []
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
//           MUETRA LOS REGISTROS EN UNA TABLA DE 3 EN 3 
          listarCurso (page, buscar, criterio){
                 let me=this;
                 var url = '/curso?page=' + page + '&buscar='+ buscar + '&criterio=' + criterio;
                 axios.get(url).then(function (response){
                     var respuesta=response.data;
                     me.arrayCurso = respuesta.cursos.data;
                     me.pagination=respuesta.pagination;
                 })
                .catch(function (error){
                       console.log(error);         
               });
          },
//           ENVIA Y RECIBE LAS ACADEMIAS QUE EXISTEN PARA MOSTRARLAS EN UN SELECT 
             selectAcademia(){
                let me=this;
                 var url = '/academia/selectAcademia';
                 axios.get(url).then(function (response){
                     var respuesta=response.data;
                     me.arrayAcademia = respuesta.academias;
                 })
                .catch(function (error){
                       console.log(error);         
               });
          },
//           METODOQ UE SIRVE PARA REGISTRAR EN LA TABLA DE CURSOS ACADEMIAS, SE ENVIA UN ID
          registrarCursoAcademia(idcurso){

            let me = this;
            console.log(this.idAcademia);
            console.log(idcurso);
            axios.post('/cursoacademia/registrar', {
              'idAcademia' : this.idAcademia,
              'idCurso' : idcurso        
            }).then(function (response){
//                 me.listarAcademiaInstructor(1, '', 'idPersonass'); 
                   console.log('Hola');
            }).catch(function (error){
                   console.log(error.response);         
           });
            
          },
//           METODO QUE SIRVE PARA CAMBIAR DE PAGINA Y MOSTRAR NUEVOS 3 REGISTROS
          cambiarPagina(page, buscar, criterio){
              let me = this;
              //Actualiza la pagina actual
              me.pagination.current_page = page;
              //Envia la peticion para visualizar la data de esa pagina 
              me.listarCurso(page, buscar, criterio);
          },
//           METODO QUE SIRVE PARA REGISTRAR UN CURSO EN LA BASE DE DATOS 
          registrarCurso(){
            
            if(this.validarCurso()){
              return;
            }
            
            let me = this;
            axios.post('/curso/registrar', {
              'nombreCurso' : this.nombreCurso,
              'costo' : this.costo,
              'fechaInicio' : this.fechaInicio,
              'fechaFin' : this.fechaFin
            }).then(function (response){
                me.cerrarModal();
                me.listarCurso(1, '', 'nombreCurso');
              
            }).catch(function (error){
                   console.log(error.response);         
           });
            
          },
//           METODO QUE SIRVE PARA ACTUALIZAR LOS CURSOS
          actualizarCurso(){
                if(this.validarCurso()){
                  return;
                }

                let me = this;
                axios.put('/curso/actualizar', {
                  'nombreCurso' : this.nombreCurso,
                  'costo' : this.costo,
                  'fechaInicio' : this.fechaInicio,
                  'fechaFin' : this.fechaFin,
                  'idCurso' : this.curso_id
                }).then(function (response){
                    me.cerrarModal();
                    me.listarCurso(1,'', 'nombreCurso');

                }).catch(function (error){
                       console.log(error);         
               });

          },
//           METODO QUE SIRVE PARA DESACTIVAR LOS CURSOS
          desactivarCurso(idCurso){
                swal({
                title: '¿Esta seguro de desactivar este curso?',
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

                    axios.put('/curso/desactivar',{
                        'idCurso': idCurso
                    }).then(function (response) {
                        me.listarCurso(1,'','nombreCurso');
                        swal(
                        'Desactivado!',
                        'El curso ha sido desactivado con éxito.',
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
          //           METODO QUE SIRVE PARA ACTIVAR LOS CURSOS

           activarCurso(idCurso){
                 swal({
                title: '¿Esta seguro de desactivar esta curso?',
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

                    axios.put('/curso/activar',{
                        'idCurso': idCurso
                    }).then(function (response) {
                        me.listarCurso(1,'','nombreCurso');
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
//        VALIDA LOS CURSOS 
          validarCurso(){
            this.errorCurso = 0;
            this.errorMostrarMensajesCurso = [];
            
            if(!this.nombreCurso){
              this.errorMostrarMensajesCurso.push("El nombre del curso no puede estar vacio");
            }
            
            
            if(this.errorMostrarMensajesCurso.length){
              this.errorCurso = 1;
            }
            
            return this.errorCurso;
          },
//           METODO QUE SIRVE PARA CERRAR EL MODAL 
          cerrarModal(){
            this.modal = 0;
            this.tituloModal = '';
            this.nombreCurso = '';
            this.costo = '';
            this.fechaInicio = '';
            this.fechaFin = '';
          },
          //           METODO QUE SIRVE PARA ABRIR EL MODAL 
          abrirModal(modelo, accion, data = []){
              switch(modelo){
                case "curso":
                  {
                    switch(accion)
                    {
                      case "registrar":
                      {
                        this.modal = 1;
                        this.tituloModal = 'Registrar Curso';
                        this.nombreCurso = '';
                        this.costo = '';
                        this.fechaInicio = '';
                        this.fechaFin = '';
                        this.tipoAccion = 1;
                        break;
                      }              
                      case "actualizar":
                      {
                          this.modal = 1;
                          this.tituloModal = 'Actualizar Curso';
                          this.tipoAccion = 2;             
                          this.nombreCurso = data['nombreCurso'];
                          this.fechaInicio = data['fechaInicio'];
                          this.fechaFin = data['fechaFin'];
                          this.costo = data['costo'];
                          this.curso_id = data['idCurso'];
                          break;
                      }
                    }
                  }
              }
   
          }
        },
        
        mounted() {
            this.listarCurso(1, this.buscar, this.criterio);
            this.selectAcademia();
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
    .sin{
        border-top:0px;
        border-right:0px;
        border-left:0px;
  }
</style>
