<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\VideoProfil;


/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API Documentation",
 *      description="Dokumentasi API untuk aplikasi Laravel CMS",
 *      @OA\Contact(
 *          email="admin@example.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 */

class BerandaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/users",
     *     summary="Get list of users",
     *     tags={"Users"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */
    public function index()
    {
        return view('/index', [
            'sliders'       => Slider::all(),
            'beritas'       => Berita::where('status_id', 2)->latest()->take(3)->get(),
            'videoProfil'   => VideoProfil::first()
        ]);
    }
}
