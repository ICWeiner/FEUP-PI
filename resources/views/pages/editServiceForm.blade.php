@extends('layouts.app')

@section('content') 

@if (Auth::check())


<div class="p-5 m-5 bg-secondary rounded min-height">
    <div class="d-flex justify content-center link-light">
        <h3>{{$service->servicename->servicenameenglish}} Request</h3>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form class="my-4" method="POST" action="{{route('edit.service',['id' => $service->serviceid])}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        <input type="hidden" name="questionsid" value="{{$service->servicetype->questionsid}}">
        <input type="hidden" name="servicenameid" value="{{$service->servicename->servicenameid}}">
        @include('partials.editservicequestions',['serviceType' => $service->servicetype])
        

        <div class="form-group my-3">
            <label for="purpose" class="form-label">Purpose (<i>optional</i>)</label>
            <textarea id="purpose" rows="4" class="form-control" name="purpose"  placeholder="Enter the purpose the request">{{$service->purpose}}</textarea>
            @if ($errors->has('purpose'))
            <span class="error">
                {{ $errors->first('purpose') }}
            </span>
            @endif
        </div>
    

        <div class="form-group">
        <label for="organicunitid">Select Organic Unit <span><b class="text-danger">*</b></span></label> 
        <select class="form-control" id="organicunitid" name="organicunitid" required>
             @foreach ($service->servicename->organicunits as $unit)
                <option value="{{$unit->organicunitid}}" 
                    @if($service->organicunitid==$unit->organicunitid)
                        selected
                    @endif>{{ $unit->name }}</option>
            @endforeach 
        </select>
        </div>


        <div class="form-group">
            <label for="contactperson" class="form-label">Person to Contact (<i>optional</i>)</label>
            <input id="contactperson" placeholder="Enter event contact person" class="form-control" type="text" name="contactperson" value="{{ $service->contactperson }}" >
            @if ($errors->has('contactperson'))
            <span class="error">
                {{ $errors->first('contactperson') }}
            </span>
            @endif
        </div>
        

        <div class="col-md-6">
            <div class="form-group">
                <label for="email" class="form-label">Contact Email (<i>optional</i>)</label>
                <input id="email" class="form-control" placeholder="Enter an email" type="email" name="email" value="{{ $service->email }}">
                @if ($errors->has('email'))
                <span class="error">
                    {{ $errors->first('email') }}
                </span>
                @endif
            </div>
        </div>

        <div class="row my-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="startdate" class="form-label">Start Date (<i>optional</i>)</label>
                    <input type="date" class="form-control" id="startdate" name="startdate"
                    value="{{ $service->startdate }}"
                    min="<?php echo date('Y-m-d'); ?>" >
                    @if ($errors->has('startdate'))
                    <span class="error">
                        {{ $errors->first('startdate') }}
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="enddate" class="form-label">End Date (<i>optional</i>)</label>
                    <input type="date" class="form-control" id="enddate" name="enddate"
                    value="{{ $service->enddate }}"
                    min="<?php echo date('Y-m-d'); ?>" >
                    @if ($errors->has('enddate'))
                    <span class="error">
                        {{ $errors->first('enddate') }}
                    </span>
                    @endif 
                </div>
            </div>
        </div> 
        
        <div class="col-md-12 text-center mt-5">
            <button type="submit" class="btn btn-dark">Edit Service Request</button>
        </div>

    </form>
</div>


@else
    <script>window.location = "/login";</script>
@endif


@endsection