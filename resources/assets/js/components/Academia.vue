<template>
            <div class="content">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                
            </ol>
            
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> ACADEMIAS 
                      <div style="float:right;">
                        
                        <button type="button" @click="abrirModal('academia', 'registrar')" class="btn btn-primary btn-round">
                            <i class="icon-plus"></i>&nbsp;Nueva academia
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
                                      <option value="telefono">Telefono</option>
                                      <option value="estado">Estado</option>
                                    </select>
                                    <input  type="text" v-model="buscar" @keyup.enter="listarAcademia(1,buscar,criterio)" class="form-control ml-4 " style="height:40px; border-top:0px; border-right:0px;" placeholder="Texto a buscar">
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
                                    <th>CONTACTO</th>                       
                                    <th>CONDICION</th>
                                    <th>OPCIONES</th>
                                    <th>INSTRUCTORES</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="academia in arrayAcademia" :key="academia.idAcademia">
                                   
                                    <td v-text="academia.nombre"></td>
                                    <td v-text="academia.telefono"></td>
                                    <td v-text="academia.direccion"></td>
                                    <td v-text="academia.personas_nombre"></td>
            
                                    <td>
                                         <div v-if="academia.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                    <td>
                                        <button type="button" style="border-radius:30px;" class="btn btn-warning btn-sm">
                                          <i @click="abrirModal('academia', 'actualizar', academia)"  class="icon-pencil"></i>
                                        </button> &nbsp;
                                       
                                        <template v-if="academia.condicion">
                                            <button type="button" @click="desactivarAcademia(academia.idAcademia)" style="border-radius:30px;" class="btn btn-danger btn-sm">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                         <template v-else>
                                            <button type="button" @click="activarAcademia(academia.idAcademia)" style="border-radius:30px;" class="btn btn-info btn-sm">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>

                                    </td>
                                    <td>
                                      <button type="button" style="border-radius:30px;" class="btn btn-primary btn-sm">
                 <i @click="academiaInstructorId(academia.idAcademia)"  class="icon-user"></i>
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
                           <button type="button" @click="academiaInstructorId()" class="btn btn-danger " >
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
                                    
                                    <th>NOMBRE DE LA PERSONA</th>
                                    <th>APELLIDO PATERNO</th>
                                    <th>APELLIDO MATERNO</th>
                                    <th>CONDICION</th>
                                    <th>OPCIONES</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                              <tr v-for="academiaInstructor in arrayAcademiaInstructor" :key="academiaInstructor.idAcademiaInstructor">
                                   
                                    <td v-text="academiaInstructor.nombre"></td>
                                    <td v-text="academiaInstructor.apellidoPaterno"></td>
                                    <td v-text="academiaInstructor.apellidoMaterno"></td>
                                     <td>
                                         <div v-if="academiaInstructor.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                     <td>
                        
                                        <template v-if="academiaInstructor.condicion" >
                                            <button type="button" @click="desactivarAcademiaInstructor(academiaInstructor.idAcademiaInstructor)" style="border-radius:30px;" class="btn btn-danger btn-sm">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                         <template v-else >
                                            <button type="button" @click="activarAcademiaInstructor(academiaInstructor.idAcademiaInstructor)" style="border-radius:30px;" class="btn btn-info btn-sm">
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
                                       <button type="button" @click="registrarAcademiaInstructor()" class="btn btn-primary btn-round">
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
<!--                                         <label for="text-input">Nombre de la academia</label> -->
                                        <input type="text" v-model="nombre" class="form-control sin"  placeholder="Nombre">
                                      </div>
                                    </div>
                                    <div class="col-md-3 px-1">
                                      <div class="form-group">
<!--                                         <label for="text-input">Teléfono</label> -->
                                        <input type="text" v-model="telefono" class="form-control sin" placeholder="Telefono" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
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
                                            <button type="button"  v-if="tipoAccion==1" class="btn btn-primary btn-round" @click="registrarAcademia()">Registrar</button>
                                            <button type="button"  v-if="tipoAccion==2" class="btn btn-primary btn-round" @click="actualizarAcademia()">Actualizar</button>
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
                academia_id : 0,
                idContacto : 0,
                valorCambiar : 0,
                idPersonaInfo : 0,
                idPersona : 0,
                nombre : '',
                telefono : '',
                direccion : '',
                estado : '',
                arrayAcademia : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorAcademia : 0,
                errorMostrarMensajesAcademia : [],
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
                criterio2 : 'idAcademia',
                buscar2 : '',
                arrayContacto : [],
                arrayInfoPersona : [],
                arrayPersona : [],
                arrayAcademiaInstructor : [],
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
//          METODO QUE SIRVE PARA CAMBIAR LA VARIABLE ID PERSONAS
          verId(event){
            console.log(event.target.value);
            this.idPersonass = event.target.value;
          },
//             METODO QUE SIRVE PARA LISTAR TODOS LOS REGISTROS QUE HAY EN LA TABLA
          listarAcademia (page, buscar, criterio){
                 let me=this;
                 var url = '/academia?page=' + page + '&buscar='+ buscar + '&criterio=' + criterio;
                 axios.get(url).then(function (response){
                     var respuesta=response.data;
                     me.arrayAcademia = respuesta.academias.data;
                     me.pagination=respuesta.pagination;
                     me.selectInfoAcademiaInstructor();

                 })
                .catch(function (error){
                       console.log(error);         
               });
          },
