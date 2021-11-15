<?php

namespace App\Http\Controllers;

use App\Models\Button;
use Illuminate\Http\Request;

class ButtonController extends Controller
{
    private $positionsCount = 9;

    public function edit($position)
    {
        // Validate position
        if (!($position >= 1 && $position <= $this->positionsCount)) {
            return redirect()->route('dashboard.index')->with('warning', 'Warning! Position ' . $position . ' is not valid!');
        }

        // Find or Create the Button for the given position
        $userId = auth()->id();
        $button = Button::where('user_id', $userId)->where('position', $position)->first();

        if ($button == null) {
            $button = Button::create([
                'user_id' => $userId,
                'position' => $position,
                'title' => 'Title here',
                'link' => '#',
                'color' => '#000000',
                'icon' => 'fas fa-plus-circle',
            ]);
        }

        return view('buttons.edit', compact('button'));
    }

    public function update($position, Request $request)
    {
        // Validate position
        if (!($position >= 1 && $position <= $this->positionsCount)) {
            return redirect()->route('dashboard.index')->with('warning', 'Warning! Position ' . $position . ' is not valid!');
        }

        // Validate button existence
        $userId = auth()->id();
        $button = Button::where('user_id', $userId)->where('position', $position)->first();

        if ($button == null) {
            return redirect()->route('buttons.edit', $position);
        }

        // Validate input data
        $request->validate([
            'title' => 'required',
            'link' => 'required',
            'color' => 'required',
            'icon' => 'required',
        ]);

        // Update button's data
        $button->update([
            'title' => $request->title,
            'link' => $request->link,
            'color' => $request->color,
            'icon' => $request->icon,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Success! The data of button with position ' . $position . ' has been updated successfully!');
    }

    public function destroy($position)
    {
        // Validate position
        if (!($position >= 1 && $position <= $this->positionsCount)) {
            return redirect()->route('dashboard.index')->with('warning', 'Warning! Position ' . $position . ' is not valid!');
        }

        // Find the Button for the given position
        $userId = auth()->id();
        $button = Button::where('user_id', $userId)->where('position', $position)->first();

        if ($button) {
            $button->delete();
        }

        return redirect()->route('dashboard.index')->with('success', 'Success! The data of button with position ' . $position . ' has been deleted successfully!');
    }
}
