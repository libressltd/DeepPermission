<html>
	@foreach (App\Models\Role_permission::with("role", "permission")->get() as $rp)
    <td>{{ $rp->role->code }}</td>
    <td>{{ $rp->permission->code }}</td>
    @endforeach
</html>