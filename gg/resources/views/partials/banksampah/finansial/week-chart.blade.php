<div>
    <p class="text-right font-medium">Minggu ini</p>
</div>
<div>
    <div class="card">
        <div class="card-body p-0">
            <canvas id="myChart"></canvas>
        </div>
    </div>
</div>
<div>
    <div class="row no-gutters">
        <div class="col-md-4 mb-2 mb-lg-0">
            <div class="border px-4 pt-2">
                <h5>Pemasukan</h5>
                <h4 class="text-success">@rp($pemasukans->sum('price_total_nett'))</h4>
            </div>
        </div>
        <div class="col-md-4 mb-2 mb-lg-0">
            <div class="border px-4 pt-2">
                <h5>Pengeluaran</h5>
                <h4 class="text-danger">@rp($pengeluarans->sum('price_total_nett'))</h4>
            </div>
        </div>
        <div class="col-md-4 mb-2 mb-lg-0">
            <div class="border px-4 pt-2">
                <h5>Tersedia</h5>
                <h4 class="text-secondary">@rp($pemasukans->sum('price_total_nett') - $pengeluarans->sum('price_total_nett'))</h4>
            </div>
        </div>
    </div>
</div>

