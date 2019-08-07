<template>
            <div class="content">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                
            </ol>
            
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> CALIFICAR CURSOS 
                      <div style="float:right;">
                        
<!--                         <button type="button" @click="abrirModal('academia', 'registrar')" class="btn btn-primary btn-round">
                            <i class="icon-plus"></i>&nbsp;Nueva academia
                        </button>    -->
                                                            
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
                                      <option value="telefono">Telefono</option>
                                      <option value="estado">Estado</option>
                                    </select>
                                    <input  type="text" v-model="buscar" @keyup.enter="listarCalifCurso(1,buscar,criterio)" class="form-control ml-4 " style="height:40px; border-top:0px; border-right:0px;" placeholder="Texto a buscar">
                                    <button type="submit" style="border-radius:50px;" @click="listarCalifCurso(1,buscar,criterio)" class="btn btn-primary mt-1 ml-2"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <tr>
                                    
                                    <th>CURSO</th>
                                    <th>ACADEMIA</th>                       
                                    <th>CONDICION</th>
                                    <th>OPCIONES</th>
                                    <th>INSTRUCTORES</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="califCurso in arrayCalifCurso" :key="califCurso.idCursoInstructor">
                                   
                                    <td v-text="califCurso.nombre"></td>
                                    <td v-text="califCurso.telefono"></td>
                                    <td v-text="califCurso.direccion"></td>
                                    <td v-text="califCurso.personas_nombre"></td>
            
                                    <td>
                                         <div v-if="califCurso.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                    <td>
                                        <button type="button" style="border-radius:30px;" class="btn btn-warning btn-sm">
                                          <i @click="abrirModal('califCurso', 'actualizar', califCurso)"  class="icon-pencil"></i>
                                        </button> &nbsp;
                                       
                                        <template v-if="califCurso.condicion">
                                            <button type="button" @click="desactivarCalifCurso(califCurso.idCalifCurso)" style="border-radius:30px;" class="btn btn-danger btn-sm">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                         <template v-else>
                                            <button type="button" @click="activarCalifCurso(califCurso.idCalifCurso)" style="border-radius:30px;" class="btn btn-info btn-sm">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>

                                    </td>
                                    <td>
                                      <button type="button" style="border-radius:30px;" class="btn btn-primary btn-sm">
                 <i @click="califCursoInstructorId(califCurso.idCalifCurso)"  class="icon-user"></i>
                                        </button> &nbsp;
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                        </div>
                        <nav>
                         <br>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1" >
                                    <a class="page-link" style="border-radius:30px;" href="#"  @click.prevent="cambiarPagina(pagination.current_page - 1, buscar, criterio)" >Ant</a>
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
                           <button type="button" @click="califCursoInstructorId()" class="btn btn-danger " >
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
                                    
                                    <th>CURSO</th>
                                    <th>ACADEMIA</th>
                                    <th>CONDICION</th>
                                    <th>OPCIONES</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                              <tr v-for="califCursoInstructor in arrayCalifCurso" :key="califCursoInstructor.idCalifCursoInstructor">
                                   
                                    <td v-text="califCursoInstructor.nombre_curso"></td>
                                    <td v-text="califCursoInstructor.nombre_academia"></td>
                                     <td>
                                         <div v-if="califCursoInstructor.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                     <td>
                        
                                        <template v-if="califCursoInstructor.condicion" >
                                            <button type="button" @click="desactivarCalifCursoInstructor(califCursoInstructor.idCalifCursoInstructor)" style="border-radius:30px;" class="btn btn-danger btn-sm">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                         <template v-else >
                                            <button type="button" @click="activarCalifCursoInstructor(califCursoInstructor.idCalifCursoInstructor)" style="border-radius:30px;" class="btn btn-info btn-sm">
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
                                        <label for="text-input">Persona</label>
                                          <select class="form-control" v-model="idPersona" name="" id="" @change="verId($event)" >
                                              <option value="0" disabled>Seleccione</option>
                                               <option v-for="person in arrayPersona" :key="person.idPersona" :value="person.idPersona" v-text="person.nombre" ></option>
                                          </select>
                                      </div>
                                       <button type="button" @click="registrarCalifCursoInstructor()" class="btn btn-primary btn-round">
              <i class="icon-plus"></i>&nbsp;Agregar
                        </button>  
                        </div>
                        
                        </div>
                        

                    </div>
    </template>

