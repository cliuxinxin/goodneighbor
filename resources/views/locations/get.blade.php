@extends('app')

@section('content')

   <div class="container">
      {!! Form::open(['url' => url('locations/save')]) !!}

         <div class="form-group">
            {{ Form::hidden('latitude', '0') }}
         </div>

         <div class="form-group">
            {{ Form::hidden('longitude', '0') }}
         </div>

         <div class="form-group">
            {!! Form::submit('提供位置',['class' => 'btn btn-primary form-control','onclick' => 'getLocation()']) !!}
         </div>

      {!! Form::close() !!}
   </div>

@endsection

@section('footer')

   <script>
      f = document.forms[0];
      latitude = f.latitude;
      longitude = f.longitude;

      function getLocation()
      {
         if (navigator.geolocation)
         {
            navigator.geolocation.getCurrentPosition(showPosition);
         }
         else{ latitude = "Geolocation is not supported by this browser.";}
      }

      function showPosition(position)
      {
         latitude =  position.coords.latitude;
         longitude = position.coords.longitude;
      }
   </script>

@endsection


