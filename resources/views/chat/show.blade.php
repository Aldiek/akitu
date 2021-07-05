@extends('layouts.app')
@section('URLL', 'Chat')
@section('content')
    <div class="container-fluid">
        <div class="container">
            @livewire('chat.show', ['users' => $users, 'messages' => $messages, 'sender' => $sender])
        </div>
    </div>
@endsection
