
@foreach($brand as $k=>$v)
		<tr @if($k%2==1)  class="danger" @else class="success" @endif>
		    <td>{{$v->brand_id}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->brand_url}}</td>
			<td>
			@if($v->brand_logo)
			<img width="50" src="{{env('UPLOADS_URL')}}{{$v->brand_logo}}">
			@endif
			</td>

			<td>
			<a class="btn btn-primary" href="{{url('/brand/edit/'.$v->brand_id)}}">编辑</a>|<a class="btn btn-danger" href="{{url('/brand/destroy/'.$v->brand_id)}}">删除</a>
			</td>
		</tr>
@endforeach
		<tr><td colspan="5" align="center">{{$brand->appends(['brand_name'=>$brand_name])->links()}}</td></tr>