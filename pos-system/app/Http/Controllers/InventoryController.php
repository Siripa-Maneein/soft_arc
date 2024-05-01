<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class InventoryController extends Controller
{
    /**
     * Display a list of all items.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }


    /**
     * Store a newly created item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_id' =>  'required|max:255',
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        Item::create([
            'item_id' => $request->item_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    /**
     * Remove the specified item from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }



    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveEdit(Request $request, Item $item)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        // Update the item with the validated data
        $item->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);

        // Redirect back to the item list page with a success message
        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }
}
