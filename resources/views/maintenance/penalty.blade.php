@extends('layouts.admin')

@section('title')
	Penalty
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Penalty</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Penalty</button>
	</div>
	<div class="row">
		<table class="ui brown table" id="tblpenalty">
		  <thead>
		    <tr>
			    <th>Description</th>
			    <th>Penalty Type</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($penalties) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($penalties as $penalty)
			  	<tr>
			      <td>{{$penalty->penaltyDesc}}</td>
			    <!-- <td>{{$penalty->penaltyType->strPenaTypeName}}</td> -->
			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$penalty->penaltyCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($penalty->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$penalty->penaltyCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$penalty->penaltyCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif
		  </tbody>
		</table>
	</div>

@if(count($penalties) > 0)
@foreach($penalties as $penalty)
	<div class="ui modal" id="update{{$penalty->penaltyCode}}">
	  <div class="header">Update Penalty</div>
	  <div class="content">
	    {!! Form::open(['url' => '/penalty/penalty_update']) !!}
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
	    		{{ Form::hidden('penalty_code', $penalty->penaltyCode) }}
	    		<div class="required field">
	    			{{ Form::label('penalty_location', 'Penalty Location') }}
         			{{ Form::text('penalty_location', $penalty->deliveryLocation, ['placeholder' => 'Type Penalty Location']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('penalty_description', 'Penalty Description') }}
          			{{ Form::textarea('penalty_description', $penalty->txtPenaDesc, ['placeholder' => 'Type Penalty Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('penalty_type', 'Penalty Type') }}
         			{{ Form::select('penalty_type', $penaTypes, $penalty->strPenaPenaTypeCode, ['placeholder' => 'Choose Penalty Type', 'class' => 'ui search dropdown']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$penalty->strPenaCode}}">
	  <div class="header">Deactivate Penalty</div>
	  <div class="content">
	    <p>Do you want to delete this penalty?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/penalty/' . $penalty->penaltyCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$penalty->strPenaCode}}">
	  <div class="header">Restore Penalty</div>
	  <div class="content">
	    <p>Do you want to Restore this penalty?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/penalty/penalty_restore']) !!}
	  		{{ Form::hidden('penalty_code', $penalty->strPenaCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Penalty</div>
	  <div class="content">
	    {!! Form::open(['url' => '/penalty']) !!}
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
	    			{{ Form::label('penalty_code', 'Penalty Code') }}
         			{{ Form::text('penalty_code', $newID, ['placeholder' => 'Type Penalty Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('penalty_location', 'Penalty Location') }}
         			{{ Form::text('penalty_location', '', ['placeholder' => 'Type Penalty Location']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('penalty_description', 'Penalty Description') }}
          			{{ Form::textarea('penalty_description', '', ['placeholder' => 'Type Penalty Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('penalty_type', 'Penalty Type') }}
         			{{ Form::select('penalty_type', $penaTypes, null, ['placeholder' => 'Choose Penalty Type', 'class' => 'ui search dropdown']) }}
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
    $('#penalty').addClass("active grey");
    $('#content').addClass("active");
    $('#title').addClass("active");

    var table = $('#tblpenalty').DataTable();
  });
</script>
@endsection
