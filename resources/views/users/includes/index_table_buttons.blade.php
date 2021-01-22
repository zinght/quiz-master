
<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
        Options
    </button>
    <div class="dropdown-menu">
        <li><a type="button" href="{{route('users.edit', [$user])}}" class="dropdown-item edit_user">Edit</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><button type="button" class=" delete_user dropdown-item" data-url="{{route('users.delete', [$user])}}">Delete</button></li>
    </div>
</div>
