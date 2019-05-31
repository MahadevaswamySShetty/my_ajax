@extends('layouts.app')

@section('content')
<?php
$i=1;
?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div>
                <div class="alert alert-success alert-dismissible" style="display:none">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
                <!-- <div class="alert alert-success alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  
                </div> -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">New</button><br><br>

              <!-- Modal -->
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Student</h4>
                    </div>
                    <div class="modal-body">
                      <form id="student-form">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                          <div class="form-group">
                              <label>Name</label>
                              <input type="text" name="name" id="name" class="form-control" required>
                          </div>
                          <div class="form-group">
                              <label>DOB</label>
                              <input type="text" name="dob" id="dob" class="form-control" required>
                          </div>
                          <div class="form-group">
                              <label>Phone</label>
                              <input type="text" name="phone" id="phone" class="form-control" required>
                          </div>
                          <div class="form-group">
                              <input type="submit" class="btn btn-primary" id="send">
                               <!-- <input type="button" value="Send" class="btn btn-success" id="send"> -->
                          </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>DOB</th>
                        <th>Phone</th>
                        <th>Auction</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $data)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->dob }}</td>
                        <td>{{ $data->phone }}</td>
                        <td>
                            <a href="{{url('student_edit/'.$data->id)}}" class="btn btn-warning">Edit</a>
                            <form id="deleteStudent">
                                <input type="hidden" id="s_id" value="{{$data->id}}">
                                <button class="btn btn-danger">Delete</button>
                            </form>
                            <!-- <a href="{{ url('student_delete/'.$data->id)}}" class="btn btn-danger">Delete</a> -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
    $(document).ready(function(e){
     $("#student-form").on('submit',function(e){      
        e.preventDefault();
        //alert("hi");
        var token = $("input[name='_token']").val();
        var name = $("input[name='name']").val();
        var dob = $("input[name='dob']").val();
        var phone = $("input[name='phone']").val();
        $.ajax({
            type: "POST",
            url: '{{url("student_store")}}',
            dataType: "json",
            data: {'_token':token,'name':name,'dob':dob,'phone':phone},
            success:function(data){
                
                $('.modal').each(function(){
                    $(this).modal('hide');
                });
                jQuery('.alert').show();
                jQuery('.alert').html(data.success);  
                window.location.href = '/student'; 
            }
        });
        
    });

     //delete
    $("#deleteStudent").click(function(){
        var id = $("#s_id").val();
        var token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            url: 'student_delete/'+id,
            type: "GET",
            dataType: "json",
            data:{ 'id':id, '_token':token},
            success:function(data){
                jQuery('.alert').show();
                jQuery('.alert').html(data.success);
                window.location.href = '/student'; 
            }
        });
    });

   }); 

    
</script>
@endsection
