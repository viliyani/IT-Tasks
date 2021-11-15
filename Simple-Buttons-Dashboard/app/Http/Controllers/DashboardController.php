<?php

namespace App\Http\Controllers;

use App\Models\Button;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $positionsCount = 9;

    public function index()
    {
        $buttonsData = [];

        $userId = auth()->id();
        $userButtons = Button::where('user_id', $userId)->orderBy('position', 'asc')->get();
        $ubIdx = 0;
        $ubTotal = count($userButtons);

        for ($i = 1; $i <= $this->positionsCount; $i++) {
            $currentData = [];

            if ($ubIdx < $ubTotal && $userButtons[$ubIdx]['position'] == $i) {

                $currentButton = $userButtons[$ubIdx];

                $currentData = [
                    'position' => $i,
                    'title' => $currentButton['title'],
                    'link' => $currentButton['link'],
                    'color' => $currentButton['color'],
                    'icon' => $currentButton['icon'],
                    'is_new' => '0',
                ];

                $ubIdx++;
            } else {
                $currentData = [
                    'position' => $i,
                    'title' => 'Add Button',
                    'link' => route('buttons.edit', $i),
                    'color' => '#000000',
                    'icon' => 'fas fa-plus-circle',
                    'is_new' => '1',
                ];
            }

            $buttonsData[] = $currentData;
        }

        return view('dashboard.index', compact('buttonsData'));
    }
}
