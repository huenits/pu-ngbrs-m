
@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
      <div class="card-header">Welcome Page</div>

      <div class="card-body">
          @if (session('status'))
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
          @endif

          Neighbors.PH welcomes you!
      </div>
  </div>
</div>
@endsection
