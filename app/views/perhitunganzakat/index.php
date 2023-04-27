<div class="container">
  <div class="content">

    <div class="title mb-10">
      <h3 class="text-title">Perhitungan Zakat</h3>
      <span class="text-sm text-lightgray mt-2 inline-block">Hitung Berapa Zakat Yang Harus Kamu Keluarkan Tahun Ini</span>
    </div>

    <div class="flex flex-wrap">
      <div class="w-full md:w-1/2 text-lightgray px-4 mb-5">
        <h4 class="text-lg text-darkgray mb-5">Komponen Zakat</h4>
        <p class="text-lightgray text-sm mb-3">Silahkan diisi dengan pendapatan bulanan Anda. Perhitungan Nisab tetap didasarkan pada nisab emas 85 gr yang dihitung bulanan</p>
        <label for="gajibulanan" class="block">
          <h5 class="block text-sm">Pendapatan Gaji Bulanan</h5>
          <input type="text" id="gajibulanan" class="border-2 w-full px-2 py-1 mb-3 outline-none" onkeypress="return countOnly(event)" value="0">
        </label>
        <label for="gajilain" class="block">
          <h5 class="block text-sm">Pendapatan Lain Bulanan</h5>
          <input type="text" id="gajilain" class="border-2 w-full px-2 py-1 mb-3 outline-none" onkeypress="return countOnly(event)" value="0">
        </label>
        <label for="cicilan" class="block">
          <h5 class="block text-sm">Hutang/Cicilan Bulanan</h5>
          <input type="text" id="cicilan" class="border-2 w-full px-2 py-1 mb-3 outline-none" onkeypress="return countOnly(event)" value="0">
        </label>
      </div>

      <div class="w-full md:w-1/2 px-4 text-lightgray">
        <h4 class="text-lg text-darkgray mb-5">Nilai Zakat</h4>
        <p class="text-lightgray text-sm mb-3">Berikut hasil perhitungan zakat yang harus Anda keluarkan tahun ini</p>
        <form action="" method="post">
          <label for="gajibulanan" class="block">
            <span class="block text-sm">Total Uang</span>
            <input type="text" id="totaluang" class="border-2 w-full px-2 py-1 mb-3 outline-none" readonly placeholder="Rp. 0">
          </label>
          <label for="gajibulanan" class="block">
            <span class="block text-sm">Nisab</span>
            <input type="text" class="border-2 w-full px-2 py-1 mb-3 outline-none" value="Rp. 6.131.333" readonly>
          </label>
          <label for="gajibulanan" class="block">
            <span class="block text-sm">Nilai Zakat</span>
            <input type="text" id="nilaizakat" class="border-2 w-full px-2 py-1 mb-3 outline-none" readonly placeholder="Rp. 0">
          </label>
          <button class="btn btn-lightgreen">Salurkan Zakat</button>
        </form>
      </div>
    </div>
    
  </div>
</div>