</div>                <!-- Fin ejemplo de tabla Listado -->
</div>


            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
              
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">                            
                        <div class="col-md-4">
                                <div class="card card-user">
                                      <div class="button-container">
                                            
                                          </div>
                                        <div class="image">                               
                                          <img src="admin/assets/img/fondo1.jpg" alt="">
                                        </div>
                                        <div class="card-body">
                                          <div class="author">
                                            <a href="#">
                                              <img class="avatar border-gray" src="admin/assets/img/default-avatar.png" alt="...">
                                              <h5  v-for="personaa in arrayInfoPersona" v-text="personaa.nombre" class="title"></h5>
                                            </a>
                                            <p v-for="personaa in arrayInfoPersona" v-text="personaa.email" class="description"></p>
                                          </div>
                                          <p v-for="personaa in arrayInfoPersona" v-text="personaa.direccion" class="description text-center"></p>
                                          <p v-for="personaa in arrayInfoPersona" v-text="personaa.telefono" class="description text-center"></p>
                                        </div>
                                        <div class="card-footer">
                                          <hr>
                                          <h5 align="center" class="title">Contacto</h5>
                                        </div>
                                    </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card card-user">
                                    <div class="card-header">
                                         <h5  v-text="tituloModal" class="card-title"></h5>
                                    </div>
                                <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="row">
                                    <div class="col-md-7 pr-1">
                                      <div class="form-group">
<!--                                         <label for="text-input">Nombre de la califCurso</label> -->
                                        <input type="text" v-model="nombre" class="form-control sin"  placeholder="Nombre">
                                      </div>
                                    </div>
                                    <div class="col-md-3 px-1">
                                      <div class="form-group">
<!--                                         <label for="text-input">Teléfono</label> -->
                                        <input type="text" v-model="telefono" class="form-control sin" placeholder="Telefono">
                                      </div>
                                    </div>         
                                </div>
                                  <div class="row">
                                      <div class="col-md-6 pr-1">
                                        <div class="form-group">
<!--                                           <label for="text-input">Direccion</label> -->
                                          <input type="text" v-model="direccion" class="form-control sin" placeholder="Direccion" >
                                        </div>
                                      </div>
                                      <div class="col-md-6 pl-1">
                                        <div class="form-group">
<!--                                           <label for="text-input">Estado</label> -->
                                          <input type="text" v-model="estado" class="form-control sin" placeholder="Estado">
                                        </div>
                                      </div>
                                </div>
                                <div class="row">
                                   &nbsp&nbsp<div class="col-md-3 px-1">
                                      <div class="form-group">
                                           &nbsp&nbsp<label for="text-input">Contacto</label>
                                          <select class="form-control sin" v-model="idContacto" name="" id="" @change="selectInfoContacto($event)">
                                              <option value="0" disabled>Seleccione</option>
                                              <option v-for="contacto in arrayContacto" :key="contacto.idContacto" :value="contacto.idContacto" v-text="contacto.nombre" v-model="idPersonaInfo"></option>
                                          </select>
                                            
<!--                                          <input type="text" v-model="idPersona" class="form-control"  placeholder="Persona"> -->
                                      </div>
                                      </div>
                                </div>
                                                   
                              <div class="row">
                                    <div class="update ml-auto mr-auto">
                                            <button type="button"  v-if="tipoAccion==1" class="btn btn-primary btn-round" @click="registrarCalifCurso()">Registrar</button>
                                            <button type="button"  v-if="tipoAccion==2" class="btn btn-primary btn-round" @click="actualizarCalifCurso()">Actualizar</button>
                                          </div> 
                              </div>
                                <div v-show="errorCalifCurso" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMensajesCalifCurso" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"       @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>           
         </div> <!-- AQUI TERMINA EL PRIMER MODAL  -->

        
