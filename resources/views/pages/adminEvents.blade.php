@extends('layouts.app')

@section('content')

<div class="p-5 m-5 bg-secondary rounded min-height">
    <div class="d-flex justify content-center link-light">
        <h3>Admin Dashboard - Events</h3>
    </div>

<!-- Nav tabs -->
<ul class="nav m-3 nav-tabs nav-fill">
  <li class="nav-item text-light bg-dark rounded-top">
    <a class="nav-link active" data-bs-toggle="tab" href="#eventRequests">Event Requests</a>
  </li>
  <li class="nav-item text-light bg-dark rounded-top">
    <a class="nav-link" data-bs-toggle="tab" href="#events">Events</a>
  </li>
  <li class="nav-item text-light bg-dark rounded-top">
    <a class="nav-link" data-bs-toggle="tab" href="#tags">Create Tag</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content mt-5">
  <div class="tab-pane container active" id="eventRequests">
    <table class="table rounded rounded-3 overflow-hidden align-middle bg-white">
        <thead class="bg-light">
            <tr>
            <th>Event</th>
            <th>Request Date</th>
            <th>Type</th>
            <th>Status</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(count($pendingEvents) > 0) <!--TODO: add "nothing is here if condition is false -->
              @each('partials.adminDashboardEntry', $pendingEvents, 'event')
            @endif
        </tbody>
    </table>
  </div>
  <div class="tab-pane container" id="events">
  <table class="table rounded rounded-3 overflow-hidden align-middle bg-white">
        <thead class="bg-light">
            <tr>
            <th>Event</th>
            <th>Request Date</th>
            <th>Type</th>
            <th>Status</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(count($events) > 0)<!--TODO: add "nothing is here if condition is false --> 
                @each('partials.adminDashboardEntry', $events, 'event')
            @endif
        </tbody>
    </table>
  </div>
  <div class="tab-pane container" id="tags">
  <form class="my-4" method="POST" action="{{route('create.tag')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="tagname" class="form-label">Name<span><b class="text-danger">*</b></span></label>
                <div class="input-group mb-3">
                    <input id="tagname" class="form-control" placeholder="Enter tag name" type="text" name="tagname" value="{{ old('tagname') }}" required autofocus>
                    @if ($errors->has('tagname'))
                    <span class="error">
                        {{ $errors->first('tagname') }}
                    </span>
                    @endif
                    <button type="submit" class="btn btn-dark">Create Tag</button>
                </div>
            </div>
        </div>
    </div>
</form>
  </div>
</div>
</div>




@endsection