<form method="post" action="/store">
	@csrf
	<table>
	<tr>
		<td>学生添加</td>
		<td><input type="text" name="sname"></td>
	</tr>
	<tr>
		<td><input type="submit"></td>
		<td></td>
	</tr>
	</table>
</form>
<a href="/list">列表</a>