@php($hash = md5(microtime()))
<div
    class="form-group {{ $isMultiple ? 'multi' : 'single' }} col-span-6 sm:col-span-5"
    data-error-border="{{ $name }}"
>
    <label>{{ $label }}</label>
    <select id="{{ $name }}"
            data-select2-id
            @if ($isMultiple)
            name="{{ $name }}[]"
            multiple=""
            @else
            name="{{ $name }}"
            @endif
            @if ($isAjax)
            data-ajax-select2-url="{{ $url }}"
            @endif
            data-ajax-select2-{{ $hash }}
            @if ($isCustomTemp)
            data-custom-temp="true"
            data-selected-items="{{ json_encode($selectedData) }}"
            @endif
            class="form-control border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200
                                                    focus:ring-opacity-50 rounded-md shadow-sm w-full select2
            "
            data-searching-text="{{ __('search.search_in_progress') }}"
            data-no-result-found-text="{{ __('search.not_result_found') }}"
            style="width: 100%"
    >
        @if (!$isAjax)
            <option value="">{{ __('action.select') }}</option>
            @foreach($data as $item)
                <option value="{{ $item['id'] }}" {{ isset($selectedData[$item['id']]) ? 'selected' : '' }}>
                    {{ $item['name'] ?? '' }}
                </option>
            @endforeach
        @else
            @if (!$isCustomTemp && ($selectedDatas ?? false))
                @foreach($selectedData as $item)
                    <option selected value="{{ $item['id'] }}">
                        {{ $item['text'] }}
                    </option>
                @endforeach
            @endif
        @endif
    </select>
    @if ($isMultiple)
        <div class="arrow-right" data-arrow-select2>
            <div class="arrow-mask"></div>
        </div>
    @else
        <div class="clear-select2" data-select2-clear>
            <span>X</span>
        </div>
    @endif
</div>
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(() => {
                $('[data-ajax-select2-{{ $hash }}]').each(function () {
                    let url = $(this).attr('data-ajax-select2-url');
                    let searchingText = $(this).attr('data-searching-text');
                    let noResultFoundText = $(this).attr('data-no-result-found-text');
                    let selectedValue = false;
                    let select2Conf = {
                        language: {
                            searching: function() {
                                return searchingText;
                            },
                            "noResults": function(){
                                return noResultFoundText;
                            }
                        },
                        ajax: {
                            url: url,
                            dataType: 'json',
                            type: 'GET',
                            delay: 250,
                            data: function (params) {
                                return {
                                    term: params.term
                                };
                            },
                            processResults: function (data, params) {
                                return {
                                    results: data.data,
                                };
                            },
                            transport: function (params, success, failure) {
                                var $request = $.ajax(params);

                                $request.then(success);
                                $request.fail('test');
                                return $request;
                            }
                        },
                        templateResult: formatRepo,
                        templateSelection: formatRepo
                    };
                    if ($(this).attr('data-selected-items')) {
                        select2Conf.data = JSON.parse($(this).attr('data-selected-items'));
                        selectedValue = true;
                    }
                    $(this).select2(select2Conf);
                    if (selectedValue) {
                        $(this).val(select2Conf.data.map((element) => {
                            return element.id;
                        })).trigger('change');
                    }
                    $(this).on("select2:select", function (target) {
                        console.log(target.params.data.id);
                        Livewire.emit('{{ 'selected' . \Illuminate\Support\Str::ucfirst($name) }}', target.params.data.id);
                    });
                    $(this).on("select2:unselect", function (target) {
                        //TODO usuwanie tagów po unselect
                        Livewire.emit('{{ 'unselected' . \Illuminate\Support\Str::ucfirst($name) }}', target.params.data.id);
                    });
                    $(this).on("select2:clear", function (target) {
                        Livewire.emit('{{ 'clear' . \Illuminate\Support\Str::ucfirst($name) }}');
                    });
                });
            }, 200);
            clearSelect2();
        });
        function formatRepo(repo) {
            return repo.template ? $(repo.template) : repo.text;
        }

        function clearSelect2()
        {
            $(document).on('click', '[data-select2-clear]', function () {
                $(this).siblings('select').val(null).trigger('change');
            });
        }

    </script>
@endsection
