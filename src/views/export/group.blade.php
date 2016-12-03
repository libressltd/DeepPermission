<html>
	@foreach (App\Models\Permission_group::all() as $group)
    <td>{{ $group->name }}</td>
    <td>{{ $group->code }}</td>
    @endforeach
</html>