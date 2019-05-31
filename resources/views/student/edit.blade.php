@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
           <form id="student-edit">
            <input type="hidden" name="_token" id="csrf_token_input" value="{{ csrf_token() }}" >
            <input type="hidden" name="id" id="id" value="{{$data->id}}">
              <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" id="name" value="{{ $data->name}}" class="form-control" required>
              </div>
              <div class="form-group">
                  <label>DOB</label>
                  <input type="text" name="dob" id="dob" value="{{ $data->dob }}" class="form-control" required>
              </div>
              <div class="form-group">
                  <label>Phone</label>
                  <input type="text" name="phone" id="phone" value="{{ $data->phone }}" class="form-control" required>
              </div>
              <div class="form-group">
                  <input type="submit" class="btn btn-primary" id="send">
                   <!-- <input type="button" value="Send" class="btn btn-success" id="send"> -->
              </div>
          </form>

        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>


    $(document).ready(function(e){
        $("#student-edit").on('submit', function(e){
            e.preventDefault();
            
            var name = $("#name").val();
            var dob = $("#dob").val();
            var phone = $("#phone").val();
            var id =  $("#id").val();
            $.ajax({
            	headers: { 'X-CSRF-Token' : $('#csrf_token_input').val() },
                type: "POST",
                url : '{{url("student_update")}}',
                dataType: "json",
                data: { 'name':name,'dob':dob,'phone':phone, 'id':id },
                success:function(data){ 
                    window.location.href = '/student';
                }
            });
        });
    });
</script>
@endsection
