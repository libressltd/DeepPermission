<html>
	<tr>
		<td>name</td>
		<td>code</td>
		<td>group</td>
	</tr>
	@foreach (App\Models\Permission::with("group")->get() as $permission)
	<tr>
    <td>{{ $permission->name }}</td>
    <td>{{ $permission->code }}</td>
    <td>{{ $permission->group->code }}</td>
    </tr>
    @endforeach
</html>