<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InsectCard extends Component
{
    public $id;
    public $common_name;
    public $scientific_name;
    public $imagePath;

    public function __construct($id, $common_name = null, $scientific_name = null, $imagePath = null)
    {
        $this->id = $id;
        $this->common_name = $common_name;
        $this->scientific_name = $scientific_name;
        $this->imagePath = $imagePath;
    }

    public function render()
    {
        return view('components.insect-card');
    }

    public function formattedCommonName()
    {
        return ucfirst($this->common_name);
    }

    public function formattedScientificName()
    {
        if ($this->scientific_name === null) {
            return '';
        }

        return preg_replace(
            '/\b(sp|spp|cf|var|subsp|f|n)\.?$/i',
            '<span class="not-italic">$1</span>',
            trim($this->scientific_name)
        );
    }
}