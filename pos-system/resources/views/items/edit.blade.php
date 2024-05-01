@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit
            </div>

            <div class="panel-body">
                <!-- Display Validation Errors -->
                @include('common.errors')
                
                <!-- New Item Form -->
                <form action="{{route('item.saveEdit', $item->id)}}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    @method('put')
                    <!-- Item id -->
                    <div class="form-group">
                        <label for="item-id" class="col-sm-3 control-label">Item Id</label>

                        <div class="col-sm-6">
                            <input type="text" name="item_id" id="item-id" class="form-control" value="{{ $item->item_id }}" disabled>
                        </div>
                    </div>

                    <!-- Item Name -->
                    <div class="form-group">
                        <label for="item-name" class="col-sm-3 control-label">Item Name</label>

                        <div class="col-sm-6">
                            <input type="text" name="name" id="item-name" class="form-control" value="{{ $item->name }}">
                        </div>
                    </div>

                    <!-- Item Description -->
                    <div class="form-group">
                        <label for="item-description" class="col-sm-3 control-label">Description</label>

                        <div class="col-sm-6">
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ $item->description }}</textarea>
                        </div>
                    </div>

                    <!-- Item Price -->
                    <div class="form-group">
                        <label for="item-price" class="col-sm-3 control-label">Price</label>

                        <div class="col-sm-6">
                            <input type="number" name="price" id="item-price" class="form-control" value="{{ $item->price }}">
                        </div>
                    </div>

                    <!-- Item Quantity -->
                    <div class="form-group">
                        <label for="item-quantity" class="col-sm-3 control-label">Quantity</label>

                        <div class="col-sm-6">
                            <input type="number" name="quantity" id="item-quantity" class="form-control" value="{{ $item->quantity }}">
                        </div>
                    </div>

                    <!-- Add Item Button -->
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
@endsection