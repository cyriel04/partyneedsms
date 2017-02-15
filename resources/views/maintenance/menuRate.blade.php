@extends('layouts.admin')

Menu Rate
@endsection

@section('content')
	@if ($alert = Session::get('alert-success'))
    <div class="ui success message">
    	<div class="header">Success!</div>
    	<p>{{ $alert }}</p>
  	</div>
  	@endif

	<div class="row">
		<h1>Menu Rate</h1>
		<hr>
	</div>

	<div class="row">
		<button type="button" class="ui green button" onclick="$('#create').modal('show');"><i class="add icon"></i>New Unit of Measurement</button>
	</div>
	<div class="row">
		<table class="ui table" id="tblmenuset">
		  <thead>
		    <tr>
			    <th>Price</th>

			    <th class="center aligned">Action</th>
		  	</tr>
		  </thead>
		  <tbody>
		  	@if(count($menuSets) < 0)
		  	<tr>
		  		<td colspan="3"><strong>Nothing to show.</strong></td>
		  	</tr>
		  	@else
		  		@foreach($menuSets as $menuSet)
			  	<tr>
			      <td>{{$menuSet->price}}</td>

			      <td class="center aligned">
					<button class="ui blue button" onclick="$('#update{{$menuSet->menuCode}}').modal('show');"><i class="edit icon"></i> Update</button>
					@if($menuSet->deleted_at == null)
			      	<button class="ui red button" onclick="$('#delete{{$menuSet->menuCode}}').modal('show');"><i class="delete icon"></i> Deactivate</button>
			      	@else
			      	<button class="ui orange button" onclick="$('#restore{{$menuSet->menuCode}}').modal('show');"><i class="undo icon"></i> Restore</button>
			      	@endif
			      </td>
			    </tr>
		    	@endforeach
		    @endif
		  </tbody>
		</table>
	</div>

@if(count($uoms) > 0)
@foreach($menuSets as $menuSet)
	<div class="ui modal" id="update{{$menuSet->menuCode}}">
	  <div class="header">Update</div>
	  <div class="content">
	    {!! Form::open(['url' => '/menuSet/menuSet_update']) !!}
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
	    		{{ Form::hidden('menu_code', $menuSet->menuCode) }}
	    		<div class="required field">
	    			{{ Form::label('menu_price', 'price') }}
	    		</div>
	    	</div>
        </div>
	  <div class="actions">
            {{ Form::button('Save', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('Cancel', ['type' =>'reset', 'class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="delete{{$menuSet->menuCode}}">
	  <div class="header">Deactivate</div>
	  <div class="content">
	    <p>Do you want to delete this Menu Rate?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/menuSet/' . $menuSet->menuCode, 'method' => 'delete']) !!}
            {{ Form::button('Yes', ['type'=>'submit', 'class'=> 'ui positive button']) }}
            {{ Form::button('No', ['class' => 'ui negative button']) }}
        {!! Form::close() !!}
	  </div>
	</div>

	<div class="ui modal" id="restore{{$menuSet->menuCode}}">
	  <div class="header">Restore</div>
	  <div class="content">
	    <p>Do you want to Restore this Item Rate?</p>
	  </div>
	  <div class="actions">
	  	{!! Form::open(['url' => '/menuSet/menuSet_restore']) !!}
	  		{{ Form::hidden('menu_code', $menuSet->menuCode) }}
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
	    {!! Form::open(['url' => '/menuSet']) !!}
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
	    			{{ Form::label('menu_code', 'Code') }}
         			{{ Form::text('menu_code', $newID, ['placeholder' => 'Type Code']) }}
	    		</div>
	    		<div class="required field">
	    			{{ Form::label('price', 'price') }}
         			{{ Form::text('price', '', ['placeholder' => 'Type price']) }}
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
    $('#$menuSet').addClass("active grey");
    $('#content').addClass("active");
    $('#title').addClass("active");

    var table = $('#tblmenuSet').DataTable();
  });
</script>
@endsection