//            CAMBIA EL VALOR DE LA VARIABLE VALORCAMBIAR PARA MOSTRAR LA VISTA NUEVA
          academiaInstructorId(idAcademia){
            
             if(this.valorCambiar == 0){
             this.academia_id = idAcademia;
             this.valorCambiar = 1;
             this.selectPersona();
//             console.log('El id de academia es' + '' + this.academia_id);
             this.selectInfoAcademiaInstructor();
             }
            else{
              this.valorCambiar = 0;
            }
           
          },
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
          selectInfoAcademiaInstructor(){             
                let me = this;
//                 console.log('el id de la academia que se envia es ' + this.academia_id)
                axios.put('/academiainstructor/selectInfoAcademiaInstructor', {
                  'idAcademia' : this.academia_id
                }).then(function (response){
                   var respuesta=response.data;
                   me.arrayAcademiaInstructor = respuesta.academiasinstructores;
//                    me.pagination2=respuesta.pagination2;
                                     me.selectInfoAcademiaInstructor();

                               
                }).catch(function (error){
                       console.log(error.response);         
               });
          },
//           METODO QUE TRAE LOS REGISTROS DE LA TABLA PERSONAS Y LOS MUETSRA EN UN SELECT 
          selectPersona(){
                let me=this;
                 var url = '/persona/selectPersonas';
                 axios.get(url).then(function (response){
                     var respuesta=response.data;
                     me.arrayPersona = respuesta.personas;
//                      me.pagination=respuesta.pagination;
                                      me.selectInfoAcademiaInstructor();

                 })
                .catch(function (error){
                       console.log(error);         
               });
          },
//           METODO QUE SIRVE PARA REGISTRAR UN NUEVO REGISTRO EN LA TABLA ACADEMIA INSTRUCTOR
          Academiainstructor(){
 
            let me = this;
            axios.post('/academiainstructor/registrar', {
              'idAcademia' : this.academia_id,
              'idInstructor' : this.idPersona
            }).then(function (response){
                me.cerrarModal();
//                 me.listarTicket(1, '', 'idAcademia');
                me.selectInfoAcademiaInstructor();

            }).catch(function (error){
                   console.log(error);         
           });
            
          },
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
//           SIRVE PARA MOSTRAR LA INFORMACION AL MOMENTO DE SELECCIONAR UNA OPCION DENTREO DE UN SELECT 
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
              me.listarAcademia(page, buscar, criterio);
          },
          
//           METODO QUE SIRVE PARA REGISTRAR
          registrarAcademia(){
            
            if(this.validarAcademia()){
              return;
            }
            
            let me = this;
            axios.post('/academia/registrar', {
              'idContacto' : this.idContacto,
              'nombre' : this.nombre,
              'telefono' : this.telefono,
              'direccion' : this.direccion,
              'estado' : this.estado
            }).then(function (response){
                me.cerrarModal();
                me.listarAcademia(1, '', 'nombre');
              
            }).catch(function (error){
                   console.log(error);         
           });
            
          },
//        SIRVE PARA REGISTRAR UN INSTRCUTOR A UNA ACADEMIA
          registrarAcademiaInstructor(){

            let me = this;
            axios.post('/academiainstructor/registrar', {
              'idAcademia' : this.academia_id,
              'idPersona' : this.idPersonass           
            }).then(function (response){
                me.listarAcademiaInstructor(1, '', 'idPersonass');  
                me.selectInfoAcademiaInstructor();
            }).catch(function (error){
                   console.log(error.response);         
           });
            
          },
//           SIRVE PARA ACTUALIZAR UNA ACADEMIA EN LA BD AL ID QUE SE MANDA
          actualizarAcademia(){
                if(this.validarAcademia()){
                  return;
                }

                let me = this;
                axios.put('/academia/actualizar', {
                  'idContacto' : this.idContacto,
                  'nombre' : this.nombre,
                  'telefono' : this.telefono,
                  'direccion' : this.direccion,
                  'estado' : this.estado,
                  'idAcademia' : this.academia_id
                }).then(function (response){
                    me.cerrarModal();
                    me.listarAcademia(1,'', 'nombre');

                }).catch(function (error){
                       console.log(error);         
               });

          },
//           SIRVE PARA DESACTIVAR UN REGISTRO
          desactivarAcademia(idAcademia){
                swal({
                title: 'Esta seguro de desactivar esta academia?',
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
                        'idAcademia': idAcademia
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
           activarAcademia(idAcademia){
                 swal({
                title: 'Esta seguro de activar esta academia?',
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

                    axios.put('/academia/activar',{
                        'idAcademia': idAcademia
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
           desactivarAcademiaInstructor(idAcademiaInstructor){
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

                    axios.put('/academiainstructor/desactivar',{
                        'idAcademiaInstructor': idAcademiaInstructor
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
           activarAcademiaInstructor(idAcademiaInstructor){
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

                    axios.put('/academiainstructor/activar',{
                        'idAcademiaInstructor': idAcademiaInstructor
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
          validarAcademia(){
            this.errorAcademia = 0;
            this.errorMostrarMensajesAcademia = [];
            
            if(!this.nombre){
              this.errorMostrarMensajesAcademia.push("El nombre de la academia no puede estar vacio");
            }
            
            
            if(this.errorMostrarMensajesAcademia.length){
              this.errorAcademia = 1;
            }
            
            return this.errorAcademia;
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
                case "academia":
                  {
                    switch(accion)
                    {
                      case "registrar":
                      {
                        this.modal = 1;
                        this.tituloModal = 'Registrar Academia'
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
                          this.tituloModal = 'Actualizar academia';
                          this.tipoAccion = 2;
                          this.idContacto = data['idContacto'];
                          this.nombre = data['nombre'];
                          this.telefono = data['telefono'];
                          this.direccion = data['direccion'];
                          this.estado = data['estado'];
                          this.academia_id = data['idAcademia'];
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
            this.listarAcademia(1, this.buscar, this.criterio);
             this.selectInfoAcademiaInstructor();
//             this.listarAcademiaInstructor(1, this.buscar2, this.criterio2);
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
