<template>
            <div class="content">

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> INSTRUCTORES DE LA ACADEMIA: 
<!--                       <p v-text="nombre"></p> -->
                      <div style="float:right;">
                        
<!--             <button type="button" @click="abrirModal('ticket', 'registrar')" class="btn btn-primary btn-round">
              <i class="icon-plus"></i>&nbsp;Nuevo instructor
                        </button>                                        -->
<!--                         <button type="button" class="btn btn-info btn-round">
                            <i class="icon-doc"></i>&nbsp;Reporte
                        </button>                         -->
                      </div>
                    </div>
                    <div class="card-body">
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
                              <tr v-for="personaass in arrayAcademia" :key="personaass.idTicket">
                                   
                                    <td v-text="personass.nombre_persona"></td>
                                    <td v-text="personass.apellidoPaterno"></td>
                                    <td v-text="personass.apellidoMaterno"></td>
                                    <td v-text="personass.condicion"></td>
                                    <td>
                                        <div v-if="ticket.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                     <td>
                                        <button type="button" style="border-radius:30px;" class="btn btn-warning btn-sm">
                                                      <i @click="abrirModal('ticket', 'actualizar', ticket)" class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="ticket.condicion">
                                            <button type="button" @click="desactivarTicket(ticket.idTicket)" style="border-radius:30px;" class="btn btn-danger btn-sm">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                         <template v-else>
                                            <button type="button" @click="activarTicket(ticket.idTicket)" style="border-radius:30px;" class="btn btn-info btn-sm">
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
                                          <select class="form-control" v-model="idPersona" name="" id="">
                                              <option value="0" disabled>Seleccione</option>
                                              <option v-for="persona in arrayPersona" :key="persona.idPersona" :value="persona.idPersona" v-text="persona.nombre"></option>
                                          </select>
                                      </div>
                                       <button type="button" @click="abrirModal('ticket', 'registrar')" class="btn btn-primary btn-round">
              <i class="icon-plus"></i>&nbsp;Agregar
                        </button>  
                        </div>
                        
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
                                        <label for="text-input">Persona</label>
                                          <select class="form-control" v-model="idPersona" name="" id="">
                                              <option value="0" disabled>Seleccione</option>
                                              <option v-for="persona in arrayPersona" :key="persona.idPersona" :value="persona.idPersona" v-text="persona.nombre"></option>
                                          </select>
                                      </div>
                                    </div>
                                      <div class="col-md-6 pl-1">
                                        <div class="form-group">
                                          <label for="text-input">Asunto</label>
                                          <input type="text" v-model="asunto" class="form-control" placeholder="Asunto">
                                        </div>
                                      </div>
                                      <div class="col-md-6 pl-1">
                                        <div class="form-group">
                                          <label for="text-input">Descripcion</label>
                                          <input type="text" v-model="descripcion" class="form-control" placeholder="Descripcion">
                                        </div>
                                      </div>
                                      <div class="col-md-6 pl-1">
                                        <div class="form-group">
                                          <label for="text-input">Fecha y hora</label>
                                          <input type="date" v-model="fecha_y_hora" class="form-control" value="<?php echo date();?>">
                                        </div>
                                      </div>
                                </div>
                                    <div v-show="errorTicket" class="form-group row div-error">
                                    <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMensajesTicket" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarTicket()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarTicket()">Actualizar</button>
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
                ticket_id : 0,
                idPersona : 0,
                asunto : '',
                descripcion : '',
                fecha_y_hora : '',
                arrayTicket : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorTicket : 0,
                errorMostrarMensajesTicket : [],
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
                criterio : 'descripcion',
                buscar : '',
                arrayPersona : []
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
          listarTicket (page, buscar, criterio){
                 let me=this;
                 var url = '/ticket?page=' + page + '&buscar='+ buscar + '&criterio=' + criterio;
                 axios.get(url).then(function (response){
                     var respuesta=response.data;
                     me.arrayTicket = respuesta.tickets.data;
                     me.pagination=respuesta.pagination;
                 })
                .catch(function (error){
                       console.log(error.response);         
               });
          },
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
          
          cambiarPagina(page, buscar, criterio){
              let me = this;
              //Actualiza la pagina actual
              me.pagination.current_page = page;
              //Envia la peticion para visualizar la data de esa pagina 
              me.listarTicket(page, buscar, criterio);
          },
          registrarTicket(){
            
            if(this.validarTicket()){
              return;
            }
            
            let me = this;
            axios.post('/ticket/registrar', {
              'idPersona' : this.idPersona,
              'asunto' : this.asunto,
              'descripcion' : this.descripcion,
              'fecha_y_hora' : this.fecha_y_hora
            }).then(function (response){
                me.cerrarModal();
                me.listarTicket(1, '', 'descripcion');
              
            }).catch(function (error){
                   console.log(error);         
           });
            
          },
         
          
          actualizarTicket(){
                if(this.validarTicket()){
                  return;
                }

                let me = this;
                axios.put('/ticket/actualizar', {
                  'idPersona' : this.idPersona,
                  'asunto' : this.asunto,
                  'descripcion' : this.descripcion,
                  'fecha_y_hora' : this.fecha_y_hora,
                  'idTicket' : this.ticket_id
                }).then(function (response){
                    me.cerrarModal();
                    me.listarTicket(1,'', 'descripcion');

                }).catch(function (error){
                       console.log(error);         
               });

          },
          
          desactivarTicket(idTicket){
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

                    axios.put('/ticket/desactivar',{
                        'idTicket': idTicket
                    }).then(function (response) {
                        me.listarTicket(1,'','descripcion');
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
           activarTicket(idTicket){
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

                    axios.put('/ticket/activar',{
                        'idTicket': idTicket
                    }).then(function (response) {
                        me.listarTicket(1,'','descripcion');
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
          
          validarTicket(){
            this.errorTicket = 0;
            this.errorMostrarMensajesTicket = [];
            
            if(!this.idPersona){
              this.errorMostrarMensajesTicket.push("El ID de la persona no puede estar vacio");
            }
            if(!this.asunto){
              this.errorMostrarMensajesTicket.push("El asunto no puede estar vacio");
            }
            if(!this.descripcion){
              this.errorMostrarMensajesTicket.push("La descripcion no puede estar vacia");
            }
            
            
            if(this.errorMostrarMensajesTicket.length){
              this.errorTicket = 1;
            }
            
            return this.errorTicket;
          },
          cerrarModal(){
            this.modal = 0;
            this.tituloModal = '';
            this.idPersona = '';
            this.estado = '';
          },
          abrirModal(modelo, accion, data = []){
              switch(modelo){
                case "ticket":
                  {
                    switch(accion)
                    {
                      case "registrar":
                      {
                        this.modal = 1;
                        this.tituloModal = 'Registrar Ticket'
                        this.idPersona = '';
                        this.asunto = '';
                        this.descripcion = '';
                        this.fecha_y_hora = '';
                        this.tipoAccion = 1;
                        break;
                      }              
                      case "actualizar":
                      {
                          this.modal = 1;
                          this.tituloModal = 'Actualizar Contacto';
                          this.tipoAccion = 2;
                          this.idPersona = data['idPersona'];
                          this.asunto = data['asunto'];
                          this.descripcion = data['descripcion'];
                          this.fecha_y_hora = data['fecha_y_hora'];
                          this.ticket_id = data['idTicket'];
                          break;
                      }
                    }
                  }
              }
          
          }
        },
        
        mounted() {
            this.listarTicket(1, this.buscar, this.criterio);
            this.selectPersona();
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
