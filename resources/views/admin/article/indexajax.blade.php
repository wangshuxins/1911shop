@foreach($article as $k=>$v)
		<tr @if($k%2==1)  class="danger" @else class="success" @endif>
		    <td><input type="checkbox">{{$v->article_id}}</td>
			<td>{{$v->article_title}}</td>
			<td>{{$v->cate_id}}</td>
			<td>{{$v->order_article==0?'普通':'置顶'}}</td>
			<td>{{$v->is_show==0?'√':'×'}}</td>
            <td>{{$v->article_man}}</td>
			<td>{{$v->article_email}}</td>
			<td>{{$v->article_key}}</td>
			<td>
			@if($v->article_img)
			<img width="50" src="{{env('UPLOADS_URL')}}{{$v->article_img}}">
			@endif
			</td>
			<td>{{$v->article_desc}}</td>
			<td>{{date("Y-m-d H:i:s",$v->article_time)}}</td>
			<td>
			<a class="btn btn-primary" href="{{url('/article/edit/'.$v->article_id)}}">编辑</a>|<a article_id="{{$v->article_id}}" class="btn btn-danger" href="javascript:void(0)">删除</a>
			</td>
		</tr>
		@endforeach
		<tr><td colspan="13" align="center">{{$article->appends(['name'=>$name,'cate_id'=>$cate_id])->links()}}</td></tr>