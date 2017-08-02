@extends('master-layout')

@section('dashboard-menu')
	active open selected
@stop

@section('dashboard-home-menu')
	active
@stop

@section('content')
<div class="page-content">
	<div class="page-content-container">
			<div class="page-content-row">
				<div class="page-content-col">

		      <div class="row">
            <div class='col-md-3'>
              <div class="dashboard-stat2 bordered">
                  <div class="display">
                      <div class="number">
                          <h3 class="font-green-sharp">
                              <span data-counter="counterup" data-value="{{$data->total_asset}}">{{$data->total_asset}}</span>
                          </h3>
                          <small>TOTAL ASSET</small>
                      </div>
                      <div class="icon">
                          <i class="icon-pie-chart"></i>
                      </div>
                  </div>
                  <div class="progress-info">
                      <div class="progress">
                          <span style="width: 100%;" class="progress-bar progress-bar-success green-sharp">
                              <span class="sr-only">76% progress</span>
                          </span>
                      </div>
                      <div class="status">
                          <div class="status-title"> Total Asset di BTP </div>
                          <div class="status-number"> </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class='col-md-3'>
              <div class="dashboard-stat2 bordered">
                  <div class="display">
                      <div class="number">
                          <h3 class="font-red-haze">
                              <span data-counter="counterup" data-value="{{$data->total_gedung}}">{{$data->total_gedung}}</span>
                          </h3>
                          <small>TOTAL GEDUNG</small>
                      </div>
                      <div class="icon">
                          <i class="icon-pie-chart"></i>
                      </div>
                  </div>
                  <div class="progress-info">
                      <div class="progress">
                          <span style="width: 100%;" class="progress-bar progress-bar-success red-haze">
                              <span class="sr-only">76% progress</span>
                          </span>
                      </div>
                      <div class="status">
                          <div class="status-title"> Total Lokasi di BTP </div>
                          <div class="status-number"> </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class='col-md-3'>
              <div class="dashboard-stat2 bordered">
                  <div class="display">
                      <div class="number">
                          <h3 class="font-blue-sharp">
                              <span data-counter="counterup" data-value="{{$data->total_type}}">{{$data->total_type}}</span>
                          </h3>
                          <small>TOTAL TYPE</small>
                      </div>
                      <div class="icon">
                          <i class="icon-pie-chart"></i>
                      </div>
                  </div>
                  <div class="progress-info">
                      <div class="progress">
                          <span style="width: 100%;" class="progress-bar progress-bar-success blue-sharp">
                              <span class="sr-only">76% progress</span>
                          </span>
                      </div>
                      <div class="status">
                          <div class="status-title"> Total Type Asset di BTP </div>
                          <div class="status-number"> </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class='col-md-3'>
              <div class="dashboard-stat2 bordered">
                  <div class="display">
                      <div class="number">
                          <h3 class="font-purple-soft">
                              <span data-counter="counterup" data-value="{{$data->total_user}}">{{$data->total_user}}</span>
                          </h3>
                          <small>TOTAL USER</small>
                      </div>
                      <div class="icon">
                          <i class="icon-pie-chart"></i>
                      </div>
                  </div>
                  <div class="progress-info">
                      <div class="progress">
                          <span style="width: 100%;" class="progress-bar progress-bar-success purple-soft">
                              <span class="sr-only">76% progress</span>
                          </span>
                      </div>
                      <div class="status">
                          <div class="status-title"> User Asset Management </div>
                          <div class="status-number"> </div>
                      </div>
                  </div>
              </div>
            </div>
		      </div>
					<div class="row">
						<div class="col-md-6">
							<div class="portlet light bordered">
								<div class="portlet-title">
									<h3 class="font-red-haze">Lokasi</h3>
								</div>
								<div class="portlet-body">
									<table class="table table-bordered table-striped table-condensed flip-content">
										<thead class="flip-content">
											<tr>
												<th>ID</th>
												<th>Gedung</th>
												<th>Ruangan</th>
												<th>Asset</th>
											</tr>
										</thead>
										<tbody>
												@foreach($data->location as $gdg)
												<tr>
													<td>{{$gdg->id}}</td>
													<td>{{$gdg->name}}</td>
													<td>{{count($gdg->ruangan)}}</td>
													<?php
													$jml_asset = 0;
													 foreach($gdg->ruangan as $ruangan){
														 $jml_asset = $jml_asset+count($ruangan->assets);
													 }
													?>
													<td>{{$jml_asset}}</td>
												</tr>
												@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="portlet light bordered">
								<div class="portlet-title">
									<h3 class="font-blue-sharp">Type</h3>
								</div>
								<div class="portlet-body">
									<table class="table table-bordered table-striped table-condensed flip-content">
										<thead class="flip-content">
											<tr>
												<th>ID</th>
												<th>Type</th>
												<th>Type Detail</th>
												<th>Asset</th>
											</tr>
										</thead>
										<tbody>
												@foreach($data->type as $type)
												<tr>
													<td>{{$type->id}}</td>
													<td>{{$type->name}}</td>
													<td>{{count($type->detail)}}</td>
													<?php
													$jml_asset = 0;
													 foreach($type->detail as $detail){
														 $jml_asset = $jml_asset+count($detail->assets);
													 }
													?>
													<td>{{$jml_asset}}</td>
												</tr>
												@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
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
		$('.modal-body #detail').text("Anda akan menghapus gedung : "+id+" . Yakin?");
		$('.modal-body #id').attr('value',id);
	});

});
</script>

@stop
