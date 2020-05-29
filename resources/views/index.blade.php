<center>
<form method="" action="" align="center">
		
		品牌名称:<input type="text" style="width:170px" name="name" id="firstname" value="{{$name}}"  placeholder="新闻名称">
		
		

		<button>搜索</button>
</form>
<table class="table" border="1">
	<caption>新闻</caption>
	<thead>
		<tr>
			<th>新闻ID</th>
			<th>新闻名称</th>
			<th>新闻简介</th>
			
		</tr>
	</thead>
	<tbody>
		@foreach($news as $k=>$v)
		<tr>
		    <td>{{$v->nid}}</td>
			<td>{{$v->name}}</td>
			<td>{{$v->ndesc}}</td>
			
			
		</tr>
		@endforeach
		<tr ><td colspan="3">{{$news ->appends(['name'=>$name])->links()}}</td></tr>
	</tbody>
</table>

</center>
