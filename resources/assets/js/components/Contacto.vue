<template>
            <div class="content">

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
          <i class="fa fa-align-justify"></i> CONTACTOS 
                      <div style="float:right;">
                        
            <button type="button" @click="abrirModal('contacto', 'registrar')" class="btn btn-primary btn-round">
              <i class="icon-plus"></i>&nbsp;Nuevo contacto
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
<!--                                       <option value="nombre">Nombre persona</option> -->
                                   
                                      <option value="estado">Estado</option>
                                    </select>
                                  <input  type="text" v-model="buscar" @keyup.enter="listarContacto(1,buscar,criterio)" class="form-control ml-4 " style="height:40px; border-top:0px; border-right:0px;" placeholder="Texto a buscar">
                                    <button type="submit" style="border-radius:50px;" @click="listarContacto(1,buscar,criterio)" class="btn btn-primary mt-1 ml-2"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <tr>
                                    
                                    <th>NOMBRE DE LA PERSONA</th>
                                    <th>ESTADO</th>
                                    <th>CONDICION</th>
                                    <th>OPCIONES</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                  <tr v-for="contacto in arrayContacto" :key="contacto.idContacto">
                                   
                                    
                                    <td v-text="contacto.nombre"></td>
                                    <td v-text="contacto.estado"></td>
                                    <td>
                                         <div v-if="contacto.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                     <td>
                                        <button type="button" style="border-radius:30px;" class="btn btn-warning btn-sm">
                                                      <i @click="abrirModal('contacto', 'actualizar', contacto)" class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="contacto.condicion">
                                            <button type="button" @click="desactivarContacto(contacto.idContacto)" style="border-radius:30px;" class="btn btn-danger btn-sm">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                         <template v-else>
                                            <button type="button" @click="activarContacto(contacto.idContacto)" style="border-radius:30px;" class="btn btn-info btn-sm">
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
                        <div class="modal-body">
                            <div class="row">
                        <div class="col-md-4">
                                <div class="card card-user">
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
                                          <div class="button-container">
                                            <h5 align="center" class="title">Persona</h5>
                                          </div>
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
                                    <div class="col-md-5 pr-1">
                                      <div class="form-group">
                                        <label for="text-input">Persona</label>
                                          <select class="form-control sin" v-model="idPersona" name="" id="" @change="selectInfoPersona($event)">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="persona in arrayPersona" :key="persona.idPersona" :value="persona.idPersona" v-text="persona.nombre"></option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-md-6 pl-1">
                                      <div class="form-group">
                                        <label for="text-input"></label>
                                        <input type="text" v-model="estado" class="form-control sin" placeholder="Estado">
                                      </div>
                                    </div>     
                                      
                                </div>
                               
                                                   
                              <div class="row">
                                    <div class="update ml-auto mr-auto">
                                            <button type="button"  v-if="tipoAccion==1" class="btn btn-primary btn-round" @click="registrarContacto()">Registrar</button>
                                            <button type="button"  v-if="tipoAccion==2" class="btn btn-primary btn-round" @click="actualizarContacto()">Actualizar</button>
                                          </div> 
                              </div>
                                <div v-show="errorContacto" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMensajesContacto" :key="error" v-text="error">

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
              //                 variables que se usan para almacenar la informacion 

                contacto_id : 0,
                idPersona : 0,
                estado : '',
                arrayContacto : [],
                modal : 0,
                nombre_persona : '',
                tituloModal : '',
                tipoAccion : 0,
                errorContacto : 0,
                errorMostrarMensajesContacto : [],
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
                criterio : 'estado',
                buscar : '',
                arrayPersona : [],
                arrayInfoPersona : []
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
//           sirve par alistar los contactos de la tabla contactos
          listarContacto (page, buscar, criterio){
                 let me=this;
                 var url = '/contacto?page=' + page + '&buscar='+ buscar + '&criterio=' + criterio;
                 axios.get(url).then(function (response){
                     var respuesta=response.data;
                     me.arrayContacto = respuesta.contactos.data;
                     me.pagination=respuesta.pagination;
                 })
                .catch(function (error){
                       console.log(error.response);         
               });
          },
//           SIRVE PARA MOSTRRAR LAS PERSONAS EN UN SELECT 
          selectPersona(){
                let me=this;
                 var url = '/persona/selectPersonas';
                 axios.get(url).then(function (response){
                     var respuesta=response.data;
                     me.arrayPersona = respuesta.personas;
//                      me.pagination=respuesta.pagination;
                 })
                .catch(function (error){
                       console.log(error);         
               });
          },
