<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TeamMemberCard extends Component
{
    public $member;

    /**
     * Create a new component instance.
     *
     * @param  \App\Models\Member  $member
     */
    public function __construct($member)
    {
        $this->member = $member;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.team-member-card');
    }
}