@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Contacts</div>

                <div class="panel-body">
                    @include('user.contacts', ['contacts' => Auth::user()->contacts])
                </div>
            </div>
        </div>    
        <div class="col-md-8">
            <div class="panel panel-default" id="dashboard">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="message" id="message-template">
    <span class="created-by"></span>
    <span class="created-at"></span>
    <p class="content"></p>
</div>
@endsection
