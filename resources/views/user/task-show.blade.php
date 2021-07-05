@extends('layouts.app')
@section('URLL', 'Task Time')
@section('content')
<style>
    .checked {
  color: orange;
}
    .mom{
        color: #333;
  margin: 0 auto;
  text-align: center;
  display: block;
  font-size: 1.5rem;
    }
</style>



@if($taskTim != null)


@if($taskTim->rating == 0)
@for($i=0; $i < 5 ; $i++)
<span class="fa fa-star "></span>
@endfor

@elseif($taskTim->rating == 1)
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span>

@elseif($taskTim->rating == 2)
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span>

@elseif($taskTim->rating == 3)
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span>
@elseif($taskTim->rating == 4)
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
@elseif($taskTim->rating == 5)
@for($i=0; $i < 5 ; $i++)
<span class="fa fa-star checked"></span>
@endfor
@endif

@if( $taskTim->status == 1)
<style>

.cont {
  color: #333;
  margin: 0 auto;
  text-align: center;
}
.lii {
  display: inline-block;
  font-size: 1.5em;
  list-style-type: none;
  padding: 1em;
  text-transform: uppercase;
}

.sp {
  display: block;
  font-size: 4.5rem;
}

.emoji {
  display: none;
  padding: 1rem;
}

.emoji span {
  font-size: 4rem;
  padding: 0 .5rem;
}

@media all and (max-width: 768px) {
  .h {
    font-size: 1.5rem;
  }

  .lii {
    font-size: 1.125rem;
    padding: .75rem;
  }

  .sp {
    font-size: 3.375rem;
  }
}
</style>


<div class="container cont">
    <h1 class="h" id="headline">Countdown To Your Task:</h1>
    <div id="countdown">
      <ul>
        <li class="lii"><span class="sp" id="days"></span>days</li>
        <li class="lii"><span class="sp" id="hours"></span>Hours</li>
        <li class="lii"><span class="sp" id="minutes"></span>Minutes</li>
        <li class="lii"><span class="sp" id="seconds"></span>Seconds</li>
      </ul>
    </div>
    <div id="content" class="emoji">
      <span>🥳</span>
      <span>🎉</span>
    </div>
  </div>
  @else
  <p class="mom" >There Is No Task At The Moment !</p>
@endif

@else

<div class="container">
    @for($i=0; $i < 5 ; $i++)
    <span class="fa fa-star "></span>
    @endfor
    </div>
<p class="mom">There Is No Task At The Moment !</p>
@endif




@endsection

@push('scripts')

<script type="text/javascript">
    (function () {
  const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;

  let birthday = "{{($taskTim == null) ?'' : Carbon\Carbon::parse($taskTim->task_date)->format('Y/m/d h:m:s')}}",
      countDown = new Date(birthday).getTime(),
      x = setInterval(function() {

        let now = new Date().getTime(),
            distance = countDown - now;

        document.getElementById("days").innerText = Math.floor(distance / (day)),
          document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
          document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
          document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);

        //do something later when date is reached
        if (distance < 0) {
          let headline = document.getElementById("headline"),
              countdown = document.getElementById("countdown"),
              content = document.getElementById("content");

          headline.innerText = "Time Is Over!";
          countdown.style.display = "none";
          content.style.display = "block";

          clearInterval(x);
        }
        //seconds
      }, 0)
  }());
  </script>

@endpush
