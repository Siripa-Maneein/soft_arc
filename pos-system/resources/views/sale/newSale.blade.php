@extends('layouts.app')

@section('content')
<style>
    /* Remove bullet points from the list */
    ul {
        list-style-type: none;
        padding: 2;
        margin: 0;
    }
    table {
        border-collapse: collapse;
    }

    th, td {
        padding-left: 8px; /* Horizontal padding on the left side */
        padding-right: 8px; /* Horizontal padding on the right side */
        padding-top: 4px; /* Minimal vertical padding */
        padding-bottom: 4px; /* Minimal vertical padding */
    }
</style>
<div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <!-- Display any error messages -->
            @if(session('error'))
                <p style="color: red;">{{ session('error') }}</p>
             @endif
            <!-- Show sale line items -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Sale
                </div>
                <div class="panel-body">
                <table>
                    <tr>
                        <th>Item ID</th>
                        <th>Name</th>
                        <th>Price/Item (฿)</th>
                        <th>Quantity</th>
                        <th>Price (฿)</th>
                    </tr>
                    @foreach(session('sale_line_items', []) as $index => $saleLineItem)
                        <tr>
                            <td>{{ $saleLineItem['item_id'] }}</td>
                            <td>{{ $saleLineItem['name'] }}</td>
                            <td>{{ $saleLineItem['price_per_item'] }}</td>
                            <td>{{ $saleLineItem['quantity'] }}</td>
                            <td>{{ $saleLineItem['price_per_item'] * $saleLineItem['quantity'] }}</td>
                            <td>
                                <!-- Button to remove the sale line item -->
                                <form action="{{ route('removeSaleLineItem', ['saleLineItemIndex' => $index]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to remove this item?')">-</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </table>
                </div>
                <div class="panel-heading">
                    Member ID: {{ session('member_id', 'None') }}
                </div>
                <div class="panel-heading">
                    Total before discount: {{ session('total', 0) }} Baht <br>
                    @if(session('member_id', 0) != 0)
                        Discount: {{ session('total', 0) * 0.1 }} Baht <br>
                    @else
                        Discount: 0 Baht <br>
                    @endif
                    Total after discount: 
                    @if(session('member_id', 0) != 0)
                        {{ session('total', 0) - session('total', 0) * 0.1 }}
                    @else
                        {{ session('total', 0) }}
                    @endif
                    Baht
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add Sale Line Item
                </div>
                <div class="panel-body">
                    <form action="{{ route('addSaleLineItem') }}" method="post">
                        @csrf
                        <label for="item_id">Item ID:</label>
                        <input type="text" name="item_id" id="item_id" required>
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" required min="1">
                        <button type="submit">Add Sale Line Item</button>
                    </form>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Add Member
                </div>
                <div class="panel-body">
                    <form action="{{ route('addMember') }}" method="post">
                        @csrf
                        <label for="member_id">Member ID:</label>
                        <input type="text" name="member_id" id="member_id" required>
                        <button type="submit">Add Member</button>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                Process payment
                </div>
                <div class="panel-body">
                    <!-- Form to make payment -->
                    <form action="{{ route('processPayment') }}" method="post">
                        @csrf
                        <button type="submit">Process Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection