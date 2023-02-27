<?php

namespace App\Http\Controllers\FrequentlyAskedQuestions;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrequentlyAskedQuestions\IndexFrequentlyAskedQuestionRequest;
use App\Http\Requests\FrequentlyAskedQuestions\StoreFrequentlyAskedQuestionRequest;
use App\Http\Requests\FrequentlyAskedQuestions\UpdateFrequentlyAskedQuestionRequest;
use App\Models\FrequentlyAskedQuestion;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;
use function redirect;
use function view;

class FrequentlyAskedQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:frequently-asked-question-list', ['only' => ['index']]);
        $this->middleware('permission:frequently-asked-question-create', ['only' => ['create','store']]);
        $this->middleware('permission:frequently-asked-question-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:frequently-asked-question-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     */
    public function index(IndexFrequentlyAskedQuestionRequest $request): Factory|View|Application
    {
        $searchQuery    = $request->get(key: 'search_query');
        $status         = $request->get(key: 'status');

        $frequentlyAskedQuestionQuery = FrequentlyAskedQuestion::query();

        if ($searchQuery) {
            $frequentlyAskedQuestionQuery->where(column: 'question', operator: 'LIKE', value: "%{$searchQuery}%")
                ->orWhere(column: 'answer', operator: 'LIKE', value: "%{$searchQuery}%");
        }

        if ($status != null) {
            $frequentlyAskedQuestionQuery->where(column: 'status', operator: '=', value: $status);
        }

        $frequentlyAskedQuestionQuery->orderBy(column: 'question',direction: 'ASC');

        $frequentlyAskedQuestions = $frequentlyAskedQuestionQuery->paginate(perPage: 20)->withQueryString();

        return view(view: 'backEnd.pages.frequentlyAskedQuestions.index')->with([
            'frequentlyAskedQuestions' => $frequentlyAskedQuestions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(): Factory|View|Application
    {
        return view(view: 'backEnd.pages.frequentlyAskedQuestions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(StoreFrequentlyAskedQuestionRequest $request): RedirectResponse
    {
        $validatedInput= $request->safe()->toArray();

        try {

            DB::beginTransaction();

            FrequentlyAskedQuestion::query()->create($validatedInput);

            DB::commit();

            $message = [
                'status' => 'success',
                'info'  => 'Frequently asked question created successfully.',
            ];

            $authUser = Auth::user();
            if($authUser->can(abilities: 'frequently-asked-question-list')) {

                return redirect()->route(route: 'frequently-asked-questions.index')->with([
                    'message' => $message,
                ]);

            } else {
                return redirect()->back()->with([
                    'message' => $message,
                ]);
            }

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
     * Display the specified course category.
     *
     */
    public function show(FrequentlyAskedQuestion $frequentlyAskedQuestion): Factory|View|Application
    {
        return view(view: 'backEnd.pages.frequentlyAskedQuestions.show')->with([
            'frequentlyAskedQuestion' => $frequentlyAskedQuestion
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Request $request, FrequentlyAskedQuestion $frequentlyAskedQuestion): Factory|View|Application
    {
        $redirectRoute = $request->get(key: 'redirect_route');

        return view(view: 'backEnd.pages.frequentlyAskedQuestions.edit')->with([
            'frequentlyAskedQuestion' => $frequentlyAskedQuestion,
            'redirectRoute' => $redirectRoute,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(UpdateFrequentlyAskedQuestionRequest $request, FrequentlyAskedQuestion $frequentlyAskedQuestion): Redirector|RedirectResponse|Application
    {
        $validatedInput= $request->safe()->toArray();


        $redirectRoute = $request->safe()->only(keys: 'redirect_route');

        $redirectRoute = array_key_exists('redirect_route', $redirectRoute) ? $redirectRoute['redirect_route'] : null;


        try {
            DB::beginTransaction();

            $frequentlyAskedQuestion->update($validatedInput);

            DB::commit();

            $message = [
                'status' => 'success',
                'info'  => 'frequently asked question update successfully.',
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'frequently-asked-questions.index')->with(['message' => $message]);
            }


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

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'frequently-asked-questions.index')->with(['message' => $message]);
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(FrequentlyAskedQuestion $frequentlyAskedQuestion): RedirectResponse
    {
        try {
            DB::beginTransaction();


            $frequentlyAskedQuestion->delete();

            DB::commit();

            $message = [
                'status' => 'success',
                'info'  => 'Frequently asked question deleted successfully.',
            ];

            return redirect()->route('frequently-asked-questions.index')->with([
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
     * Update a specific faq's status from storage.
     *
     */
    public function updateStatus(Request $request, FrequentlyAskedQuestion $frequentlyAskedQuestion): Redirector|RedirectResponse|Application
    {
        $redirectRoute = $request->get(key: 'redirect_route');

        try {

            DB::beginTransaction();

            if ($frequentlyAskedQuestion->status == 1) {
                $status = 0;
            }else{
                $status = 1;
            }

            $frequentlyAskedQuestion->status = $status;

            $frequentlyAskedQuestion->save();

            DB::commit();

            $message = [
                'status' => 'success',
                'info'  => 'Frequently asked question status update successfully.',
            ];

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'frequently-asked-questions.index')->with(['message' => $message]);
            }

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

            if ($redirectRoute) {
                return redirect($redirectRoute)->with(['message' => $message]);
            } else {
                return redirect()->route(route: 'frequently-asked-questions.index')->with(['message' => $message]);
            }
        }
    }
}
