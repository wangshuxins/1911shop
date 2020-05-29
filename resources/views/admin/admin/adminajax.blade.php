@foreach($arr as $k=>$v)
		<tr @if($k%2==1)  class="danger" @else class="success" @endif>
		    <td>{{$v->admin_id}}</td>
			<td>{{$v->admin_name}}</td>
			<td>{{$v->admin_tel}}</td>
			<td>{{$v->admin_email}}</td>
			<td>{{$v->admin_pwd}}</td>
			<td>
			@if($v->admin_img)
			<img width="50" src="{{env('UPLOADS_URL')}}{{$v->admin_img}}">
			@endif
			</td>

			<td>
			<a class="btn btn-primary" href="{{url('/admin/edit/'.$v->admin_id)}}">编辑</a>|<a class="btn btn-danger" href="{{url('/admin/destroy/'.$v->admin_id)}}">删除</a>
			</td>
		</tr>
		@endforeach
		<tr><td colspan="5" align="center">{{$arr->links()}}</td></tr>