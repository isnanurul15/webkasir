namespace App\Http\Controllers;

use App\Http\Requests\PembelianRequest; // Import Request
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function store(PembelianRequest $request)
    {
        // Validasi sudah dilakukan otomatis oleh PembelianRequest

        // Ambil data dari request
        $data = $request->all();

        // Proses penyimpanan data (contoh)
        // Misalnya, menggunakan model Pembelian:
        Pembelian::create($data);

        return redirect()->route('pembelians.index')->with('success', 'Data pembelian berhasil ditambahkan.');
    }
}
