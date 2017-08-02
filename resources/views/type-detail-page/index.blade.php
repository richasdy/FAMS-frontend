@extends('master-layout')

@section('tables-menu')
	active open selected
@stop

@section('type-index-menu')
	active
@stop

@section('type-detail-index-menu')
	active
@stop

@section('content')
<div class="page-content">
	<div class="page-content-container">
			<div class="page-content-row">
				<div class="page-content-col">

			      <div class="row">
			          <div class="col-md-12">
			              <div class="note note-success">
			                  <p> Error/Notification Alert </p>
			              </div>
			              <div class="portlet box green">
			                <div class="portlet-title">
			                    <div class="caption">
			                        <i class="fa fa-cogs"></i>Type Detail's Table</div>
			                    <div class="tools">
			                        <a href="javascript:;" class="collapse"> </a>
			                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
			                        <a href="javascript:;" class="reload"> </a>
			                        <a href="javascript:;" class="remove"> </a>
			                    </div>
			                </div>
			                <div class="portlet-body flip-scroll">
			                  <table class="table table-bordered table-striped table-condensed flip-content">
			                    <thead class="flip-content">
			                      <tr>
			                        <th>ID</th>
			                        <th>Name</th>
															<th>Type General</th>
			                        <th colspan="2">Menu</th>
			                      </tr>
			                    </thead>
			                    <tbody>
															@foreach($types->data as $type)
			                        <tr>
			                          <td>{{$type->id}}</td>
			                          <td>{{$type->name}}</td>
																<td>{{$type->type_general}}</td>
			                          <td><i class="glyphicon glyphicon-pencil"></i></td>
			                          <td><a class="delete" data-toggle="modal" data-target="#deleteType" data-id="{{$type->id}}">
																	<i class="glyphicon glyphicon-trash"></i>
																</a></td>
			                        </tr>
															@endforeach
			                    </tbody>
			                  </table>
			                  <div class="flip-content">
			                    <div class="row">
			                      <div class="col-md-5 col-sm-5">
			                        Showing {{$types->from}} to {{$types->to}}  from {{$types->total}} data
			                      </div>
			                      <div class="col-md-7 col-sm-7">
			                        <div class="dataTables_paginate paging_bootstrap_full_number">
			                          <ul class="pagination">
			                            <li class="prev">
			                              <a href="{{url('type-detail?page=1')}}"><i class="fa fa-angle-double-left"></i></a>
			                            </li>
			                            <li class="prev">
			                              <a id="paging-prev" href="{{url('type-detail?page=')}}"><i class="fa fa-angle-left"></i></a>
			                            </li>
			                            <li><a id="paging-current">{{$types->current_page}}</a></li>
			                            <li class="next">
			                              <a id="paging-next" href="{{url('type-detail?page=')}}"><i class="fa fa-angle-right"></i></a>
			                            </li>
			                            <li class="next">
			                              <a href="{{url('type-detail?page='.$types->last_page)}}"><i class="fa fa-angle-double-right"></i></a>
			                            </li>
			                          </ul>
			                        </div>
			                      </div>
			                    </div>
			                  </div>
			                </div>
			              </div>

			              <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#addTypeModal">Add Type</button>

			          </div>

								<!-- Modal Add Begin-->
			          <div id="addTypeModal" class="modal fade" role="dialog">
			            <div class="modal-dialog">
			              <div class="modal-content">
			                <div class="modal-header">
			                  <button type="button" class="close" data-dismiss="#addAssetModal">&times;</button>
			                  <h4 class="modal-title">Add Type</h4>
			                </div>
			                <div class="modal-body">
			                  <form action="{{url('create-type-detail')}}" method="GET">
												 <div class="form-group">
			                     <label for="">Name</label>
			                     <input type="text" class="form-control" name="name">
			                   </div>
												 <div class="form-group">
			                     <label for="">Type General</label>
			                     <select name="id_asset_type" class="form-control">
														 @foreach($ref->type_general as $type)
			                       <option value="{{$type->id}}">{{$type->name}}</option>
														 @endforeach
			                      </select>
			                   </div>
			                   <button type="submit" class="btn btn-default">Submit</button>
			                  </form>
			                </div>
			                <div class="modal-footer">
			                </div>
			              </div>
			            </div>
			          </div>
			          <!-- Modal Add End-->

								<!--Modal Delete Begin-->
								<div id="deleteType" class="modal fade" role="dialog">
								  <div class="modal-dialog">

								    <!-- Modal content-->
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">Delete Location</h4>
								      </div>
											<form action="{{url('delete-type-detail')}}" method="GET">
								      <div class="modal-body">
												<input type="hidden" name="id_type" id="id" value="">
								        <p id="detail">

												</p>
								      </div>
								      <div class="modal-footer">
								        <button type="submit" class="btn btn-danger">Ya</button>
								      </div>
											</form>
								    </div>

								  </div>
								</div>
								<!--Modal Delete End-->
			      </div>

			  </div>
			</div>
	</div>
</div>
@stop

@section('js-add')
<script>
$(document).ready(function(){
	//assign prev+next page (paging)
	var url = $('#paging-prev').attr('href');
	var current = parseInt($('#paging-current').text());
	//console.log(current);
	$('#paging-prev').attr('href',url+(current-1));
	$('#paging-next').attr('href',url+(current+1));

	//fungsi modal delete
	$(document).on("click", ".delete", function () {
		var id = $(this).data('id');
		//console.log(id);
		$('.modal-body #detail').text("Anda akan menghapus type : "+id+" . Yakin?");
		$('.modal-body #id').attr('value',id);
	});

});
</script>

@stop
