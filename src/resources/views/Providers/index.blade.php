@extends('base')
@section('main')
<div class="row">
<div class="col-sm-12">
    @if(session()->get('success'))
        <div class="alert alert-success">
        {{ session()->get('success') }}  
        </div>
    @endif
</div>
<div class="col-sm-12">
    <h1 class="display-3">Providers</h1>
    <div>
    <a style="margin: 19px;" href="{{ route('providers.create')}}" class="btn btn-primary">New Provider</a>
    </div>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Name</td>
          <td>Image</td>
          <td>Image Type</td>
          <td>Restrictions</td>
          <td>Notes</td>
          <td colspan = 2>Actions</td>
        </tr>
    </thead>
    <tbody>
        @foreach($providers as $provider)
        <tr>
            <td>{{$provider->id}}</td>
            <td>{{$provider->name}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <a href="{{ route('providers.edit',$provider->id)}}" class="btn btn-primary">Edit</a>
            </td>
            <td>
                <form action="{{ route('providers.destroy', $provider->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
</div>
@endsection