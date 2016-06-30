@extends('app')

@section('content')

   <div class="container">
      {!! Form::open(['url' => url('locations/save')]) !!}

         <div class="form-group">
            {{ Form::hidden('latitude', '0',['id' => 'latitude']) }}
         </div>

         <div class="form-group">
            {{ Form::hidden('longitude', '0',['id' => 'longitude']) }}
         </div>

         <div class="form-group">
            {!! Form::submit('提供位置',['class' => 'btn btn-primary form-control','onclick' => 'getLocation()']) !!}
         </div>

      {!! Form::close() !!}
   </div>


@endsection

@section('footer')

   <script>
      var latitude = document.getElementById("latitude");
      var longitude = document.getElementById("longitude");

      function getLocation()
      {
         if (navigator.geolocation)
         {
            navigator.geolocation.getCurrentPosition(showPosition);
            alert(latitude.value);
         }
         else{
            latitude.value = "Geolocation is not supported by this browser.";}
      }

      function showPosition(position)
      {
         latitude.value =  position.coords.latitude;
         longitude.value = position.coords.longitude;
      }
   </script>

@endsection


