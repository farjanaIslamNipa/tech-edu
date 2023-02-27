<?php

namespace App\Http\Controllers\Contacts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contacts\IndexContactRequest;
use App\Models\Contact;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Throwable;

class ContactController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:contact-list', ['only' => ['index']]);
        $this->middleware('permission:contact-delete', ['only' => ['destroy']]);

    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index(IndexContactRequest $request): Factory|View|Application
    {
        $searchQuery    = $request->get('search_query');
        $readStatus    = $request->get('read_status');

        $contactQuery = Contact::query();

        if ($searchQuery) {
            $contactQuery->where('reference', 'LIKE', "%{$searchQuery}%")
                ->orWhere('message', 'LIKE', "%{$searchQuery}%")
                ->orWhereHas('client.user', function ($query) use ($searchQuery) {
                    $query->where('first_name', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('last_name', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('email', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('phone_number', 'LIKE', "%{$searchQuery}%");
                })->orWhereHas('client.address', function ($query) use ($searchQuery) {
                    $query->where('street', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('suburb', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('state', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('country', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('post_code', 'LIKE', "%{$searchQuery}%");
                });
        }

        if ($readStatus != null) {
            $contactQuery->where('read_status', '=', $readStatus);
        }

        $contactQuery->with(['client.user', 'client.address'])
            ->orderBy('created_at', 'DESC');

        $contacts = $contactQuery->paginate(perPage: 20)->withQueryString();

        return view(view: 'backEnd.pages.contacts.index')->with([
            'contacts' => $contacts,
            ]);

    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Contact $contact): Factory|View|Application
    {
        if ($contact->read_status == 0) {
            $contact->read_status = 1;
            $contact->save();
        }

        $contact->load('client.user', 'client.address');
        return view('backEnd.pages.contacts.show')->with([
            'contact' => $contact,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $contact->delete();
            DB::commit();
            $message = [
                'status' => 'success',
                'info'  => 'Contact message deleted successfully.',
            ];

            return redirect()->route(route: 'contacts.index')->with([
                'message' => $message,
            ]);

        } catch (Throwable $exception) {
            DB::rollBack();

            $message = [
                'status' => 'error',
                'info'  => 'Something is wrong.',
                'exception' => [
                    'message' => $exception->getMessage(),
                    'status' => $exception->getCode(),
                    'line' => $exception->getLine(),
                ],
            ];

            return redirect()->back()->with([
                'message' => $message,
            ]);
        }
    }

    /**
     * Update a specific contact status from storage.
     *
     */
    public function updateStatus(Request $request, Contact $contact): Redirector|RedirectResponse|Application
    {
        $redirectRoute = $request->get(key: 'redirect_route');

        try {

            DB::beginTransaction();

            if ($contact->read_status == 0) {
                $readStatus = 1;
            }else{
                $readStatus = 0;
            }

            $contact->read_status = $readStatus;

            $contact->save();

            DB::commit();

            $message = [
                'status' => 'success',
                'info'  => 'contact read status update successfully.',
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'contacts.index')->with(['message' => $message]);
            }

        } catch (Throwable $exception) {
            DB::rollBack();

            $message = [
                'status' => 'error',
                'info'  => 'something is wrong.',
                'exception' => [
                    'message' => $exception->getMessage(),
                    'status' => $exception->getCode(),
                    'line' => $exception->getLine(),
                ],
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'contacts.index')->with(['message' => $message]);
            }
        }
    }
}
