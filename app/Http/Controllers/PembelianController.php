namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'tanggal_pembelian' => 'required|date',
            'supplier' => 'required|string',
            'email_supplier' => 'required|email',
        ]);

        // Simpan data (contoh)
        // Pembelian::create($validated);

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
}
