@extends('layouts.app')
@section('URLL', 'Task Time')
@section('content')
<style>

    input.star {
        display: none
    }

    label.star {
        float: right;
        padding: 10px;
        font-size: 36px;
        color: #4A148C;
        transition: all .2s
    }

    input.star:checked~label.star:before {
        content: '\f005';
        color: #FD4;
        transition: all .25s
    }

    input.star-5:checked~label.star:before {
        color: #FE7;
        text-shadow: 0 0 20px #952
    }

    input.star-1:checked~label.star:before {
        color: #F62
    }

    label.star:hover {
        transform: rotate(-15deg) scale(1.3)
    }

    label.star:before {
        content: '\f006';
        font-family: FontAwesome
    }
</style>
<div class="container">
    <div class="col-md-8">
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title" style="color: white;"> {{$taskSel->user->name}} </h3>
          </div>
          <div class="card-body">
            @if (Session::has('message'))
            <div class="alert alert-success" role="alert">
                {{Session::get('message')}}
            </div>

            @endif
              <form method="POST" action="{{route('update.task',['id' => $userID])}}">
                  @csrf

                  <div class="form-group">

                      <div >
                        <input class="star star-5" id="star-5" type="radio" {{($taskSel->rating == 5 ? 'checked' : '')}}  value="5" name="star" />
                        <label class="star star-5" for="star-5"></label>
                         <input class="star star-4" id="star-4" type="radio" {{($taskSel->rating == 4 ? 'checked' : '')}} value="4" name="star" />
                          <label class="star star-4" for="star-4"></label>
                           <input class="star star-3" id="star-3" type="radio" {{($taskSel->rating == 3 ? 'checked' : '')}} value="3" name="star" />
                           <label class="star star-3" for="star-3"></label>
                            <input class="star star-2" id="star-2" type="radio" {{($taskSel->rating == 2 ? 'checked' : '')}} value="2" name="star" />
                             <label class="star star-2" for="star-2"></label>
                              <input class="star star-1" id="star-1" type="radio" {{($taskSel->rating == 1 ? 'checked' : '')}} value="1" name="star" />
                              <label class="star star-1" for="star-1"></label>

                      </div>
                  </div>
              <!-- select -->
              <div class="form-group">

                  <div >
                    <label>Rating and Task Status:</label>

                    <select class="form-control" id="status" name="status" style="width: 100%;" required>
                        <option hidden {{($taskSel == null)?"selected" : ""}} >Choose status</option>
                        <option value="0" @if($taskSel != null) {{($taskSel->status == 0)?"selected" : ""}} @endif >Inactive</option>
                        <option value="1" @if($taskSel != null) {{($taskSel->status == 1)?"selected" : ""}} @endif  >Active</option>
                      </select>
                  </div>
              </div>
            <!-- Date and time -->
            <div class="form-group">
                <label>Date and time:</label>
                  <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                      <input type="text" value="{{($taskSel == null)?'' : $taskSel->task_date}}" name="datee" class="form-control datetimepicker-input" data-target="#reservationdatetime" required/>
                      <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>

              </div>
              <button type="submit" class="btn btn-block btn-primary">Update</button>
            </form>
          </div>
            <div class="card-footer">
              Add Time To {{$taskSel->user->name}}.
            </div>
          <!-- /.card-body -->
        </div>
      </div>
</div>

@endsection

@push('scripts')

<script>
    $(function(){
        $('#reservationdatetime').datetimepicker({ format : 'Y-MM-DD h:m:s', icons: { time: 'far fa-clock' } })

    });
</script>

@endpush
