@extends('layouts.admin')

@section('title')
	Item Rate
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Item Rate</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Unit of Measurement</button>
	</div>
	<div class="row">
		<table class="ui table" id="tblitemrate">
		  <thead>
		    <tr>
			    <th>Amount</th>

			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($itemRates) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($itemRates as $itemRate)
			  	<tr>
			      <td>{{$itemRate->amount}}</td>

			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$itemRate->itemRateCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($uom->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$itemRate->itemRateCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$itemRate->itemRateCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif
		  </tbody>
		</table>
	</div>

@if(count($uoms) > 0)
@foreach($uoms as $uom)
	<div class="ui modal" id="update{{$itemRate->itemRateCode}}">
	  <div class="header">Update</div>
	  <div class="content">
	    {!! Form::open(['url' => '/itemRate/itemRate_update']) !!}
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
	    		{{ Form::hidden('item_rate_code', $itemRate->itemRateCode) }}
	    		<div class="required field">
	    			{{ Form::label('item_rate_amount', 'Amount') }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$itemRate->itemRateCode}}">
	  <div class="header">Deactivate</div>
	  <div class="content">
	    <p>Do you want to delete this Item Rate?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/itemRate/' . $itemRate->itemRateCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$itemRate->itemRateCode}}">
	  <div class="header">Restore</div>
	  <div class="content">
	    <p>Do you want to Restore this Item Rate?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/itemRate/itemRate_restore']) !!}
	  		{{ Form::hidden('item_rate_code', $itemRate->itemRateCode) }}
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
	    {!! Form::open(['url' => '/itemRate']) !!}
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
	    			{{ Form::label('item_rate_code', 'Code') }}
         			{{ Form::text('item_rate_code', $newID, ['placeholder' => 'Type Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('item_rate_amount', 'Amount') }}
         			{{ Form::text('item_rate_amount', '', ['placeholder' => 'Type Amount']) }}
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
    $('#$itemRate').addClass("active grey");
    $('#content').addClass("active");
    $('#title').addClass("active");

    var table = $('#tblitemrate').DataTable();
  });
</script>
@endsection
