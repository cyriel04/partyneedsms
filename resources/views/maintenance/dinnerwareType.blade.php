@extends('layouts.admin')

@section('title')
	Dinnerware Type
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Dinnerware Type</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Dinnerware Type</button>
	</div>
	<div class="row">
		<table class="ui table" id="tbldinnerwaretype">
		  <thead>
		    <tr>
			    <th>Dinnerware Type</th>
			    <th>Description</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($dinnerwareTypes) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($dinnerwareTypes as $dinnerwareType)
			  	<tr>
			      <td>{{$dinnerwareType->dinnerwareTypeName}}</td>
			      <td>{{$dinnerwareType->dinnerwareTypeDesc}}</td>
			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$dinnerwareType->dinnerwareTypeCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($dinnerwareType->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$dinnerwareType->dinnerwareTypeCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$dinnerwareType->dinnerwareTypeCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif
		  </tbody>
		</table>
	</div>

@if(count($dinnerwareTypes) > 0)
@foreach($dinnerwareTypes as $dinnerwareType)
	<div class="ui modal" id="update{{$dinnerwareType->dinnerwareTypeCode}}">
	  <div class="header">Update Dinnerware Type</div>
	  <div class="content">
	    {!! Form::open(['url' => '/dinnerwareType/dinnerwareType_update']) !!}
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
	    		{{ Form::hidden('dinnerware_type_code', $dinnerwareType->dinnerwareTypeCode) }}
	    		<div class="required field">
	    			{{ Form::label('dinnerware_type_name', 'Dinnerware Type Name') }}
         			{{ Form::text('dinnerware_type_name', $dinnerwareType->dinnerwareTypeName, ['placeholder' => 'Type Dinnerware Type Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('dinnerware_type_description', 'Dinnerware Type Description') }}
          			{{ Form::textarea('dinnerware_type_description', $dinnerwareType->dinnewareTypeDesc, ['placeholder' => 'Type Dinnerware Type Description', 'rows' => '2']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$equipmentType->equipmentTypeCode}}">
	  <div class="header">Deactivate Dinnerware Type</div>
	  <div class="content">
	    <p>Do you want to delete this Dinnerware type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/dinnerwareType/' . $dinnerwareType->dinnerwareTypeCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$dinnerwareType->dinnerwareTypeCode}}">
	  <div class="header">Restore Dinnerware Type</div>
	  <div class="content">
	    <p>Do you want to Restore this Dinnerware type?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/dinnerwareType/dinnerwareType_restore']) !!}
	  		{{ Form::hidden('dinnerware_type_code', $dinnerwareType->dinnerwareTypeCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Dinnerware Type</div>
	  <div class="content">
	    {!! Form::open(['url' => '/dinnerwareType']) !!}
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
	    			{{ Form::label('dinnerware_type_code', 'Dinnerware Type Code') }}
         			{{ Form::text('dinnerware_type_code', $newID, ['placeholder' => 'Type Dinnerware Type Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('dinnerware_type_name', 'Dinnerware Type Name') }}
         			{{ Form::text('dinnerware_type_name', '', ['placeholder' => 'Type Dinnerware Type Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('dinnerware_type_description', 'Dinnerware Type Description') }}
          			{{ Form::textarea('dinnerware_type_description', '', ['placeholder' => 'Type Dinnerware Type Description', 'rows' => '2']) }}
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
    $('#equipmentType').addClass("active grey");
    $('#inventory_content').addClass("active");
    $('#inventory').addClass("active");

    var table = $('#tbldinnerwaretype').DataTable();
  });
</script>
@endsection
