@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Member
            </div>

            <div class="panel-body">
                <!-- Display Validation Errors -->
                @include('common.errors')

                <!-- Edit Member Form -->
                <form action="{{ route('member.saveEdit', $member->id) }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <!-- Member Name -->
                    <div class="form-group">
                        <label for="member-name" class="col-sm-3 control-label">Name</label>

                        <div class="col-sm-6">
                            <input type="text" name="name" id="member-name" class="form-control" value="{{ $member->name }}">
                        </div>
                    </div>

                    <!-- Member Expired Date -->
                    <div class="form-group">
                        <label for="member-expired-date" class="col-sm-3 control-label">Expired Date</label>

                        <div class="col-sm-6">
                            <input type="date" name="expired_date" id="member-expired-date" class="form-control" value="{{ $member->expired_date ? \Carbon\Carbon::parse($member->expired_date)->format('Y-m-d') : '' }}">
                        </div>

                    </div>

                    <!-- Update Member Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-save"></i>Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
