<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use App\Http\Requests\MembersForm;
use App\Member;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('members.index', ['members' => Member::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MembersForm $form
     * @return \Illuminate\Http\Response
     */
    public function store(MembersForm $form)
    {
        $form->persist();

        return redirect()->route('members.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {   
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Member $member)
    {
        $validator = Validator::make(request()->all(), [
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'contact_no' => 'required',
        ]);

        if($validator->fails()) {
            return redirect('members/' . $member->id 
                . '?ref=edit_member_fail')
                ->withErrors($validator)
                ->withInput();
        }

        $member->first_name = request('first_name');
        $member->middle_name = request('middle_name');
        $member->last_name = request('last_name');
        $member->address = request('address');
        $member->contact_no = request('contact_no');
        $member->save();

        return redirect(route('members.show', $member->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect(route('members.index'));
    }
}
