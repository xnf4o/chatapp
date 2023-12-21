<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ChatApp;
use App\Jobs\SendMessageJob;
use App\Models\Mailing;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Статус рассылок
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        // get mailings
        $mailings = Mailing::all();
        return view('panel.task.status', compact('mailings'));
    }

    private function filterNumbers($input): array
    {
        return array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', str_replace(' ', '', $input))), function ($number) {
            return str_starts_with($number, '7') && strlen($number) == 11;
        });
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws ValidationException
     */
    public function create(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if($request->isMethod('post'))
        {
            $this->validate($request, [
                'numbers'=>'required',
                'message'=>'required',
            ]);

            $numbers = $this->filterNumbers($request->numbers);
            $numbers = array_unique($numbers);

            foreach ($numbers as $number) {
                $mailing = Mailing::create([
                    'number' => $number,
                    'message' => $request->message,
                ]);

                $delay = rand(5, 50);

                Bus::dispatch((new SendMessageJob($request->message, $number, $mailing->id, auth()->user()->chatapp_access_token))->delay(now()->addSeconds($delay)));
            }
        }
        return view('panel.task.create');
    }
}
