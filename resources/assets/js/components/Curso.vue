<template>
            <div class="content">

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> CURSOS 
                      <div style="float:right;">
                        
                        <button type="button" @click="abrirModal('curso', 'registrar')" class="btn btn-primary btn-round">
                            <i class="icon-plus"></i>&nbsp;Nuevo curso 
                        </button>                                       
                        <button type="button" class="btn btn-info btn-round">
                            <i class="icon-doc"></i>&nbsp;Reporte
                        </button>                        
                      </div>
                    </div>
                   <template v-if="valorCambiar==0">
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
                                    <th>ASIGNAR ACADEMIAS</th>
                                     <th>ASIGNAR INSTRCUTORES</th>
                                    <th>OPCIONES</th>
                                   
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
                                          <i @click="CambiarCursoId(curso.idCurso)" class="icon-pencil"></i>
                                        </button> &nbsp;
                                    </td>
                                    <td>
                                       
                                                  <button type="button" style="border-radius:30px;" class="btn btn-warning btn-sm">
                                          <i @click="CambiarCursoId2(curso.idCurso)" class="icon-pencil"></i>
                                        </button> &nbsp;
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
                  </template>




                   <template v-if="valorCambiar==1">
                      <div class="card-body">
                        <div class="row" style="float:right;">
                           <button type="button" @click="CambiarCursoId()" class="btn btn-danger " >
                                x
                          </button>  
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">   
                                    <select style="border-top:0px; border-right:0px; border-left:0px;" class="form-control col-md-3" v-model="criterio">
                                      <option value="descripcion">Descripcion</option>
                                      
                                    </select>
                                  <input  type="text" v-model="buscar" @keyup.enter="listarTicket(1,buscar,criterio)" class="form-control ml-4 " style="height:40px; border-top:0px; border-right:0px;" placeholder="Texto a buscar">
                                    <button type="submit" style="border-radius:50px;" @click="listarTicket(1,buscar,criterio)" class="btn btn-primary mt-1 ml-2"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                        <div class=" col-md-7" style="border-right:solid 3px; border-color:#63D9F7;">
                          
                        <table class="table">
                            <thead class="text-primary">
                                <tr>
                                    
                                    <th>NOMBRE DE LA ACADEMIA</th>
                                    <th>CONDICION</th>
                                    <th>OPCIONES</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                              <tr v-for="cursoacademia in arrayCursoAcademia" :key="cursoacademia.idCursoAcademia">
                                   
                                    <td v-text="cursoacademia.nombre"></td>
                                     <td>
                                         <div  v-if="cursoacademia.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                     <td>
                        
                                        <template v-if="cursoacademia.condicion">
                                            <button type="button" style="border-radius:30px;" class="btn btn-danger btn-sm">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                         <template v-else>
                                            <button type="button" style="border-radius:30px;" class="btn btn-info btn-sm">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                        </div>
                        <div class="col-md-4 pr-1">
                                      <div class="form-group">
                                        <label for="text-input">Academias</label>
                                          <select class="form-control" v-model="idAcademia" name="" id="" @change="verId($event)" >
                                              <option value="0" >Seleccione</option>
                                               <option v-for="academiaa in arrayAcademia" :key="academiaa.idAcademia" :value="academiaa.idAcademia" v-text="academiaa.nombre" ></option>
                                          </select>
                                      </div>
                                       <button type="button" @click="registrarCursoAcademia()" class="btn btn-primary btn-round">
              <i class="icon-plus"></i>&nbsp;Agregar
                        </button>  
                        </div>                        
                        </div>                    
                    </div>
                   </template>

