@extends('master-layout')

@section('asset-index-menu')
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
			                        <i class="fa fa-cogs"></i>Asset's Table</div>
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
			                        <th>Origin</th>
			                        <th>Year</th>
			                        <th>Location</th>
			                        <th>Type</th>
			                        <th>Order</th>
			                        <th colspan="2">Menu</th>
			                      </tr>
			                    </thead>
			                    <tbody>
															@foreach($assets->data as $asset)
			                        <tr>
			                          <td>{{$asset->id}}</td>
			                          <td>{{$asset->origin}}</td>
			                          <td>{{$asset->year}}</td>
			                          <td>{{$asset->location}}</td>
			                          <td>{{$asset->type}}</td>
			                          <td>{{$asset->order}}</td>
			                          <td><i class="glyphicon glyphicon-pencil"></i></td>
			                          <td><a class="delete" data-toggle="modal" data-target="#deleteAsset" data-id="{{$asset->id}}">
																	<i class="glyphicon glyphicon-trash"></i>
																</a></td>
			                        </tr>
															@endforeach
			                    </tbody>
			                  </table>
			                  <div class="flip-content">
			                    <div class="row">
			                      <div class="col-md-5 col-sm-5">
			                        Showing {{$assets->from}} to {{$assets->to}}  from {{$assets->total}} data
			                      </div>
			                      <div class="col-md-7 col-sm-7">
			                        <div class="dataTables_paginate paging_bootstrap_full_number">
			                          <ul class="pagination">
			                            <li class="prev">
			                              <a href="{{url('asset?page=1')}}"><i class="fa fa-angle-double-left"></i></a>
			                            </li>
			                            <li class="prev">
			                              <a id="paging-prev" href="{{url('asset?page=')}}"><i class="fa fa-angle-left"></i></a>
			                            </li>
			                            <li><a id="paging-current">{{$assets->current_page}}</a></li>
			                            <li class="next">
			                              <a id="paging-next" href="{{url('asset?page=')}}"><i class="fa fa-angle-right"></i></a>
			                            </li>
			                            <li class="next">
			                              <a href="{{url('asset?page='.$assets->last_page)}}"><i class="fa fa-angle-double-right"></i></a>
			                            </li>
			                          </ul>
			                        </div>
			                      </div>
			                    </div>
			                  </div>
			                </div>
			              </div>

			              <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#addAssetModal">Add Asset</button>

			          </div>

								<!-- Modal Add Begin-->
			          <div id="addAssetModal" class="modal fade" role="dialog">
			            <div class="modal-dialog">
			              <div class="modal-content">
			                <div class="modal-header">
			                  <button type="button" class="close" data-dismiss="#addAssetModal">&times;</button>
			                  <h4 class="modal-title">Add Asset</h4>
			                </div>
			                <div class="modal-body">
			                  <form action="{{url('create-asset')}}" method="GET">
			                   <div class="form-group">
			                     <label for="">Source</label>
			                     <select name="asset_origin" class="form-control">
			                       <option value="H">Hibah</option>
			                       <option value="L">Logistik</option>
			                      </select>
			                   </div>
			                   <div class="form-group">
			                     <label for="">Year</label>
			                     <input type="text" class="form-control" name="year">
			                   </div>
			                   <div class="form-group">
			                     <label for="">Location</label>
			                     <select name="id_location" class="form-control">
														 @foreach($ref->locations as $location)
			                       <option value="{{$location->id}}">{{$location->name}}</option>
														 @endforeach
			                      </select>
			                   </div>
			                   <div class="form-group">
			                     <label for="">Type</label>
			                     <select name="id_asset_type_detail" class="form-control">
														 @foreach($ref->types as $type)
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
								<div id="deleteAsset" class="modal fade" role="dialog">
								  <div class="modal-dialog">

								    <!-- Modal content-->
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">Delete Asset</h4>
								      </div>
											<form action="{{url('delete-asset')}}" method="GET">
								      <div class="modal-body">
												<input type="hidden" name="id_asset" id="id" value="">
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
		$('.modal-body #detail').text("Anda akan menghapus asset : "+id+" . Yakin?");
		$('.modal-body #id').attr('value',id);
	});

});
</script>

@stop
