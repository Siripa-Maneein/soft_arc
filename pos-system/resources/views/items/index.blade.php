@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Item
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Item Form -->
                    <form action="{{ url('item') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        <!-- Item id -->
                        <div class="form-group">
                            <label for="item-id" class="col-sm-3 control-label">Item Id</label>

                            <div class="col-sm-6">
                                <input type="text" name="item_id" id="item-id" class="form-control" value="{{ old('item-id') }}">
                            </div>
                        </div>

                        <!-- Item Name -->
                        <div class="form-group">
                            <label for="item-name" class="col-sm-3 control-label">Item Name</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="item-name" class="form-control" value="{{ old('name') }}">
                            </div>
                        </div>

                        <!-- Item Description -->
                        <div class="form-group">
                            <label for="item-description" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-6">
                                <textarea name="description" id="item-description" class="form-control">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <!-- Item Price -->
                        <div class="form-group">
                            <label for="item-price" class="col-sm-3 control-label">Price</label>

                            <div class="col-sm-6">
                                <input type="number" name="price" id="item-price" class="form-control" value="{{ old('price') }}">
                            </div>
                        </div>

                        <!-- Item Quantity -->
                        <div class="form-group">
                            <label for="item-quantity" class="col-sm-3 control-label">Quantity</label>

                            <div class="col-sm-6">
                                <input type="number" name="quantity" id="item-quantity" class="form-control" value="{{ old('quantity') }}">
                            </div>
                        </div>

                        <!-- Add Item Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Item
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Current Items -->
            @if (count($items ?? []) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Items
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped item-table">
                            <thead>
                                <th>Item Id</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                            @foreach ($items as $item)
                                    <tr>
                                        <td class="table-text"><div>{{ $item->item_id }}</div></td>
                                        <td class="table-text"><div>{{ $item->name }}</div></td>
                                        <td class="table-text"><div>{{ $item->description }}</div></td>
                                        <td class="table-text"><div>{{ $item->price }}</div></td>
                                        <td class="table-text"><div>{{ $item->quantity }}</div></td>
                                        <!-- Edit Button -->
                                        <td>
                                            <a href="{{ route('item.edit', $item->id) }}" class="btn btn-primary">
                                                <i class="fa fa-btn fa-pencil"></i>Edit
                                            </a>
                                        </td>

                                        <!-- Item Delete Button -->
                                        <td>
                                            <form action="{{url('item/' . $item->id)}}" method="POST">
                                                @csrf
                                                @method('delete')

                                                <button type="submit" id="delete-item-{{ $item->id}}" class="btn btn-danger">
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