<!-- AQUI ESTA LA SEGUND PANTALLA  -->
              <template v-if="valorCambiar==2">
                      <div class="card-body">
                        <div class="row" style="float:right;">
                           <button type="button" @click="CambiarCursoId2()" class="btn btn-danger " >
                                x
                          </button>  
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">   
                                    <select style="border-top:0px; border-right:0px; border-left:0px;" class="form-control col-md-3" v-model="criterio">
                                      <option value="descripcion">Descripcion</option>
                                      
                                    </select>
                                  <input  type="text" v-model="buscar" @keyup.enter="listarTicket(1,buscar,criterio)" class="form-control ml-4 " style="height:40px; border-top:0px; border-right:0px;" placeholder="Texto a buscar">
                                    <button type="submit" style="border-radius:50px;" @click="listarTicket(1,buscar,criterio)" class="btn btn-primary mt-1 ml-2"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                        <div class=" col-md-7" style="border-right:solid 3px; border-color:#63D9F7;">
                          
                        <table class="table">
                            <thead class="text-primary">
                                <tr>
                                    
                                    <th>NOMBRE DE LA ACADEMIA</th>
                                    <th>PERSONA</th>
                                    <th>CONDICION</th>
                                    <th>OPCIONES</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                              <tr v-for="cursoinstructor in arrayInfoCursoInstructor" :key="cursoacademia.idCursoAcademia">
                                   
                                    <td v-text="cursoinstructor.nombre_academia"></td>
                                    <td v-text="cursoinstructor.nombre_persona"></td>
                                     <td>
                                         <div  v-if="cursoacademia.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                     <td>
                        
                                        <template v-if="cursoacademia.condicion">
                                            <button type="button" style="border-radius:30px;" class="btn btn-danger btn-sm">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                         <template v-else>
                                            <button type="button" style="border-radius:30px;" class="btn btn-info btn-sm">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                        </div>
                        <div class="col-md-4 pr-1">
                                      <div class="form-group">
                                        <label for="text-input">Academia</label>
                                        <label v-model="idCursoAcademiaS" id="aca" v-for="equis in varAcademiaCurso" v-text="equis.idCursoAcademia" ></label>
                                          <select class="form-control" v-model="idAcademia" name="" id="" @change="verId($event)" >
                                              <option value="0" disabled>Seleccione</option>
                                               <option v-for="academiaa in arrayCursoAcademia" :key="academiaa.idAcademia" :value="academiaa.idAcademia" v-text="academiaa.nombre" ></option>
                                          </select>
                                      </div>
                                      
                                       <div class="form-group">
                                        <label for="text-input">Instructores</label>
                                          <select class="form-control"  name="" id=""  @change="getIdCursoAcademias($event)">
                                              <option value="0" >Seleccione</option>
                                               <option v-for="academiaIns in arrayAcademiaInstructor" :key="academiaIns.idPersona" :value="academiaIns.idPersona" v-text="academiaIns.nombre" ></option>
                                          </select>
                                      </div>
                                       <button type="button" @click="registrarCursoInstructor()" class="btn btn-primary btn-round">
              <i class="icon-plus"></i>&nbsp;Agregar
                        </button>  
                        </div>                        
                        </div>                    
                    </div>
                   </template>
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
                                          <input type="number" required min="1"v-model="costo" class="form-control sin" placeholder="Costo" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
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
                arrayAcademia : [],
                valorCambiar : 0,
                idAcademiass : 0,
                arrayCursoAcademia : [],
                mostrarSelectPersonas : 0,
                arrayAcademiaInstructor : [],
                varAcademiaCurso : [],
                idCursoAcademiaS : 0,
                personaCurso : 0,
                varAcad : 0,
                arrayInfoCursoInstructor : []
                
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
          verId(event){
            console.log(event.target.value);
            this.idAcademiass = event.target.value;
              this.selectInfoAcademiaInstructor();
              this.getIdCursoAcademias2();
            
              //this.selectInfoCursoInstructor();
            
          },
          
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
          
          tomar(){
            this.varAcad = document.getElementById("aca").innerHTML;
            console.log("acacacac - " + this.varAcad);
              
          },
          
          selectInfoCursoInstructor(){
                 let me = this;
            //obtener idcursoacademia  
            
                
                axios.put('/cursosinstructores/selectInfoCursoInstructor', {
                  'idCurso' : this.curso_id,
                  'idCursoAcademia' :acad
                }).then(function (response){
                   var respuesta=response.data;
                   me.arrayInfoCursoInstructor = respuesta.cursosinstructores;
                                  
                }).catch(function (error){
                       console.log(error.response);         
               });
            
            
          },
          
          CambiarCursoId(idCurso){
            
             if(this.valorCambiar == 0){
             this.curso_id = idCurso;
             this.valorCambiar = 1;
             this.selectAcademia();
//              console.log('El id del curso es' + '' + this.curso_id);
             this.selectInfoCursoAcademia;
             }
            else{
              this.valorCambiar = 0;
              this.mostrarSelectPersonas = 0;
            }
           
          },
          
          CambiarCursoId2(idCurso){
            
             if(this.valorCambiar == 0){
             this.curso_id = idCurso;
             this.valorCambiar = 2;
             this.selectAcademia();
             console.log('El id del curso es' + '' + this.curso_id);
             this.selectInfoCursoAcademia;
             }
            else{
              this.valorCambiar = 0;
            }
           
          },
          
          selectInfoCursoAcademia(){             
                let me = this;
                 console.log('el id del curso que se envia es ' + this.curso_id)
                axios.put('/cursoacademia/selectInfoCursoAcademia', {
                  'idCurso' : this.curso_id
                }).then(function (response){
                   var respuesta=response.data;
                   me.arrayCursoAcademia = respuesta.cursosacademias;
                                  
                }).catch(function (error){
                       console.log(error.response);         
               });
          },
          
          selectInfoAcademiaInstructor(){  
            
            let me=this;
            var url = '/cursosacademias/getIdCursoAcademia';
            axios.put(url,{'idAcademiass' : me.idAcademiass, 'curso_id' : me.curso_id
                          }).then(function (response){
                   
                     var respuesta=response.data;
                     me.varAcademiaCurso = respuesta.cursosacademias;
                 })
                .catch(function (error){
                       console.log(error);         
               });
            
               
//                 console.log('el id de la academia que se envia es ' + this.academia_id)
                axios.put('/academiainstructor/selectInfoAcademiaInstructor', {
                  'idAcademia' : this.idAcademiass
                }).then(function (response){
                   var respuesta=response.data;
                   me.arrayAcademiaInstructor = respuesta.academiasinstructores;
//                    me.pagination2=respuesta.pagination2;
                     

                               
                }).catch(function (error){
                       console.log(error.response);         
               });
          },
          
          selectAcademia(){
                let me=this;
                 var url = '/academia/selectAcademia';
                 axios.get(url).then(function (response){
                     var respuesta=response.data;
                     me.arrayAcademia = respuesta.academias;
                     me.selectInfoCursoAcademia(); 
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
              me.listarCurso(page, buscar, criterio);
          },
          
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
          
          registrarCursoAcademia(){

            console.log(this.curso_id);
            console.log(this.idAcademiass);
            let me = this;
            axios.post('/cursoacademia/registrar', {
              'idCurso' : this.curso_id,
              'idAcademia' : this.idAcademiass           
            }).then(function (response){
//              me.listarAcademiaInstructor(1, '', 'idPersonass');  
                me.selectInfoCursoAcademia();
            }).catch(function (error){
                   console.log(error.response);         
           });
            
          },
          
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
          
          getIdCursoAcademias(event){
            this.personaCurso = event.target.value;
            console.log("Esta es la Academia: " + this.idAcademiass);
            console.log("Este es el Curso: " + this.curso_id);
            //select para sacar el idCursoAcademia
            //getIdCursoAcademia
            let me=this;
            var url = '/cursosacademias/getIdCursoAcademia';
            axios.put(url,{'idAcademiass' : me.idAcademiass, 'curso_id' : me.curso_id
                          }).then(function (response){
                   
                     var respuesta=response.data;
                     me.varAcademiaCurso = respuesta.cursosacademias;
                 })
                .catch(function (error){
                       console.log(error);         
               });
            
          },
          
          getIdCursoAcademias2(){
            //select para sacar el idCursoAcademia
            let me=this;
            var url = '/cursosacademias/getIdCursoAcademia';
            axios.put(url,{'idAcademiass' : me.idAcademiass, 'curso_id' : me.curso_id
                          }).then(function (response){
                   
                     var respuesta=response.data;
                     me.varAcademiaCurso = respuesta.cursosacademias;
                      me.varAcademiaCurso.forEach(function(element) {
                          console.log("vaaaar - " +element.value);
                        });
                      for (let i=0; i<me.varAcademiaCurso.length; i++) {
                        console.log(me.varAcademiaCurso[i].value);
                        }
                 })
                .catch(function (error){
                       console.log(error);         
               });
            
            
          },
          
          registrarCursoInstructor(){
            var acad = document.getElementById("aca").innerHTML;
            this.varAcad = acad;
            let me = this;
            console.log("agregar - "  + acad);
            //entrar a insertar si esta seleccionada una academia
              var url = '/cursosinstructores/registrarCursoInstructor';
              axios.post(url, {
                'idPersona' : me.personaCurso, 
                'idCursoAcademia' : me.varAcad}).then(function (response){
                  //trae hasta el ultimo registro creado
                  console.log("se agrego");
            }).catch(function (error){
                   console.log(error.response);         
           });
          
          },
          
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
          
          cerrarModal(){
            this.modal = 0;
            this.tituloModal = '';
            this.nombreCurso = '';
            this.costo = '';
            this.fechaInicio = '';
            this.fechaFin = '';
          },
          
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
            this.selectInfoCursoAcademia();
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
