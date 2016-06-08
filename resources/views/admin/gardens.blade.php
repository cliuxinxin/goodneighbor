@extends('app')


@section('content')

   <h1>小区</h1>

   <a class="btn btn-lg btn-default" href="{{ url('admin/gardens/create') }}">新建小区</a>

   <div class="table-responsive">
       <table id='gardens_table' class="display">
           <thead>
           <tr>
               <th>城市</th>
               <th>小区</th>
               <th>价格</th>
               <th>删除</th>
           </tr>
           </thead>
           <tbody>
           @foreach($gardens as $garden)
               <tr>
                   <td>{{ $garden->city }}</td>
                   <td>{{ $garden->name }}</td>
                   <td>{{ $garden->price }}</td>
                   <td>
                       {!! Form::open(['url' => 'admin/gardens/delete/'.$garden->id,'method' => 'DELETE']) !!}
                       {!! Form::submit('删除',['class' => 'btn btn-primary form-control']) !!}
                       {!! Form::close() !!}

                   </td>
               </tr>
           @endforeach
           </tbody>
       </table>
   </div>


@endsection

@include('partial.datatable',['table_name'=>'gardens_table','columns'=>'1'])