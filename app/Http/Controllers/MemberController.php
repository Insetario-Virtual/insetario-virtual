<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::all();
        return view('admin.members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $filename = $file->hashName();
            $file->storeAs('teamImages', $filename, 'public');
            $data['image_path'] = $filename;
        } else {
            unset($data['image_path']);
        }

        Member::create($data);

        return redirect()->route('admin.members.index')->with('success', 'Member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $member = Member::findOrFail($id);

        return view('admin.members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        $data = $request->validated();

        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $filename = $file->hashName();
            $file->storeAs('teamImages', $filename, 'public');
            $data['image_path'] = $filename;
        } else {
            unset($data['image_path']);
        }

        $member->update($data);

        return redirect()->route('admin.members.index')->with('success', 'Culture updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $member = Member::findOrFail($id);

        $member->delete();

        return redirect()->route('admin.site-data.index');
    }
}
