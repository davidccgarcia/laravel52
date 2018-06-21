<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Styde.net | Curso de VueJS</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.22/vue.min.js"></script>

    </head>
    <body id="app">
    @php ($saludo = 'Bienvenido a Styde')

    <h1>{{ $saludo }}</h1>

    {{-- @unset($saludo)

    <p>{{ $saludo }}</p> --}}

    @php
        $saludo = 'Hola, soy David';

        echo $saludo;
    @endphp
    @verbatim
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            Las variables en Blade se definen de esta forma: {{ $variable }}

            @if () 

            @foreach ()
        </div>
    </div>
    @endverbatim

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            Las variables en Blade se definen de esta forma: @{{ $variable }}
    
            @@if () 
    
            @@foreach ()
        </div>
    </div>
    </body>
</html>