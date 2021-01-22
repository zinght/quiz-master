<div class="modal" id="add_question_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="{{$formurl}}" id="add_question_modal_form" method="post" >

        @csrf
        <div class="modal-dialog modal-lg modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@if($type == "add") Create @else Edit @endif Question</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="question" @if($type == "view") disabled @endif>Question</label>
                                <input type="text" @if($type == "view") disabled @endif class="form-control" name="question" id="question" required value="@if(in_array($type, ["edit", "view"])) {{$question->question}} @else {{old('question')}} @endif">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="answer" @if($type == "view") disabled @endif>Answer</label>
                                <input type="text" @if($type == "view") disabled @endif class="form-control" name="answer" id="answer" required value="@if(in_array($type, ["edit", "view"])) {{$question->answer}} @else {{old('answer')}} @endif">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="clue">Clue</label>
                                <textarea rows="1" cols="50" wrap="physical"  type="text" class="form-control" maxlength="255" name="clue" id="clue"   @if($type == "view") disabled @endif>@if($type == "edit"){{$question->clue}}@else{{old('clue')}}@endif</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger float-right" >Delete</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $( document ).ready(function() {

    });
</script>
