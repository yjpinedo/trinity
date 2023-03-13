<?php

namespace App\Http\Livewire\Admin;

use App\Models\Member;
use App\Models\Sector;
use Livewire\Component;

class DashboardLivewire extends Component
{
    public $sectorConfig = [];
    public $memberConfig = [];

    public function render()
    {
        $sectorsList = Sector::orderBy('name', 'asc')->get();
        $sectors = [];
        $sectorNames = [];
        $sectorColors = [];
        $sectorBaptized = [];
        $sectorNotBaptized = [];
        $member_total = $this->totalMember();
        $memberBaptized = [
            'Si' => $this->getMemberBaptized('Si'),
            'No' => $this->getMemberBaptized('No'),
        ];

        foreach ($sectorsList as $sector) {
            $member_count = $this->countMemberBySector($sector->slug);
            $sectorNames[] = $sector->name;
            $sectorColors[] = $this->getColorHexadecimal($sector->color);
            $sectorBaptized[] =  $this->averageMemberBySector($this->countMemberBaptizedBySector($sector->slug, 'Si'), $member_count);
            $sectorNotBaptized[] =  $this->averageMemberBySector($this->countMemberBaptizedBySector($sector->slug, 'No'), $member_count);
            $sectors['sectors'][] = [
                'name' => $sector->name,
                'color' => $sector->color,
                'member_count' => $member_count,
                'member_average' => $this->averageMemberBySector($member_count, $member_total),
            ];
        }

        $sectors['member_total'] = $member_total;
        $this->sectorConfig['names'] = $sectorNames;
        $this->sectorConfig['colorHexa'] = $sectorColors;
        $this->sectorConfig['baptized'] = [
            'label' => ['Si', 'No'],
            'data' => [
                'si' => $sectorBaptized,
                'no' => $sectorNotBaptized,
            ]
        ];

        $this->memberConfig['baptized'] = [
            'names' => ['Si', 'No'],
            'data' => [$this->averageMemberBySector($memberBaptized['Si'], $member_total), $this->averageMemberBySector($memberBaptized['No'], $member_total)],
            'backgroundColor' => ['#17a2b8', '#001f3f'],
        ];

        return view('livewire.admin.dashboard-livewire', ['sectors' => $sectors])
            ->layout('components.layouts.app');
    }

    public function getMemberBaptized($action)
    {
        return Member::where('is_baptized', $action)->count();
    }

    public function totalMember()
    {
        return Member::count();
    }

    public function getColorHexadecimal($color)
    {
        $hexadecimal = '';
        switch ($color) {
            case 'info':
                $hexadecimal = '#17a2b8';
                break;
            case 'warning':
                $hexadecimal = '#ffc107';
                break;
            case 'white':
                $hexadecimal = '#1f2d3d';
                break;
            case 'danger':
                $hexadecimal = '#dc3545';
                break;
            case 'indigo':
                $hexadecimal = '#6610f2';
                break;
            default:
                $hexadecimal = '#001f3f';
                break;
        }

        return $hexadecimal;
    }

    public function countMemberBaptizedBySector($sector_slug, $action)
    {
        return Member::where('is_baptized', $action)->whereHas('neighborhood', function ($neighborhood) use ($sector_slug) {
            return $neighborhood->whereHas('sector', function ($sector) use ($sector_slug) {
                return $sector->where('slug', $sector_slug);
            });
        })->count();
    }

    public function countMemberBySector($sector_slug)
    {
        return Member::whereHas('neighborhood', function ($neighborhood) use ($sector_slug) {
            return $neighborhood->whereHas('sector', function ($sector) use ($sector_slug) {
                return $sector->where('slug', $sector_slug);
            });
        })->count();
    }

    public function averageMemberBySector($member_count, $member_total)
    {
        return intval(round(floatval(((int)$member_count * 100) / (int)$member_total)));
    }
}
