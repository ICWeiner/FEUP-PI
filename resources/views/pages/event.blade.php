@extends('layouts.app')

@section('content')

@push('pageJS')
<script   type="text/javascript" src={{ asset('js/event.js') }} defer> </script>
@endpush

<div id="organicUnitName" style="display:none">{{$event->organicunit->name}}</div>


<div id="eventContainer" class="p-5 m-5 bg-secondary rounded min-height">
    <div class="d-flex justify-content-start m-auto link-light">
        <button id="backButton" type="button" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="White" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
          </svg>
        </button>
    </div>
    <div class="d-flex justify-content-center m-auto link-light">
        <h3 class="text-center text-light">{{$event->eventnameenglish}}</h3>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                        <div class="text-center m-auto">
                                <img class="rounded" src="{{URL::asset('/images/events/'.$event->imageurl)}}" width="250" height="200" alt="Card image cap">
                        </div>
                    <div class="row">
                        <div class="col-md-8">
                            <p class="card-text"><b>Start Date: </b>{{$event->startdate}}</p>
                            <p class="card-text"><b>End Date: </b>{{$event->enddate}}</p>
                            <p class="card-text"><b>Address: </b>{{$event->address}}</p>
                            <p class="card-text"><b>Contact Person: </b>{{$event->contactperson}}</p>
                            <p class="card-text"><b>Email: </b>{{$event->email}}</p>
                            <p><b>Tags: </b>
                            @if($event->tags()->count() > 0)
                                @foreach($event->tags()->get() as $tag)
                                <a id="eventTag" href="/tags/{{$tag->tagid}}/events"><span class="badge bg-secondary rounded-pill">{{$tag->tagnameenglish}}</span></a>
                                @endforeach
                                <a id="eventTag" href="/organicunits/{{$event->organicunit->organicunitid}}/events"><span id="eventTag" class="badge bg-secondary rounded-pill">{{$event->organicunit->name}}</span></a>
                            @else
                                N/A
                            @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 m-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Description</h5>
                    <p class="card-text">{{$event->description}}</p>
                    <p class="card-text"><b>Url English: </b><a href="{{$event->urlenglish}}">{{$event->urlenglish}}</a></p>
                    <p class="card-text"><b>Url Portuguese: </b><a href="{{$event->urlportuguese}}">{{$event->urlportuguese}}</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


