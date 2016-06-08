@extends('app')


@section('content')

   <h1>小区</h1>

   <div class="table-responsive">
       <table id='gardens_table' class="display">
           <thead>
           <tr>
               <th>城市</th>
               <th>小区</th>
               <th>价格</th>
           </tr>
           </thead>
           <tbody>
           @foreach($gardens as $garden)
               <tr>
                   <td>{{ $garden->city }}</td>
                   <td>{{ $garden->name }}</td>
                   <td>{{ $garden->price }}</td>
               </tr>
           @endforeach
           </tbody>
       </table>
   </div>


@endsection

@include('partial.datatable',['table_name'=>'gardens_table','columns'=>'1'])