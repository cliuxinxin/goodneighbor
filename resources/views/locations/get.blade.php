@extends('app')

@section('content')

   <div class="container">
      {!! Form::open(['url' => url('locations/save')]) !!}

         <div class="form-group">
            {!! Form::submit('提供位置',['class' => 'btn btn-primary form-control','id' => 'getLocation']) !!}
         </div>

      {!! Form::close() !!}
   </div>

@endsection

@section('footer')

   <script>
      var x=document.getElementById("getLocation");
      function getLocation()
      {
         if (navigator.geolocation)
         {
            navigator.geolocation.getCurrentPosition(showPosition);
         }
         else{x.innerHTML="Geolocation is not supported by this browser.";}
      }
      function showPosition(position)
      {
         x.innerHTML="Latitude: " + position.coords.latitude +
                 "<br />Longitude: " + position.coords.longitude;
      }
   </script>

@endsection


