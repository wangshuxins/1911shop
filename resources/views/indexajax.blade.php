\
		@foreach($news as $k=>$v)
		<tr>
		    <td>{{$v->nid}}</td>
			<td>{{$v->name}}</td>
			<td>{{$v->ndesc}}</td>
			
			
		</tr>
		@endforeach
	<!-- ->appends(['brand_name'=>$brand_name])	 -->
<tr><td colspan="5" align="center">{{$news->links()}}</td></tr>