//           METODO QUE SIRVE PARA MOSTRAR LA INFORMACION DE LAS PERSONAS 
          selectInfoPersonaUp(id){
                console.log(id);
                let me = this;
                axios.put('/persona/selectInfoPersona', {
                  'idPersona' : id
                }).then(function (response){
                   var respuesta=response.data;
                   me.arrayInfoPersona = respuesta.personas;
                   console.log(me.arrayInfoPersona);
                }).catch(function (error){
                       console.log(error);         
               });
          },
//           METODO QUE SIRVE PARA MOSTRAR LA INFORMACION DE LAS PERSONAS  
           selectInfoPersona(event){
                console.log(event.target.value);
                let me = this;
                axios.put('/persona/selectInfoPersona', {
                  'idPersona' : event.target.value
                }).then(function (response){
                   var respuesta=response.data;
                   me.arrayInfoPersona = respuesta.personas;
                   
                   
                }).catch(function (error){
                       console.log(error);         
               });
          },
//           METODO QUE SIRVE PARA MOSTRAR LAS PAGINAS DE LOS REGISTROS 
          cambiarPagina(page, buscar, criterio){
              let me = this;
              //Actualiza la pagina actual
              me.pagination.current_page = page;
              //Envia la peticion para visualizar la data de esa pagina 
              me.listarContacto(page, buscar, criterio);
          },
//           METODO QUE SIRVE PARA REGISTRAR LOS CONTACTOS 
          registrarContacto(){
            
            if(this.validarContacto()){
              return;
            }
            
            let me = this;
            axios.post('/contacto/registrar', {
              'idPersona' : this.idPersona,
              'estado' : this.estado
            }).then(function (response){
                me.cerrarModal();
                me.listarContacto(1, '', 'estado');
              
            }).catch(function (error){
                   console.log(error);         
           });
            
          },
          
//           METODO QUE SIRVE PARA ACTUALIZAR LOS CONTACTOS
          actualizarContacto(){
                if(this.validarContacto()){
                  return;
                }

                let me = this;
                axios.put('/contacto/actualizar', {
                  'idPersona' : this.idPersona,
                  'estado' : this.estado,
                  'idContacto' : this.contacto_id
                }).then(function (response){
                    me.cerrarModal();
                    me.listarContacto(1,'', 'estado');

                }).catch(function (error){
                       console.log(error);         
               });

          },
          
//           METODO QUE SIRVE PARA DESACTIVAR LOS CONTACTOS
          desactivarContacto(idContacto){
                swal({
                title: 'Esta seguro de desactivar esta persona?',
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

                    axios.put('/contacto/desactivar',{
                        'idContacto': idContacto
                    }).then(function (response) {
                        me.listarContacto(1,'','estado');
                        swal(
                        'Desactivado!',
                        'El contacto ha sido desactivado con éxito.',
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
//           METODO QUE SIRVE PARA ACTIVAR LOS CONTACTOS
           activarContacto(idContacto){
                 swal({
                title: 'Esta seguro de activar esta persona?',
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

                    axios.put('/contacto/activar',{
                        'idContacto': idContacto
                    }).then(function (response) {
                        me.listarContacto(1,'','estado');
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
          
//           METODO QUE SIRVE PARA VALIDAR CONTACOS
          validarContacto(){
            this.errorContacto = 0;
            this.errorMostrarMensajesContacto = [];
            
            if(!this.idPersona){
              this.errorMostrarMensajesContacto.push("El nombre de la persona no puede estar vacio");
            }
            if(!this.estado){
              this.errorMostrarMensajesContacto.push("El estado del contacto no puede estar vacio");
            }
            
            
            if(this.errorMostrarMensajesContacto.length){
              this.errorContacto = 1;
            }
            
            return this.errorContacto;
          },
//           METODOQ EU SIRVE PARA CEERRAR EL MODAL 
          cerrarModal(){
            this.modal = 0;
            this.tituloModal = '';
            this.idPersona = '';
            this.estado = '';
          },
//           METODO QUE SIRVE PARA RBIR EL MODAL 
          abrirModal(modelo, accion, data = []){
              switch(modelo){
                case "contacto":
                  {
                    switch(accion)
                    {
                      case "registrar":
                      {
                        this.modal = 1;
                        this.tituloModal = 'Registrar Contacto'
                        this.idPersona = '';
                        this.estado = '';
                        this.tipoAccion = 1;
                        break;
                      }              
                      case "actualizar":
                      {
                          this.modal = 1;
                          this.tituloModal = 'Actualizar Contacto';
                          this.tipoAccion = 2;
                          this.idPersona = data['idPersona'];
                          this.estado = data['estado'];
                          this.contacto_id = data['idContacto'];
                          break;
                      }
                    }
                  }
              }
            this.selectPersona();
            this.selectInfoPersonaUp(this.idPersona);
          }
        },
        
        mounted() {
            this.listarContacto(1, this.buscar, this.criterio);
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
