<x-header/>
<x-app-layout/>

<div>
    <div class="d-flex flex-row justify-content-center">
        <h2>Планирование бюджета</h2>
    </div>
    <div class="d-flex flex-row justify-content-center">
        <div class="d-flex flex-column mx-2 my-2 align-items-center">
            <div>

            </div>
            <h4>Список бюджетов</h4>
            <div class="d-flex flex-row justify-content-center">
                <table class="table table-bordered table-striped table-hover table-sm caption-top align-top">
                    <thead class="table-light text-center align-top">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Месяц</th>
                        <th scope="col">Год</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    <tr>
                        <form class="" name="" id="category" method="post" enctype="multipart/form-data" action="{{route('planbudget.add')}}">
                            @csrf
                            <td>
                            </td>
                            <td>
                                <x-text-input id="month" class="block mt-1 items-center justify-center" type="text" name="month" required autofocus autocomplete="month" />
                                <x-input-error :messages="$errors->get('month')" class="mt-2" />
                            </td>
                            <td>
                                <x-text-input id="year" class="block mt-1 items-center justify-center" type="text" name="year" required autofocus autocomplete="year" />
                                <x-input-error :messages="$errors->get('year')" class="mt-2" />
                            </td>
                            <td class="col-1 align-top">
                                <button type="submit" class="btn btn-success btn-sm" name="id" value="">Создать</button>
                            </td>
                        </form>
                    </tr>
                    @foreach ($planBudgets as $key => $planBudget)

                        <tr>
                            <form class="" name="" id="category" method="post" enctype="multipart/form-data" action="{{route('planbudget.edit')}}">
                                @csrf
                                <input type="hidden" name="budgetId" value="{{$planBudget->id}}">
                                <td>
                                    {{$key + 1}}
                                </td>
                                <td>
                                    {{$planBudget->month}}
                                </td>
                                <td>
                                    {{$planBudget->year}}
                                </td>
                                <td class="col-1 align-top">
                                    <button type="submit" class="btn btn-danger btn-sm" name="delete" value="{{$planBudget->id}}">Удалить</button>
                                </td>
                                <td class="col-1 align-top">
                                    <button type="submit" class="btn btn-primary btn-sm" name="isSet" value="true">Планировать</button>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="d-flex flex-column mx-2 my-2 align-items-center">
            <h4>Текущий бюджет</h4>
            <div>
                @if (!$isCurrentBudgetSet)
                    Текущий бюджет не выбран
                @else
                    {{$currentBudget['month']}} - {{$currentBudget['year']}}
                    <table class="table table-bordered table-striped table-hover table-sm align-top">                            <thead class="table-light text-center align-top">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Статья</th>
                            <th scope="col">Сумма</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        <tr>
                            <form class="" name="" id="category" method="post" enctype="multipart/form-data" action="{{route('planbudget.addItem')}}">
                                @csrf
                                <td>
                                    <x-text-input id="order" class="block mt-1 w-25 items-center justify-center" type="text" name="order" required autofocus autocomplete="order" />
                                    <x-input-error :messages="$errors->get('order')" class="mt-2" />
                                </td>
                                <td>
                                    <select name="account_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        @foreach(\App\Models\Account::where('user_id', Auth::user()->id)->where('category', '!=', 0)->get() as $account)
                                            <option value="{{$account->id}}">{{$account->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <x-text-input id="sum" class="block mt-1 items-center justify-center" type="number" name="sum" required autofocus autocomplete="sum" />
                                    <x-input-error :messages="$errors->get('sum')" class="mt-2" />
                                </td>
                                <td class="col-1 align-top">
                                    <button type="submit" class="btn btn-success btn-sm" name="currentBudget" value="{{$currentBudget->id}}">Добавить</button>
                                </td>
                            </form>
                        </tr>
                        @foreach($currentBudgetItems as $item)
                            <tr>
                                <form class="" name="" id="category" method="post" enctype="multipart/form-data" action="{{route('planbudget.deleteItem')}}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$item['order']}}">
                                    <td>
                                        {{$item['order']}}
                                    </td>
                                    <td>
                                        {{\App\Models\Account::find($item['account'])->name}}
                                    </td>
                                    <td>
                                        {{$item['sum']}} р.
                                    </td>
                                    <td class="col-1 align-top">
                                        <button type="submit" class="btn btn-danger btn-sm" name="currentBudget" value="{{$currentBudget->id}}">Удалить</button>
                                    </td>
                                </form>
                            </tr>

                            </tbody>
                        @endforeach

                    </table>

                @endif
            </div>
            <div>
            </div>
        </div>
    </div>
</div>
