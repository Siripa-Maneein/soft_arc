<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    /**
     * Display a list of all members.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $members = Member::all();
        return view('members.index', compact('members'));
    }

    /**
     * Store a newly created member in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'expired_date' => 'required|date|after:today',
        ]);        

        Member::create([
            'name' => $request->name,
            'expired_date' => $request->expired_date,
        ]);

        return redirect()->route('members.index')->with('success', 'Member created successfully.');
    }

    /**
     * Remove the specified member from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function saveEdit(Request $request, Member $member)
    {
    $request->validate([
        'name' => 'required|max:255',
        'expired_date' => 'required|date|after:today',
    ]);

    $member->update([
        'name' => $request->name,
        'expired_date' => $request->expired_date,
    ]);

    return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }



}
