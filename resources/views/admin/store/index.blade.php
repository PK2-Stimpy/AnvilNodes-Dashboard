@extends('layouts.main')

@section('content')
    <!-- CONTENT HEADER -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Store') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a class="text-muted"
                                href="{{ route('admin.store.index') }}">{{ __('Store') }}</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- END CONTENT HEADER -->

    <!-- MAIN CONTENT -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-4">
                    @if ($isPaypalSetup == false)
                        <div class="callout callout-danger">
                            <h4>{{ __('Paypal is not configured.') }}</h4>
                            <p>{{ __('To configure PayPal, head to the .env and add your PayPal’s client id and secret.') }}
                            </p>
                        </div>
                    @endif
                    @if ($isStripeSetup == false)
                        <div class="callout callout-danger">
                            <h4>{{ __('Stripe is not configured.') }}</h4>
                            <p>{{ __('To configure Stripe, head to the .env and add your Stripüe Secret, Endpoint and supported Payment Methods.') }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title"><i class="fas fa-sliders-h mr-2"></i>{{ __('Store') }}</h5>
                        <a href="{{ route('admin.store.create') }}" class="btn btn-sm btn-primary"><i
                                class="fas fa-plus mr-1"></i>{{ __('Create new') }}</a>
                    </div>
                </div>

                <div class="card-body table-responsive">

                    <table id="datatable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('Active') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Display') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Created at') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>


        </div>
        <!-- END CUSTOM CONTENT -->

    </section>
    <!-- END CONTENT -->

    <script>
        function submitResult() {
            return confirm("Are you sure you wish to delete?") !== false;
        }

        document.addEventListener("DOMContentLoaded", function() {
            $('#datatable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/{{ config('app.datatable_locale') }}.json'
                },
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: "{{ route('admin.store.datatable') }}",
                order: [
                    [2, "desc"]
                ],
                columns: [{
                        data: 'disabled'
                    },
                    {
                        data: 'type'
                    },
                    {
                        data: 'price'
                    },
                    {
                        data: 'display'
                    },
                    {
                        data: 'description'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'actions',
                        sortable: false
                    },
                ],
                fnDrawCallback: function(oSettings) {
                    $('[data-toggle="popover"]').popover();
                }
            });
        });
    </script>



@endsection
