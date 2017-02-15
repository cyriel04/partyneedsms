@extends('layouts.admin')

@section('title')
	Item
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Item</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Item</button>
	</div>
	<div class="row">
		<table class="ui table" id="tblitem">
		  <thead>
		    <tr>
			    <th>Name</th>
			    <th>Description</th>
			    <th>Type</th>
			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($items) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($items as $item)
			  	<tr>
			      <td>{{$item->itemName}}</td>
			      <td>{{$item->itemDesc}}</td>
			      <td>{{$item->itemType->itemName}}</td>
			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$Item->itemCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($item->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$Item->itemCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$Item->itemCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif
		  </tbody>
		</table>
	</div>

@if(count($items) > 0)
@foreach($items as $item)
	<div class="ui modal" id="update{{$item->itemCode}}">
	  <div class="header">Update Item</div>
	  <div class="content">
	    {!! Form::open(['url' => '/item/item_update']) !!}
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
	    		{{ Form::hidden('item_code', $item->itemCode) }}
	    		<div class="required field">
	    			{{ Form::label('item_name', 'Item Name') }}
         			{{ Form::text('item_name', $item->itemName, ['placeholder' => 'Type Item Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('item_description', 'Item Description') }}
          			{{ Form::textarea('item_description', $item->itemDesc, ['placeholder' => 'Type Item Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('item_type', 'Item Type') }}
         			{{ Form::select('item_type', itemTypes, $item->itemCode, ['placeholder' => 'Choose Item Type', 'class' => 'ui search dropdown']) }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$item->itemCode}}">
	  <div class="header">Deactivate Item</div>
	  <div class="content">
	    <p>Do you want to delete this Item?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/item/' . $item->itemCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$item->itemCode}}">
	  <div class="header">Restore Item</div>
	  <div class="content">
	    <p>Do you want to Restore this Item?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/item/item_restore']) !!}
	  		{{ Form::hidden('item_code', $item->itemCode) }}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>
@endforeach
@endif

	<div class="ui modal" id="create">
	  <div class="header">New Item</div>
	  <div class="content">
	    {!! Form::open(['url' => '/item']) !!}
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
	    			{{ Form::label('item_code', 'Item Code') }}
         			{{ Form::text('item_code', $newID, ['placeholder' => 'Type Item Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('item_name', 'Item Name') }}
         			{{ Form::text('item_name', '', ['placeholder' => 'Type Item Name']) }}
	    		</div>
	    		<div class="field">
	    			{{ Form::label('item_description', 'Item Description') }}
          			{{ Form::textarea('item_description', '', ['placeholder' => 'Type Item Description', 'rows' => '2']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('item_type', 'Item Type') }}
         			{{ Form::select('item_type', $equiTypes, null, ['placeholder' => 'Choose Item Type', 'class' => 'ui search dropdown']) }}
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
    $('#item').addClass("active grey");
    $('#Item_content').addClass("active");
    $('#Item').addClass("active");

    var table = $('#tblitem').DataTable();
  });
</script>
@endsection
