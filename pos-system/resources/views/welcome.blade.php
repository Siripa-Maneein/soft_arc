@extends('layouts.app')

@section('content')
    <style>
        /* Remove bullet points from the list */
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        li {
            padding-bottom: 4px;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Welcome to POS system!</div>

                    <div class="card-body">
                        <div class="links">
                        <ul>
                            <li style="width: 200px;">
                                <a href="{{ route('items.index') }}" class="btn btn-primary mb-3" style="width: 100%;">Manage Items</a>
                            </li>
                            <li style="width: 200px;">
                                <a href="{{ route('sales.index') }}" class="btn btn-primary mb-3" style="width: 100%;">Manage Sales</a>
                            </li>
                            <li style="width: 200px;">
                                <a href="{{ route('members.index') }}" class="btn btn-primary mb-3" style="width: 100%;">Manage Members</a>
                            </li>
                        </ul>
                    </div>
                    </div>                     
                </div>
            </div>
        </div>
    </div>
@endsection
