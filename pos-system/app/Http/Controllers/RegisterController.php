<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Item;
use App\Models\Member;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function openNewSale(Request $request)
    {
        $request->session()->forget('member_id');
        $request->session()->forget('sale_line_items');
        $request->session()->forget('total');

        $request->session()->put('sale_line_items', []);
        $request->session()->put('total', 0);

        return redirect()->route('newSale');
    }

    public function addSaleLineItem(Request $request)
    {
        $request->validate([
            'item_id' => 'required|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        $item = Item::where('item_id', $request->item_id)->first();
        if (!$item) {
            return redirect()->route('newSale')->with('error', 'Item not found.');
        }

        if ($item->quantity < $request->quantity) {
            return redirect()->route('newSale')->with('error', 'Insufficient quantity of the item.');
        }
        $total = $request->session()->get('total', 0);
        $total += ($item->price * $request->quantity);
        $request->session()->put('total', $total);

        $saleLineItems = $request->session()->get('sale_line_items', []);
        $saleLineItems[] = ['item_id' => $request->item_id,
                            'name' => $item->name,  
                            'quantity' => intval($request->quantity), 
                            'price_per_item' => $item->price];
        $request->session()->put('sale_line_items', $saleLineItems);

        
        return redirect()->route('newSale');
    }

    public function removeSaleLineItem(Request $request) 
    {
        $request->validate([
            'saleLineItemIndex' => 'required|integer|min:0',
        ]);
        $saleLineItemIndex = $request->saleLineItemIndex;
        $saleLineItems = $request->session()->get('sale_line_items', []);
        if (!array_key_exists($saleLineItemIndex, $saleLineItems)) {
            return redirect()->route('newSale')->with('error', 'Sale line item not found.');
        }

        $saleLineItemToRemove = $saleLineItems[$saleLineItemIndex];
        
        $total = $request->session()->get('total', 0);
        $total -= $saleLineItemToRemove['price_per_item'] * $saleLineItemToRemove['quantity'];
        $request->session()->put('total', $total);
        
        unset($saleLineItems[$saleLineItemIndex]);
        $saleLineItems = array_values($saleLineItems);
        $request->session()->put('sale_line_items', $saleLineItems);
        return redirect()->route('newSale');
    }


    public function addMember(Request $request)
    {
        $request->validate([
            'member_id' => 'required|integer|min:1',
        ]);

        $member = Member::find($request->member_id);
        if (!$member) {
            return redirect()->back()->with('error', 'Member not found.');
        }
        if ($member->isExpired()) {
            return redirect()->back()->with('error', 'Member is expired.');
        }
        $request->session()->put('member_id', $request->member_id);
        return redirect()->route('newSale');
    }



    public function processPayment(Request $request)
    {
        $saleLineItems = $request->session()->get('sale_line_items', []);
        if (empty($saleLineItems)) {
            return redirect()->route('newSale')->with('error', 'No item to make payment.');
        }

        $total = $request->session()->get('total', 0);
        $member_id = $request->session()->get('member_id', 0);

        if ($member_id != 0) {
            $total = $total * 0.9;
        }

        $sale = Sale::create(['total' => $total, 
                                'payment_time' => now()->timezone('Asia/Bangkok'),
                                'payment_status' => true, 
                                'member_id' => $member_id]);

        foreach ($saleLineItems as $saleLineItem) {
            $sale->saleLineItems()->create([
                'item_id' => $saleLineItem['item_id'],
                'quantity' => $saleLineItem['quantity']
            ]);
            $item = Item::where('item_id', $saleLineItem['item_id'])->first();
            $item->reduceQuantity($saleLineItem['quantity']);
        }

        $request->session()->forget('member_id');
        $request->session()->forget('sale_line_items');
        $request->session()->forget('total');
        return redirect()->route('sales.index');
    }

    

    /**
     * Display a listing of the sales.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::all();
        return view('sales.index', compact('sales'));
    }

    /**
     * Remove the specified sale from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully');
    }

}