</template>

<script>
    export default {
        data (){
            return {
//                 variables que se usan para almacenar la informacion 
                califCurso_id : 0,
                idContacto : 0,
                valorCambiar : 0,
                idPersonaInfo : 0,
                idPersona : 0,
                nombre : '',
                telefono : '',
                direccion : '',
                estado : '',
                arrayCalifCurso : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorCalifCurso : 0,
                errorMostrarMensajesCalifCurso : [],
                pagination : 
                {
                    'total'        : 0,
                    'current_page' : 0,
                    'per_page'     : 0,
                    'last_page'    : 0,
                    'from'         : 0,
                    'to'           : 0,
                },
                pagination2 :
                { 
                    'total2'          : 0,
                    'current_page2' : 0,
                    'per_page2'     : 0,
                    'last_page2'    : 0,
                    'from2'         : 0,
                    'to2'           : 0,
                },
                offset : 3,
                offset2 : 3,
                criterio : 'nombre',
                buscar : '',
                criterio2 : 'idCalifCurso',
                buscar2 : '',
                arrayContacto : [],
                arrayInfoPersona : [],
                arrayPersona : [],
                arrayCalifCursoInstructor : [],
                idPersonass : 0
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
          //          METODO QUE SIRVE PARA CAMBIAR LA VBBARIABLE ID PERSONAS
          verId(event){
            console.log(event.target.value);
            this.idPersonass = event.target.value;
          },
          //             METODO QUE SIRVE PARA LISTAR TODOS LOS REGISTROS QUE HAY EN LA TABLA
          listarCalifCurso (page, buscar, criterio){
                 let me=this;
                 var url = '/califCurso?page=' + page + '&buscar='+ buscar + '&criterio=' + criterio;
                 axios.get(url).then(function (response){
                     var respuesta=response.data;
                     me.arrayCalifCurso = respuesta.cursosinstructores.data;
                     me.pagination=respuesta.pagination;
                     me.selectInfoCalifCursoInstructor();

                 })
                .catch(function (error){
                       console.log(error);         
               });
          },
//            CAMBIA EL VALOR DE LA VARIABLE VALORCAMBIAR PARA MOSTRAR LA VISTA NUEVA
//           califCursoInstructorId(idCalifCurso){
            
//              if(this.valorCambiar == 0){
//              this.califCurso_id = idCalifCurso;
//              this.valorCambiar = 1;
//              this.selectPersona();
// //             console.log('El id de califCurso es' + '' + this.califCurso_id);
//              this.selectInfoCalifCursoInstructor();
//              }
//             else{
//               this.valorCambiar = 0;
//             }
           
//           },
          //           METODO QUE SIRVE PARA MOSTRAR LOS CONTACTOS DENTRO DE UN SELECT
          selectContacto(){
                let me=this;
                 var url = '/contacto/selectContacto';
                 axios.get(url).then(function (response){
                     var respuesta=response.data;
                     me.arrayContacto = respuesta.contactos;

                 })
                .catch(function (error){
                       console.log(error);         
               });
            
           
          },
          //           METODO QUE TRAE LA INFORMACION DE LOS INSTRCUTORES QUE ESTAN ASIGNADOS A UNA ACADEMIA Y LO GUARDA EN UNA VARIABLE PARA MOSTRAR EN UN SELECT
//           selectInfoCalifCursoInstructor(){             
//                 let me = this;
// //                 console.log('el id de la califCurso que se envia es ' + this.califCurso_id)
//                 axios.put('/califCursoinstructor/selectInfoCalifCursoInstructor', {
//                   'idCalifCurso' : this.califCurso_id
//                 }).then(function (response){
//                    var respuesta=response.data;
//                    me.arrayCalifCursoInstructor = respuesta.califCursosinstructores;
// //                    me.pagination2=respuesta.pagination2;
//                                      me.selectInfoCalifCursoInstructor();

                               
//                 }).catch(function (error){
//                        console.log(error.response);         
//                });
//           },
          //           METODO QUE TRAE LOS REGISTROS DE LA TABLA Y LOS MUETSRA EN UN SELECT 
          selectPersona(){
                let me=this;
                 var url = '/persona/selectPersonas';
                 axios.get(url).then(function (response){
                     var respuesta=response.data;
                     me.arrayPersona = respuesta.personas;
//                      me.pagination=respuesta.pagination;
                                      me.selectInfoCalifCursoInstructor();

                 })
                .catch(function (error){
                       console.log(error);         
               });
          },
          //           METODO QUE SIRVE PARA REGISTRAR UN NUEVO REGISTRO EN LA TABLA
//           CalifCursoinstructor(){
 
//             let me = this;
//             axios.post('/califCursoinstructor/registrar', {
//               'idCalifCurso' : this.califCurso_id,
//               'idInstructor' : this.idPersona
//             }).then(function (response){
//                 me.cerrarModal();
// //                 me.listarTicket(1, '', 'idCalifCurso');
//                 me.selectInfoCalifCursoInstructor();

//             }).catch(function (error){
//                    console.log(error);         
//            });
            
//           },
          //           METODO UTILIZADO PARA MOSTRAR LA INFORMACION EN EL MODAL, ESTA INFORMACION ES LA DE LAS PERSONAS Y SE ,MUESTRA EN BASE A LA PERSONA QUE HA SIDO SELECCIONADA 
          selectInfoContactoUp(id){
//                 console.log(id);
                let me = this;
                axios.get('/contacto/selectInfoContacto', {
                  'idContacto' : id
                }).then(function (response){
                   var respuesta=response.data;
                   me.arrayInfoPersona = respuesta.contactos;
                   console.log(me.arrayInfoPersona);
                }).catch(function (error){
                       console.log(error);         
               });
          },
          //           SIRVE PARA MOSTRAR LA INFORMACION AL MOMENTO DE SELECCIONAR UNA OPCION DENTRO DE UN SELECT 
           selectInfoContacto(event){
//                 console.log(event.target.value);
                let me = this;
                axios.put('/contacto/selectInfoContacto', {
                  'idContacto' : event.target.value
                }).then(function (response){
                   var respuesta=response.data;
                   me.arrayInfoPersona = respuesta.contactos;
                   
                   
                }).catch(function (error){
                       console.log(error);         
               });
          },
          //           CAMBIA LA PAGINA DENTRO DE LA TABLA PARA MOSTRAR LOS DEMAS REGISTROS
          cambiarPagina(page, buscar, criterio){
              let me = this;
              //Actualiza la pagina actual
              me.pagination.current_page = page;
              //Envia la peticion para visualizar la data de esa pagina 
              me.listarCalifCurso(page, buscar, criterio);
          },
          //           METODO QUE SIRVE PARA REGISTRAR UNA ACADEMIA
          registrarCalifCurso(){
            
            if(this.validarCalifCurso()){
              return;
            }
            
            let me = this;
            axios.post('/califCurso/registrar', {
              'idContacto' : this.idContacto,
              'nombre' : this.nombre,
              'telefono' : this.telefono,
              'direccion' : this.direccion,
              'estado' : this.estado
            }).then(function (response){
                me.cerrarModal();
                me.listarCalifCurso(1, '', 'nombre');
              
            }).catch(function (error){
                   console.log(error);         
           });
            
          },
          //        SIRVE PARA REGISTRAR UN INSTRCUTOR A UNA ACADEMIA
          registrarCalifCursoInstructor(){
            
            

            let me = this;
            axios.post('/califCursoinstructor/registrar', {
              'idCalifCurso' : this.califCurso_id,
              'idPersona' : this.idPersonass           
            }).then(function (response){
                me.listarCalifCursoInstructor(1, '', 'idPersonass');  
                me.selectInfoCalifCursoInstructor();
            }).catch(function (error){
                   console.log(error.response);         
           });
            
          },
          //           SIRVE PARA ACTUALIZAR UNA ACADEMIA EN BASE AL ID QUE SE MANDA
          actualizarCalifCurso(){
                if(this.validarCalifCurso()){
                  return;
                }

                let me = this;
                axios.put('/califCurso/actualizar', {
                  'idContacto' : this.idContacto,
                  'nombre' : this.nombre,
                  'telefono' : this.telefono,
                  'direccion' : this.direccion,
                  'estado' : this.estado,
                  'idCalifCurso' : this.califCurso_id
                }).then(function (response){
                    me.cerrarModal();
                    me.listarCalifCurso(1,'', 'nombre');

                }).catch(function (error){
                       console.log(error);         
               });

          },
          //           SIRVE PARA DESACTIVAR UN REGISTRO
          desactivarCalifCurso(idCalifCurso){
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

                    axios.put('/persona/desactivar',{
                        'idCalifCurso': idCalifCurso
                    }).then(function (response) {
                        me.listarPersona(1,'','nombre');
                        swal(
                        'Desactivado!',
                        'La persona ha sido desactivado con éxito.',
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
          //           SIRVE PARA ACTIVAR UN REGISTRO
           activarCalifCurso(idCalifCurso){
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

                    axios.put('/califCurso/activar',{
                        'idCalifCurso': idCalifCurso
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
          //           SIRVE PARA DESACTIVAR UN REGISTRO
           desactivarCalifCursoInstructor(idCalifCursoInstructor){
                swal({
                title: 'Esta seguro de desactivar este instrcutor?',
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

                    axios.put('/califCursoinstructor/desactivar',{
                        'idCalifCursoInstructor': idCalifCursoInstructor
                    }).then(function (response) {
                        me.listarPersona(1,'','nombre');
                        swal(
                        'Desactivado!',
                        'El instructor ha sido desactivado con éxito.',
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
          //           SIRVE PARA ACTIVAR UN REGISTRO
           activarCalifCursoInstructor(idCalifCursoInstructor){
                 swal({
                title: 'Esta seguro de activar este instrcutor?',
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

                    axios.put('/califCursoinstructor/activar',{
                        'idCalifCursoInstructor': idCalifCursoInstructor
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
          //           SIRVE PARA VALIDAR LOS DATOS INGRESADOS EN EL MODAL
          validarCalifCurso(){
            this.errorCalifCurso = 0;
            this.errorMostrarMensajesCalifCurso = [];
            
            if(!this.nombre){
              this.errorMostrarMensajesCalifCurso.push("El nombre de la academia no puede estar vacio");
            }
            
            
            if(this.errorMostrarMensajesCalifCurso.length){
              this.errorCalifCurso = 1;
            }
            
            return this.errorCalifCurso;
          },
          //           SIRVE PARA CERRAR EL MODAL
          cerrarModal(){
            this.modal = 0;
            this.tituloModal = '';
            this.nombre = '';
            this.idContacto = 0;
            this.direccion = '';
            this.telefono = '';
            this.estado = '';
            this.arrayInfoPersona = [];
          },
          //           SIRVE PARA ABRIR EL MODAL
          abrirModal(modelo, accion, data = []){
              switch(modelo){
                case "califCurso":
                  {
                    switch(accion)
                    {
                      case "registrar":
                      {
                        this.modal = 1;
                        this.tituloModal = 'Registrar CalifCurso'
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
                          this.tituloModal = 'Actualizar califCurso';
                          this.tipoAccion = 2;
                          this.idContacto = data['idContacto'];
                          this.nombre = data['nombre'];
                          this.telefono = data['telefono'];
                          this.direccion = data['direccion'];
                          this.estado = data['estado'];
                          this.califCurso_id = data['idCalifCurso'];
                          break;
                      }
                    }
                  }
              }
            this.selectContacto();
            this.selectInfoContactoUp(this.idContacto);
            
            
          }
        },
        
        mounted() {
            this.listarCalifCurso(1, this.buscar, this.criterio);
//              this.selectInfoCalifCursoInstructor();
//             this.listarCalifCursoInstructor(1, this.buscar2, this.criterio2);
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
