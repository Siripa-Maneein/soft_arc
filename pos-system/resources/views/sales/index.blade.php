@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add New Sale
                </div>
                <!-- Add New Sale Button -->
                <div class="panel-body">
                    <a href="{{ route('openNewSale') }}" class="btn btn-primary">Open Sale</a>
                </div>
            </div>

            <!-- Current Sales -->
            @if (count($sales ?? []) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Sales
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped sale-table">
                            <thead>
                                <th>Sale ID</th>
                                <th>Member ID</th>
                                <th>Total (฿)</th>
                                <th>Payment Time</th>
                                <th>Payment Status</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                            @foreach ($sales as $sale)
                                <tr>
                                    <td class="table-text"><div>{{ $sale->id }}</div></td>
                                    <td class="table-text"><div>{{ $sale->member_id }}</div></td>
                                    <td class="table-text"><div>{{ $sale->total }}</div></td>
                                    <td class="table-text"><div>{{ $sale->payment_time }}</div></td>
                                    <td class="table-text">
                                        <div style="color: {{ $sale->payment_status == 1 ? 'green' : 'red' }}">
                                            {{ $sale->payment_status == 1 ? 'paid' : 'unpaid' }}
                                        </div>
                                    </td>

                                    <!-- Sale Delete Button -->
                                    <td>
                                        <form action="{{url('sale/' . $sale->id)}}" method="POST">
                                            @csrf
                                            @method('delete')

                                            <button type="submit" id="delete-sale-{{ $sale->id}}" class="btn btn-danger">
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
            @endif
        </div>
    </div>
@endsection
