public function store(Request $request)
{
    $validated = $request->validate([
        'nama_desa' => [
            'required',
            'string',
            'max:255',
        ],

        'penerima_balita' => [
            'required',
            'integer',
            'min:0',
        ],

        'penerima_bumil' => [
            'required',
            'integer',
            'min:0',
        ],

        'penerima_paud' => [
            'required',
            'integer',
            'min:0',
        ],

        'porsi_terdistribusi_harian' => [
            'required',
            'integer',
            'min:0',
        ],

        'status_layanan' => [
            'required',
            'string',
            'in:Aktif,Tidak Aktif',
        ],

        'catatan_dapur' => [
            'nullable',
            'string',
        ],

        'dokumentasi_foto' => [
            'nullable',
            'image',
            'mimes:jpeg,png,jpg',
            'max:2048',
        ],
    ]);

    /*
    |--------------------------------------------------------------------------
    | Upload Dokumentasi Foto
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('dokumentasi_foto')) {

        // Pastikan folder tersedia
        $uploadPath = public_path('uploads/mbg');

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $file = $request->file('dokumentasi_foto');

        // Nama file unik
        $filename = time() . '_' . uniqid() . '.' .
            $file->getClientOriginalExtension();

        // Pindahkan file
        $file->move($uploadPath, $filename);

        // Simpan path ke database
        $validated['dokumentasi_foto'] =
            'uploads/mbg/' . $filename;
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan Data MBG
    |--------------------------------------------------------------------------
    */

    $mbg = Mbg::create($validated);

    /*
    |--------------------------------------------------------------------------
    | Response
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('mbg.index')
        ->with(
            'success',
            'Data MBG berhasil ditambahkan!'
        );
}