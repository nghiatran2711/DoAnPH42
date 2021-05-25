@extends('admin.layouts.master')
@section('content')
    <div class="header"> 
        <h1 class="page-header">
            Create Brand <small>Best form elements.</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Brand</a></li>
            <li class="active">create brand</li>
        </ol> 							
	</div>
    <div id="page-inner"> 
        <div class="row">
         <div class="col-xs-12">
             <div class="panel panel-default">
                 <div class="panel-heading">
                     <div class="card-title">
                         <div class="title">Create brand</div>
                     </div>
                 </div>
                 @include('admin.errors.error')
                 <div class="panel-body">
                    <form action="{{ route('admin.brand.store') }}" method="POST">
                      @csrf
                      <div class="sub-title">Brand Name</div>
                      <div>
                          <input type="text" name="name" class="form-control" placeholder="Brand name">
                      </div>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      <br>
                      <div>
                          <button type="submit" class="btn btn-default">Store</button>
                      </div>
                    </form>
                 </div>
             </div>
         </div>
     </div>

        <footer><p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez.com</a></p></footer>
    </div>
@endsection