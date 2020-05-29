@foreach($goods as $k=>$v)
		<tr @if($k%2==1)  class="danger" @else class="success" @endif>
		    <td>{{$v->goods_id}}</td>
			<td>{{$v->goods_name}}</td>
			<td>{{$v->goods_sn}}</td>
			<td>{{$v->cate_name}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->goods_price}}</td>
			<td>{{$v->goods_number}}</td>
			<td>{{$v->is_show==0?'否':'是'}}</td>
			<td>{{$v->is_new==0?'否':'是'}}</td>
			<td>{{$v->is_best==0?'否':'是'}}</td>
			<td>{{$v->is_slice==0?'否':'是'}}</td>
			<td>
			@if($v->goods_img)
			<img width="50" src="{{env('UPLOADS_URL')}}{{$v->goods_img}}">
			@endif
			</td>
			
            <td>
			@if($v->goods_imgs)
			@php $imgarr = explode('|',$v->goods_imgs);@endphp
			@foreach($imgarr as $img)
			<img src="{{env('UPLOADS_URL')}}{{$img}}" width="50">
			@endforeach
			@endif
			</td>
			<td>{{$v->goods_desc}}</td>
			<td>
			<a class="btn btn-primary" href="{{url('/goods/edit/'.$v->goods_id)}}">编辑</a>|<a class="btn btn-danger" goods_id="{{$v->goods_id}}" href="javascript:void(0)">删除</a>
			</td>
		</tr>
		@endforeach
		<tr><td colspan="13" align="center">{{$goods->appends(['name'=>$name,'cate_id'=>$cate_id,'brand_id'=>$brand_id,'min_price','max_price'])->links()}}</td></tr>
