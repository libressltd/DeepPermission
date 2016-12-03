<html>
	@foreach (App\Models\Permission::with("group")->get() as $permission)
    <td>{{ $permission->name }}</td>
    <td>{{ $permission->code }}</td>
    <td>{{ $permission->group->code }}</td>
    @endforeach
</html>