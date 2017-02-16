@extends('layouts.admin')

@section('title')
    Delivery
@endsection

@section('content')
    @if ($alert = Session::get('alert-success'))
    <div class="ui success message">
        <div class="header">Success!</div>
        <p>{{ $alert }}</p>
    </div>
    @endif

    <div class="row">
        <h1>Delivery</h1>
        <hr>
    </div>

    <div class="row">
        <button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Delivery</button>
    </div>
    <div class="row">
        <table class="ui table" id="tbldelivery">
          <thead>
            <tr>
                <th>Location</th>
                <th>Fee</th>
                <th class="center aligned">Action</th>
            </tr>
          </thead>
          <tbody>
            @if(count($deliveries) < 0)
            <tr>
                <td colspan="3"><strong>Nothing to show.</strong></td>
            </tr>
            @else
                @foreach($deliveries as $delivery)
                <tr>
                  <td>{{$delivery->deliveryLocation}}</td>
                  <td>Php {{$delivery->deliveryFee}}</td>
                  <td class="center aligned">
                    <button class="ui blue button" onclick="$('#update{{$delivery->deliveryCode}}').modal('show');"><i class="edit icon"></i> Update</button>
                    @if($delivery->deleted_at == null)
                    <button class="ui red button" onclick="$('#delete{{$delivery->deliveryCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
                    @else
                    <button class="ui orange button" onclick="$('#restore{{$delivery->deliveryCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
                    @endif
                  </td>
                </tr>
                @endforeach
            @endif
          </tbody>
        </table>
    </div>

@if(count($deliveries) > 0)
@foreach($deliveries as $delivery)
    <div class="ui modal" id="update{{$delivery->deliveryCode}}">
      <div class="header">Update Delivery</div>
      <div class="content">
        {!! Form::open(['url' => '/delivery/delivery_update']) !!}
            <div class="ui form">
                @if (count($errors) > 0)
                <div class="ui message">
                    <div class="header">We had some issues</div>
                    <ul class="list">
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                </div>
                @endif
                {{ Form::hidden('delivery_code', $delivery->deliveryCode) }}
                <div class="required field">
                    {{ Form::label('delivery_location', 'Delivery Location') }}
                    {{ Form::text('delivery_location', $delivery->deliveryLocation, ['placeholder' => 'Type Delivery Location']) }}
                </div>
                <div class="required field">
                    {{ Form::label('delivery_fee', 'Delivery Fee') }}
                    <div class="ui center labeled input">
                    <div class="ui label">Php</div>
                    {{ Form::text('delivery_fee', $delivery->deliveryFee, ['placeholder' => 'Fee']) }}
                    </div>
                </div>
            </div>
        </div>
      <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
      </div>
    </div>

    <div class="ui modal" id="delete{{$delivery->strDeliCode}}">
      <div class="header">Deactivate Delivery</div>
      <div class="content">
        <p>Do you want to delete this delivery?</p>
      </div>
      <div class="actions">
        {!! Form::open(['url' => '/delivery/' . $delivery->deliveryCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
      </div>
    </div>

    <div class="ui modal" id="restore{{$delivery->strDeliCode}}">
      <div class="header">Restore Delivery</div>
      <div class="content">
        <p>Do you want to Restore this delivery?</p>
      </div>
      <div class="actions">
        {!! Form::open(['url' => '/delivery/delivery_restore']) !!}
            {{ Form::hidden('delivery_code', $delivery->deliveryCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
      </div>
    </div>
@endforeach
@endif

    <div class="ui modal" id="create">
      <div class="header">New Delivery</div>
      <div class="content">
        {!! Form::open(['url' => '/delivery']) !!}
            <div class="ui form">
                @if (count($errors) > 0)
                <div class="ui message">
                    <div class="header">We had some issues</div>
                    <ul class="list">
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                </div>
                @endif

                <div class="disabled field">
                    {{ Form::label('delivery_code', 'Delivery Code') }}
                    {{ Form::text('delivery_code', $newID, ['placeholder' => 'Type Delivery Code']) }}
                </div>
                <div class="required field">
                    {{ Form::label('delivery_location', 'Delivery Location') }}
                    {{ Form::text('delivery_location', null, ['placeholder' => 'Type Delivery Location']) }}
                </div>
                <div class="required field">
                    {{ Form::label('delivery_fee', 'Delivery Fee') }}
                    <div class="ui center labeled input">
                    <div class="ui label">Php</div>
                    {{ Form::text('delivery_fee', null, ['placeholder' => 'Fee']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="actions">
              {{ Form::button('Submit', ['type'=>'submit', 'class'=> 'ui positive button']) }}
              {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('js')
<script>
  $(document).ready( function(){
    $('#delivery').addClass("active grey");
    $('#content').addClass("active");
    $('#title').addClass("active");

    var table = $('#tbldelivery').DataTable();
  });
</script>
@endsection
