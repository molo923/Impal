<?php

namespace App\Http\Controllers\Banksampah;

use App\Setoran;
use App\Repositories\SetoranRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\SetoranRequest;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class SetoranController extends Controller
{
    private $setoranRepository;

    public function __construct(SetoranRepository $setoranRepository)
    {
        $this->setoranRepository = $setoranRepository;
    }

    public function index()
    {
        $this->authorize('viewAny', Setoran::class);

        $setorans = $this->setoranRepository->all();

        return view('banksampah.setoran.index', [
            'title' => 'Setoran Sampah',
            'setorans' => $setorans,
        ]);
    }

    public function create()
    {
        return view('banksampah.setoran.create', [
            'title' => 'Tambah Setoran',
        ]);
    }

    public function store(SetoranRequest $request)
    {
        $this->setoranRepository->store($request);

        return redirect(route('setoran.index'))->with('status', 'Setoran berhasil ditambahkan');
    }

    public function show($id)
    {
        if (request()->ajax()) {
            $setoran = Setoran::find($id);

            return $this->setoranRepository->show($setoran);
        }

        $setoran = Setoran::find($this->handleDecryptException($id));

        return view('banksampah.setoran.show', [
            'title' => 'Detail Setoran',
            'setoran' => $setoran->load(['setoranDetail' => function ($query) {
                $query->with(['status', 'kategorisampah']);
            }]),
        ]);
    }

    public function edit($id)
    {
        $setoran = Setoran::find($this->handleDecryptException($id));
        $this->authorize('update', $setoran);

        $this->setoranRepository->show($setoran);

        return view('banksampah.setoran.edit', [
            'title' => 'Edit Setoran '.$setoran->id_pretty,
            'setoran' => $setoran,
        ]);
    }

    public function done($id)
    {
        $setoran = Setoran::find($this->handleDecryptException($id));
        $this->authorize('update', $setoran);

        $this->setoranRepository->setSetoran($setoran);
        $this->setoranRepository->done();

        return redirect(route('setoran.index'))->with('status', 'Setoran berhasil diselesaikan');
    }

    public function reject($id)
    {
        $setoran = Setoran::find($this->handleDecryptException($id));
        $this->authorize('update', $setoran);

        $this->setoranRepository->setSetoran($setoran);
        $this->setoranRepository->reject();

        return redirect(route('setoran.index'))->with('status', 'Setoran berhasil direject');
    }

    public function update(SetoranRequest $request, Setoran $setoran)
    {
        $this->setoranRepository->setSetoran($setoran);

        $this->setoranRepository->update($request->all());

        return redirect(route('setoran.index'))->with('status', 'Setoran berhasil diubah');
    }

    private function handleDecryptException($id) {
        try {
                $decrypted = Crypt::decrypt($id);
                return $decrypted;
            } catch (DecryptException $e) {
                return abort(404);
            }
    }
}
