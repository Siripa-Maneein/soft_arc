@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Member
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Member Form -->
                    <form action="{{ route('member.store') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        <!-- Member Name -->
                        <div class="form-group">
                            <label for="member-name" class="col-sm-3 control-label">Name</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="member-name" class="form-control" value="{{ old('name') }}">
                            </div>
                        </div>

                        <!-- Member Expired Date -->
                        <div class="form-group">
                            <label for="member-expired-date" class="col-sm-3 control-label">Expired Date</label>

                            <div class="col-sm-6">
                                <input type="date" name="expired_date" id="member-expired-date" class="form-control" value="{{ old('expired_date') }}">
                            </div>
                        </div>

                        <!-- Add Member Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Member
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- List of existing members -->
            @if (count($members) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Members
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped member-table">
                            <thead>
                                <th>Member ID</th>
                                <th>Name</th>
                                <th>Expired Date</th>
                                <th>Expired Status</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($members as $member)
                                <tr>
                                    <td class="table-text"><div>{{ $member->id }}</div></td>
                                    <td class="table-text"><div>{{ $member->name }}</div></td>
                                    <td class="table-text"><div>{{ $member->expired_date }}</div></td>
                                    <td class="table-text">
                                        <div style="color: {{ $member->expired_date < \Carbon\Carbon::now()->setTimezone('Asia/Bangkok') ? 'red' : 'green' }}">
                                            {{ $member->expired_date < \Carbon\Carbon::now()->setTimezone('Asia/Bangkok') ? 'Expired' : 'Active' }}
                                        </div>

                                    </td>

                                    <td>
                                        <a href="{{ route('member.edit', $member->id) }}" class="btn btn-primary">
                                            <i class="fa fa-btn fa-pencil"></i>Edit
                                        </a>
                                    </td>

                                    <td>
                                        <form action="{{ route('member.destroy', $member->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="panel panel-default">
                    <div class="panel-body">
                        No members found.
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
