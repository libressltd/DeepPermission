<html>
	@foreach (App\Models\Role::all() as $role)
    <td>{{ $role->name }}</td>
    <td>{{ $role->code }}</td>
    @endforeach
</html>