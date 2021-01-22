<div class="col-10">
    @if($quiz->questions->count() > 0)
        @foreach($quiz->questions as $question)
            <div class="card my-4">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        Question: {{$question->position}}
                    </div>
                    <div>
                        <a class="btn btn-warning btn-xs">edit</a>
                    </div>

                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="question">Question</label>
                                    <input type="text" disabled value="{{$question->question}}" class="form-control" name="question">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="answer">Answer</label>
                                <input type="text" disabled value="{{$question->answer}}" class="form-control" name="answer">
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        @endforeach
    @else
        <div class="alert alert-info">
            No Questions Found
        </div>
    @endif
</div>
