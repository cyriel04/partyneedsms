@extends('layouts.admin')

@section('title')
	Quantity Ratio
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Quantity Ratio</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Waiter Ratio</button>
	</div>
	<div class="row">
		<table class="ui table" id="tblquantityratio">
		  <thead>
		    <tr>
					<th>Mininum No. of Pax</th>
			    <th>Maxinum No. of Pax</th>
			    <th>Number of Waiter</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($quantityRatios) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($quantityRatios as $quantityRatio)
			  	<tr>
						<td>{{$quantityRatio->quantityRatioMinPax}}</td>
			      <td>{{$quantityRatio->quantityRatioMaxPax}}</td>
			      <td>{{$quantityRatio->quantityRatioKilo}}</td>
			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$quantityRatio->strWaitRatiCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($quantityRatio->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$quantityRatio->strWaitRatiCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$quantityRatio->strWaitRatiCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif
		  </tbody>
		</table>
	</div>

@if(count($quantityRatios) > 0)
@foreach($quantityRatios as $quantityRatio)
	<div class="ui modal" id="update{{$quantityRatio->strWaitRatiCode}}">
	  <div class="header">Update</div>
	  <div class="content">
	    {!! Form::open(['url' => '/waiterRatio/waiterRatio_update']) !!}
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
	    		{{ Form::hidden('waiter_ratio_code', $quantityRatio->strWaitRatiCode) }}
					<div class="required field">
	    			{{ Form::label('min_pax', 'Minimum No. of Pax') }}
         			{{ Form::text('min_pax', $quantityRatio->intWaitRatiMinPax, ['placeholder' => 'Maxinum Pax']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('max_pax', 'Maxinum No. of Pax') }}
         			{{ Form::text('max_pax', $quantityRatio->intWaitRatiMaxPax, ['placeholder' => 'Maxinum Pax']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('number_of_waiter', 'Number of Waiter') }}
          			{{ Form::text('number_of_waiter', $quantityRatio->intWaitRatiNoOfWaiter, ['placeholder' => 'Number of Waiter']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$quantityRatio->strWaitRatiCode}}">
	  <div class="header">Deactivate</div>
	  <div class="content">
	    <p>Do you want to delete this waiter ratio?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/waiterRatio/' .$quantityRatio->strWaitRatiCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$quantityRatio->strWaitRatiCode}}">
	  <div class="header">Restore</div>
	  <div class="content">
	    <p>Do you want to Restore this waiter ratio?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/waiterRatio/waiterRatio_restore']) !!}
	  		{{ Form::hidden('waiter_ratio_code', $quantityRatio->strWaitRatiCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New</div>
	  <div class="content">
	    {!! Form::open(['url' => '/waiterRatio']) !!}
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
	    			{{ Form::label('waiter_ratio_code', 'Waiter Ratio Code') }}
         			{{ Form::text('waiter_ratio_code', $newID, ['placeholder' => 'Type Menu Type Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('min_pax', 'Minimum No. of Pax') }}
         			{{ Form::text('min_pax', '', ['placeholder' => 'Number of Pax']) }}
	    		</div>
					<div class="required field">
	    			{{ Form::label('max_pax', 'Maximum No. of Pax') }}
         			{{ Form::text('max_pax', '', ['placeholder' => 'Number of Pax']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('number_of_waiter', 'Number of Waiter') }}
          			{{ Form::text('number_of_waiter', '', ['placeholder' => 'Number of Waiter']) }}
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
    $('#waiterRatio').addClass("active grey");
    $('#content').addClass("active");
    $('#title').addClass("active");

    var table = $('#tblWaiterRatio').DataTable();
  });
</script>
@endsection
