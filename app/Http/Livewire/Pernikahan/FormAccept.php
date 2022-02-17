<?php

namespace App\Http\Livewire\Pernikahan;



use Livewire\Component;
use App\Models\Pernikahan;
use Illuminate\Support\Carbon;

class FormAccept extends Component
{
    public $modal = false,
            $filterKua,
            $dateRange;

    protected $listeners = [
        'create',
        'updateKuaDate',
        'acceptPerRow',
    ];

    public function updateKuaDate($filterKua, $dateRange)
    {
        $this->filterKua = $filterKua;
        $this->dateRange = $dateRange;
    }

    public function render()
    {
        return view('livewire.pernikahan.form-accept');
    }

    public function create()
    {
        $this->modal = true;
    }

    public function storeOrUpdate()
    {
        $date            = null;
        $dateRange       = null;
        if (count($this->dateRange) == 2) {
            $dateRange  = [Carbon::createFromFormat('d/m/Y', $this->dateRange[0])->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $this->dateRange[1])->format('Y-m-d') ];
        } else {
            $date = [Carbon::createFromFormat('d/m/Y', $this->dateRange[0])->format('Y-m-d')];
        }

        Pernikahan::where('kua_id', $this->filterKua)
                    ->when($dateRange, function($query, $dateRange) {
                        $query->whereBetween('date_time', $dateRange);
                    })
                    ->when($date, fn($q)=> $q->whereDate('date_time', $date))
                    ->update([
                        'approve' => 'acc',
                        'note'    => null,
                    ]);

        session()->flash('message', 'Data pernikahan berhasil di ACC');

        return redirect('pernikahan');
    }

    public function acceptPerRow($id)
    {
        $pernikahan          = Pernikahan::find($id);
        $pernikahan->approve = 'acc';
        $pernikahan->note    = null;
        $pernikahan->save();

        session()->flash('message', 'Data pernikahan ' .$pernikahan->male. ' berhasil di ACC');

        return redirect('pernikahan');
    }

    public function closeModal()
    {
        $this->modal = false;
    }

}
