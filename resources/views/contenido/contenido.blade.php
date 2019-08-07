    @extends('principal')
    @section('contenido')

    @if(Auth::check())
            @if (Auth::user()->idrol == 1)
            <template v-if="menu==0">
                <dashboard :ruta="ruta"></dashboard>
            </template>

            <template v-if="menu==1">            
                <categoria :ruta="ruta"></categoria>
            </template>

            <template v-if="menu==2">
                <persona :ruta="ruta"></persona>
            </template>

            <template v-if="menu==3">
                <contacto :ruta="ruta"></contacto>
            </template>
  
            <template v-if="menu==5">
                <curso :ruta="ruta"></curso>
            </template>

            <template v-if="menu==6">
                <ticket :ruta="ruta"></ticket>
            </template>

            <template v-if="menu==4">
                <actividad :ruta="ruta"></actividad>
            </template>

            <template v-if="menu==14">
                <instructor :ruta="ruta"></instructor>
            </template>

            <template v-if="menu==8">
                <rol :ruta="ruta"></rol>
            </template>

            <template v-if="menu==9">
                <user :ruta="ruta"></user>
            </template>

            <template v-if="menu==20">
                <calificarcursos :ruta="ruta"></calificarcursos>
            </template>

            <template v-if="menu==10">
                <consultaventa :ruta="ruta"></consultaventa>
            </template>

            <template v-if="menu==11">
                <ayuda></ayuda>
            </template>

            <template v-if="menu==12">
                <acerca></acerca>
            </template>
            <template v-if="menu==13">
              <academia></academia> 
            </template>
            @elseif (Auth::user()->idrol == 2)
            <template v-if="menu==0">
                <dashboard :ruta="ruta"></dashboard>
            </template>
             <template v-if="menu==13">
              <academia></academia> 
            </template>
            <template v-if="menu==6">
                <ticket :ruta="ruta"></ticket>
            </template>
          
            @endif

    @endif
       
        
    @endsection