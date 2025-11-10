namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Bisa tambahkan histori masuk/keluar kalau tersedia
        $items = Item::all();

        return view('reports.index', compact('items'));
    }
}
