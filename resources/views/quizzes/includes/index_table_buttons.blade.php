@if(Auth::user()->can('edit quizzes') || Auth::user()->can('delete quizzes'))
<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
        Options
    </button>
    <div class="dropdown-menu" style="overflow-y: hidden">
        <li><a type="button " href="{{route('quizzes.view', [$quiz])}}" class=" dropdown-item btn"  >View</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a type="button " href="{{route('quizzes.edit.edit', [$quiz])}}" class=" dropdown-item btng edit_quiz"  >Edit</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><button type="button" class="btn  delete_quiz dropdown-item" data-url="{{route('quizzes.delete', [$quiz])}}">Delete</button></li>

    </div>
</div>
@else
    <a class="btn btn-success btn-sm " href="{{route('quizzes.view', [$quiz])}}">View</a>
@endif
